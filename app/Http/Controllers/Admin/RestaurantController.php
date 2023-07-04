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

class RestaurantController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $categories = Category::all();
        $restaurant = Restaurant::where("user_id", Auth::user()->id)->get();

        if ($request->has('category_id') && !is_null($data['category_id'])) {
            $restaurant = Restaurant::where('category_id', $data['category_id']);
        }

        // dd($restaurant);
        $count = Auth::user()->restaurant->count();
        return view('admin.restaurants.index', compact('restaurant', 'count', 'categories'));
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

        // salvataggio in DB
        $restaurant = Restaurant::create($data);

        //salvataggio dati tabella ponte
        if ($request->has('category_id')) {
            $restaurant->categories()->attach($request->category_id);
        }
        return redirect()->route('admin.restaurants.index')->with('message', 'Hai creato il tuo ristorante.');
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
            abort(404, 'Unauthorized');
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
            abort(404, 'Unauthorized');
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
        $data = $request->validated();
        $data['slug'] = Str::slug($data['restaurant_name']);
        $restaurant->update($data);
        if ($request->has('category_id')) {
            $restaurant->categories()->sync($data['category_id']);
        } else {
            $restaurant->categories()->detach();
        };
        return redirect()->route('admin.restaurants.index');
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
