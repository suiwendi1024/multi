@extends('admin.layouts.app')

@section('content')
    <h1>订单</h1>
    <order-total-chart
        v-for="(chart, index) in {{ json_encode($charts) }}"
        :key="index"
        :chart="chart"
    ></order-total-chart>
@endsection
