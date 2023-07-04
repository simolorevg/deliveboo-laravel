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

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Restaurant $restaurant)
    {
        $dish = Dish::all();
        foreach ($dish as $item) {
            if ($restaurant->id !== $item->restaurant_id) {
                abort(404, 'Unauthorized');
                break;
            }
        }
        return view('admin.dishes.index', compact('dish'));
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
        $data = $request->all();
        $data['slug'] = Str::slug($data['dish_name']);
        $data['restaurant_id'] = Auth::user()->id;   //!in questo modo il campo user_id prende il valore dell'id dell'utente da rivedere

        $isAvailable = $request->has('is_available') ? 0 : 1;
        $data['is_available'] = $isAvailable;
        $dish = Dish::create($data);
        return redirect()->route('admin.dishes.index', compact('dish'))->with('message', 'Hai creato il tuo piatto.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        $restaurant= $dish->restaurant;

        if ($restaurant->user_id !== Auth::id()) {
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
        $data = $request->all();
        $data['slug'] = Str::slug($data['dish_name']);
        // Verifica se il checkbox è stato inviato e selezionato
        $isAvailable = $request->has('is_available') ? 0 : 1;
        $data['is_available'] = $isAvailable;
        $dish->update($data);
        return redirect()->route('admin.dishes.index');
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
        return redirect()->route('admin.dishes.index');
    }
}
