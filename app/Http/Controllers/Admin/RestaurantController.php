<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        // creazione ristorante
        $data = $request->all();
        $categories = Category::all();
        $restaurants = Restaurant::where("user_id", Auth::user()->id)->get();

        if ($request->has('category_id') && !is_null($data['category_id'])) {
            $restaurant = Restaurant::where('category_id', $data['category_id']);
        }

        // dd($restaurant);
        $count = Auth::user()->restaurant->count();
        return view('admin.restaurants.index', compact('restaurants', 'count', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.restaurants.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRestaurantRequest $request)
    {
        // creazione ristorante
        $data = $request->validated();
        $data['slug'] = Str::slug($data['restaurant_name']);
        $data['user_id'] = Auth::user()->id; //in questo modo il campo user_id prende il valore dell'id dell'utente

        //Salvataggio file/thumb
        if ($request->hasFile('thumb')){
            $path = Storage::disk('public')->put('restaurant_images', $request->thumb);
            $data['thumb']= $path;
        }

        // salvataggio in DB
        $restaurant = Restaurant::create($data);

        //salvataggio dati tabella ponte
        if ($request->has('category_id')) {
            $restaurant->categories()->attach($request->category_id);
        }
        return redirect()->route('admin.restaurants.index')->with('message', 'Hai creato correttamente il tuo ristorante ' . $restaurant->restaurant_name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        if ($restaurant->user_id !== Auth::id()) {
            return view('errors.403');
        }
        $categories = Category::all();
        return view('admin.restaurants.show', compact('restaurant', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        if ($restaurant->user_id !== Auth::id()) {
            return view('errors.403');

        }
        $categories = Category::all();
        return view('admin.restaurants.edit', compact('restaurant', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
        //aggiornamento dati
        $data = $request->validated();
        $data['slug'] = Str::slug($data['restaurant_name']);

        // update immagine
        if ($request->hasFile('thumb')) {
            if ($restaurant->thumb) {
                Storage::delete($restaurant->thumb);
            }
            $path = Storage::disk('public')->put('restaurant_images', $request->thumb);
            $data['thumb'] = $path;
        }

        // aggiornamento
        $restaurant->update($data);
        if ($request->has('category_id')) {
            $restaurant->categories()->sync($data['category_id']);
        } else {
            $restaurant->categories()->detach();
        };
        return redirect()->route('admin.restaurants.index')->with('message', 'Hai modificato correttamente il tuo ristorante ' . $restaurant->restaurant_name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return redirect()->route('admin.dashboard')->with('message', 'Ristorante eliminato.');
    }
}
