<?php
/**
 * @var \App\Models\Product $product
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-5">
            {{-- 商品图片 --}}
            <div class="col-md-4">
                <img class="img-fluid" src="{{ asset($product->cover_url) }}" alt="">
            </div>
            {{-- 商品规格 --}}
            <div class="col-md-6 d-flex flex-column">
                <div class="flex-grow-1">
                    <h3>{{ $product->name }}</h3>
                    <h4 class="text-danger">￥{{ $product->price }}</h4>
                </div>

                <div>
                    <button type="button" class="btn btn-danger btn-lg">加入购物车</button>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="row">
            <div class="col-md-2 border-right">
                @foreach($side_products as $product)
                    <img class="img-fluid mb-1" src="{{ asset($product->cover_url) }}" alt="">
                    <h5>
                        <a href="{{ $product->path }}" target="_blank">{{ $product->name }}</a>
                    </h5>
                    <span class="text-danger">￥{{ $product->price }}</span>
                @endforeach
            </div>
            <div class="col-md">
                <div class="lead">{!! $product->description !!}</div>
                {{-- 评论区 --}}
                <comment-section class="mt-5"></comment-section>
            </div>
        </div>

    </div>
@endsection
