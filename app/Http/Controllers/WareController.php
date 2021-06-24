<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWareRequest;
use App\Http\Requests\UpdateWareRequest;
use App\Http\Resources\WareResource;
use Illuminate\Http\Request;

class WareController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wares = \App\Models\Ware::whereSubjectType(\Auth::user()->getMorphClass())
            ->whereSubjectId(\Auth::id())
            ->get();

        return view('wares.index', compact('wares'));
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
    public function store(StoreWareRequest $request)
    {
        if ($request->wantsJson()) {
            if (!$ware = \App\Models\Ware::where($request->validationData())->first()) {
                $ware = \App\Models\Ware::create($request->validationData());
            }

            return WareResource::make($ware);
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
    public function update(UpdateWareRequest $request, $id)
    {
        if ($request->wantsJson()) {
            $ware = \App\Models\Ware::find($id);
            $attributes = $request->validationData();
            $attributes['amount'] = $ware->product->price * $attributes['quantity'];

            return $ware->update($attributes);
        }
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
