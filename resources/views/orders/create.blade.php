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
                <div class="card">
                    <div class="card-body">
                        <order-form :wares="{{ $wares }}"></order-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
