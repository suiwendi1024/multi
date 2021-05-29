@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <order-total-chart
                    v-for="(chart, index) in {{ json_encode($charts) }}"
                    :key="index"
                    :chart="chart"
                ></order-total-chart>
            </div>
        </div>
    </div>
@endsection
