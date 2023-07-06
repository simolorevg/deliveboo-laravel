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
        // $data = $request->all();
        // $data['dish_name'] = ($data['dish_name'] . '-' . Auth::user()->id . '-' . ?);
        // $data['slug'] = Str::slug(($data['dish_name']) . '-' . Auth::user()->id); 
        // $data['restaurant_id'] = Auth::user()->id;   //!in questo modo il campo user_id prende il valore dell'id dell'utente da rivedere

        // creazione piatto
        $data = $request->all();
        $dishName = $data['dish_name'];
        $restaurantId = Auth::user()->restaurant->id;

        // Controlla se esiste già un piatto con lo stesso nome nel ristorante corrente
        $existingDish = Dish::where('dish_name', $dishName)->where('restaurant_id', $restaurantId)->first();

        if ($existingDish) {
            // Piatto duplicato trovato
            return redirect()->route('admin.dishes.index')->with('message', 'Un piatto con lo stesso nome esiste già nel ristorante.');
        }

        // Genera lo slug unico
        // $data['slug'] = Str::slug($dishName . '-' . Auth::user()->id);

        
        // Controlla se esiste un piatto con lo stesso nome in altri ristoranti
        $existingDishInOtherRestaurants = Dish::where('dish_name', $dishName)
            ->where('restaurant_id', '<>', $restaurantId)
            ->first();

        if ($existingDishInOtherRestaurants) {
            // Piatto duplicato trovato in altri ristoranti
            // Genera lo slug unico basato sull'ID del ristorante corrente
            $data['slug'] = Str::slug($dishName . '-' . $restaurantId . '-' . Auth::user()->id);
        } else {
            // Genera lo slug unico senza l'ID del ristorante corrente
            $data['slug'] = Str::slug($dishName . '-' . Auth::user()->id);
        }

        // Imposta l'ID del ristorante corrente
        $data['restaurant_id'] = $restaurantId;


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
