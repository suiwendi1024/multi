<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = \App\Models\Order::where('user_id', auth()->id())->paginate();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wares = \App\Models\Ware::whereType('order')
            ->whereSubjectType(\Auth::user()->getMorphClass())
            ->whereSubjectId(\Auth::id())
            ->with('product')
            ->get();

        return view('orders.create', compact('wares'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->wantsJson()) {
            $wares = \App\Models\Ware::findMany(array_column($request->wares, 'id'))->pluck(null, 'id');
            $order = \Auth::user()->orders()->create();
            $total = 0;

            foreach ($request->wares as $item) {
                $ware = $wares->get($item['id']);
                $ware->update([
                    'subject_type' => $order->getMorphClass(),
                    'subject_id' => $order->id,
                    'amount' => $ware->product->price * $item['quantity'],
                    'quantity' => $item['quantity'],
                ]);
                $total += $ware->amount;
            }
            $order->update(['total' => $total]);
        }
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
