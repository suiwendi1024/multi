<?php
/**
 * @var \App\Models\Product[] $products
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <order-form :products="{{ $products }}"></order-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
