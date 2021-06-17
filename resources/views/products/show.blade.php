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
                    <table>
                        <tr>
                            <td>价格</td>
                            <td class="text-danger h4">￥{{ $product->price }}</td>
                        </tr>
                    </table>
                    <form action="">
                        <div class="form-group row">
                            <label for="inputQuantity" class="col-sm-2 col-form-label">数量</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="inputQuantity" value="1" min="1" max="999">
                            </div>
                        </div>
                    </form>
                </div>

                <div>
                    <a href="/orders/create" type="button" class="btn btn-light btn-lg border-danger text-danger" onclick="if (!user) { location.href = '/login'; }">立即购买</a>
                    <button type="button" class="btn btn-danger btn-lg" onclick="if (user) {  } else { location.href = '/login'; }">加入购物车</button>
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
