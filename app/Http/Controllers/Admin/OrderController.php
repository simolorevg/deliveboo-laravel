<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Pagination\Paginator;
use PhpParser\Node\Expr\Cast\Array_;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $dishes = Dish::where('restaurant_id', Auth::user()->restaurant->id)->get();
        $orders = collect();

        foreach ($dishes as $dish) {
            $dish_orders = $dish->orders;

            foreach ($dish_orders as $order) {
                $orderId = $order->id;
                $existingOrder = $orders->first(function ($item) use ($orderId) {
                    return $item->id === $orderId;
                });

                if (!$existingOrder) {
                    $orders->push($order);
                }
            }
        }
        $orderedOrders = $orders->sortByDesc('created_at');
        $paginatedOrders = $this->paginateCollection($orderedOrders, 5);


        return view('admin.orders.index', compact('paginatedOrders'));
    }

    private function paginateCollection($collection, $perPage)
    {
        $currentPage = Paginator::resolveCurrentPage() ?: 1;
        $currentPageItems = $collection->slice(($currentPage - 1) * $perPage, $perPage);
        $paginatedItems = new LengthAwarePaginator(
            $currentPageItems,
            $collection->count(),
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath()]
        );

        return $paginatedItems;
    }


    public function stats()
    {
        App::setLocale('it');
        // Ottieni l'ID del ristorante autenticato
        $restaurantId = Auth::user()->restaurant->id;

        // Calcola le statistiche degli ordini per mese e anno del ristorante autenticato
        $orderStats = DB::table('orders')
            ->join('dish_order', 'orders.id', '=', 'dish_order.order_id')
            ->join('dishes', 'dish_order.dish_id', '=', 'dishes.id')
            ->where('dishes.restaurant_id', $restaurantId)
            ->select(
                DB::raw('YEAR(orders.created_at) as year'),
                DB::raw('MONTH(orders.created_at) as month'),
                DB::raw('COUNT(DISTINCT orders.id) as order_count'),
                DB::raw('SUM(dish_order.quantity * dishes.price) as total_sales')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // Calcola il totale degli ordini e il totale delle vendite per mese e anno
        $monthlyStats = [];
        $yearlyStats = [];

        foreach ($orderStats as $stat) {
            $month = $stat->month;
            $year = $stat->year;
            $orderCount = $stat->order_count;
            $totalSales = $stat->total_sales;

            // Statistiche mensili
            if (!isset($monthlyStats[$month])) {
                $monthlyStats[$month] = [
                    'order_count' => 0,
                    'total_sales' => 0
                ];
            }
            $monthlyStats[$month]['order_count'] += $orderCount;
            $monthlyStats[$month]['total_sales'] += $totalSales;

            // Statistiche annuali
            if (!isset($yearlyStats[$year])) {
                $yearlyStats[$year] = [
                    'order_count' => 0,
                    'total_sales' => 0
                ];
            }
            $yearlyStats[$year]['order_count'] += $orderCount;
            $yearlyStats[$year]['total_sales'] += $totalSales;
        }

        return view('admin.orders.stats', compact('monthlyStats', 'yearlyStats'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $dishes_price = collect();

        if ($order->dishes[0]->restaurant->id == Auth::user()->restaurant->id) {
            foreach ($order->dishes as $dish) {
                $single_price = $dish->price;
                $dishes_price->push($single_price);
            }
            // dd($dishes_price);
            return view('admin.orders.show', compact('order', 'dishes_price'));
        } else {
            return view('errors.403');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Ordine eliminato con successo!');
    }
}
