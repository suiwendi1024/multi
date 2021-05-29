<?php
/**
 * @var \App\Models\Order[]|\Illuminate\Pagination\LengthAwarePaginator $orders
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @empty($orders->items())
                    <div class="alert alert-warning" role="alert">暂无数据。</div>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($orders as $order)
                            <li class="list-group-item bg-transparent">
                                <h4>{{ $order->created_at }}</h4>
                                @foreach($order->items as $item)
                                    <div class="media mb-2">
                                        <img class="mr-3 img-fluid" style="max-width: 100px;" src="{{ asset($item->product->cover_url) }}" alt="">
                                        <div class="media-body">
                                            <p class="d-flex justify-content-between">
                                                <span>{{ $item->product->name }}</span>
                                                <span>￥{{ $item->product->price }}</span>
                                            </p>
                                            <p class="text-right text-muted">×{{ $item->quantity }}</p>
                                            <p class="text-right">￥{{ $item->amount }}</p>
                                        </div>
                                    </div>
                                @endforeach
                                <p class="text-right text-danger">￥{{ $order->total }}</p>
                            </li>
                        @endforeach
                    </ul>

                    {{ $orders->links() }}
                @endempty
            </div>
        </div>
    </div>
@endsection
