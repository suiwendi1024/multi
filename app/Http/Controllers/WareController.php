<?php

namespace App\Http\Controllers;

use App\Http\Requests\WareRequest;
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
        //
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
    public function store(WareRequest $request)
    {
        if ($request->wantsJson()) {
            $attributes = $request->validationData();
            $where = [
                'subject_type' => $attributes['subject_type'],
                'subject_id' => $attributes['subject_id'],
                'product_id' => $attributes['product_id'],
                'type' => $attributes['type'],
            ];

            if (!$ware = \App\Models\Ware::where($where)->first()) {
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
    public function update(WareRequest $request, $id)
    {
        if ($request->wantsJson()) {
            return \App\Models\Ware::find($id)->update($request->validationData());
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
