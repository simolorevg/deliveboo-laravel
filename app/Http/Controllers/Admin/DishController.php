<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Restaurant $restaurant)
    {

        // $dish = Dish::all()->sortBy('dish_name');
        $dishes = Dish::orderBy('dish_name')->paginate(10);

        return view('admin.dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Dish $dish)
    {
        return view('admin.dishes.create', compact('dish'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // creazione piatto
        $data = $request->all();
        $data['slug'] = Str::slug($data['dish_name']);
        $data['restaurant_id'] = Auth::user()->id;   //!in questo modo il campo user_id prende il valore dell'id dell'utente da rivedere

        // check di disponibilità
        $isAvailable = $request->has('is_available') ? 0 : 1;
        $data['is_available'] = $isAvailable;

        //Salvataggio file/thumb
        if ($request->hasFile('img')) {
            $path = Storage::disk('public')->put('dish_images', $request->img);
            $data['img'] = $path;
        }

        // salvataggio in DB

        $dish = Dish::create($data);
        return redirect()->route('admin.dishes.index', compact('dish'))->with('message', 'Hai creato correttamente ' . $dish->dish_name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        // se l'utente cerca di loggare verso altri url
        if ($dish->restaurant->user_id !== Auth::user()->id) {
            abort(404, '');
        }

        return view('admin.dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        // se l'utente cerca di loggare verso altri url
        if ($dish->restaurant->user_id !== Auth::user()->id) {
            abort(404, '');
        }

        return view('admin.dishes.edit', compact('dish'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        //aggiornamento dati

        $data = $request->all();
        $data['slug'] = Str::slug($data['dish_name']);

        // Verifica se il checkbox è stato inviato e selezionato
        $isAvailable = $request->has('is_available') ? 0 : 1;
        $data['is_available'] = $isAvailable;


        // update immagine
        if ($request->hasFile('img')) {
            if ($dish->img) {
                Storage::delete($dish->img);
            }
            $path = Storage::disk('public')->put('dish_images', $request->img);
            $data['img'] = $path;
        }


        // aggiornamento
        $dish->update($data);
        return redirect()->route('admin.dishes.index')->with('message', 'Hai modificato correttamente ' . $dish->dish_name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        $dish->delete();
        return redirect()->route('admin.dishes.index')->with('message', 'Hai eliminato correttamente ' . $dish->dish_name);;
    }
}
