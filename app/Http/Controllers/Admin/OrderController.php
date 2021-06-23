<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var \Illuminate\Database\Eloquent\Collection $year */
        $year = \App\Models\Order::withoutGlobalScope(new \App\Scopes\ReverseScope())->whereBetween('created_at', [
            date('Y-m-d', strtotime('-1 year')),
            date('Y-m-d')
        ])->get()->groupBy(function (\App\Models\Order $order) {
            return $order->created_at->format('Y-m-d');
        })->map->sum('total');
        $month = $year->filter(function ($value, $key) {
            return strtotime($key) >= strtotime('-1 month');
        });
        $charts = [
            ['title' => '年度销售额统计', 'date' => $year->keys(), 'total' => $year->values()],
            ['title' => '月度销售额统计', 'date' => $month->keys(), 'total' => $month->values()],
        ];

        return view('admin.orders.index', compact('charts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
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
    public function destroy($id)
    {
        //
    }
}
