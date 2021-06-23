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
                    <div class="row">
                        <div class="col-sm-2">价格</div>
                        <div class="col-sm-10 text-danger h4">￥{{ $product->price }}</div>
                    </div>
                    <product-type-form :product="{{ $product }}"></product-type-form>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="lead">{!! $product->description !!}</div>
                {{-- 评论区 --}}
                <comment-section
                    :total="{{ $product->comments_count }}"
                    :comments="{{ $comments->toJson() }}"
                    class="mt-5"
                ></comment-section>
            </div>
            <div class="col-md-2 border-right order-first">
                @forelse($side_products as $product)
                    <img class="img-fluid mb-1" src="{{ asset($product->cover_url) }}" alt="">
                    <h5>
                        <a href="{{ $product->path }}" target="_blank">{{ $product->name }}</a>
                    </h5>
                    <span class="text-danger">￥{{ $product->price }}</span>
                @empty
                    <div class="alert alert-warning text-center">暂无数据。</div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
