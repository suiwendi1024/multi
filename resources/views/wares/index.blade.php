<?php
/**
 * @var \App\Models\Ware[] $wares
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>购物车</h2>
                @empty($wares->count())
                    <div class="alert alert-warning text-center">暂无数据。</div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <order-form :wares="{{ $wares }}"></order-form>
                        </div>
                    </div>
                @endempty
            </div>
        </div>
    </div>
@endsection
