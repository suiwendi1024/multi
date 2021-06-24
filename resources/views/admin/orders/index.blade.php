@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                @include('admin._sidebar')
            </div>
            <div class="col-md">
                <h1>订单</h1>
                <order-total-chart
                    v-for="(chart, index) in {{ json_encode($charts) }}"
                    :key="index"
                    :chart="chart"
                ></order-total-chart>
            </div>
        </div>
    </div>
@endsection
