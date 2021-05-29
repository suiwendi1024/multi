<?php
/**
 * @var \App\Models\Product $product
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-4">
                <img class="img-fluid" src="{{ asset($product->cover_url) }}" alt="">
            </div>

            <div class="col-md-8 d-flex flex-column">
                <div class="flex-grow-1">
                    <h1>{{ $product->name }}</h1>
                    <h4 class="text-danger">￥{{ $product->price }}</h4>
                </div>

                <div>
                    <button type="button" class="btn btn-warning btn-lg">加入购物车</button>
                    <a class="btn btn-danger btn-lg" role="button" href="#">立即购买</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md lead">
                {!! $product->description !!}
            </div>
        </div>
    </div>
@endsection
