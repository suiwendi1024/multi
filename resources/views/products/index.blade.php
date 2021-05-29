<?php
/**
 * @var \App\Models\Product[]|\Illuminate\Pagination\LengthAwarePaginator $products
 */
?>
@extends('layouts.app')

@section('content')
    <product-section :products="{{ json_encode($products->items()) }}"></product-section>
@endsection
