@extends('admin.layouts.app')

@section('content')
    <h1>仪表盘</h1>
    <div class="card-deck">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">用户</div>
            <div class="card-body">
                <h5 class="card-title">{{ \App\User::count() }}</h5>
            </div>
        </div>
        <div class="card text-white bg-secondary mb-3">
            <div class="card-header">帖子</div>
            <div class="card-body">
                <h5 class="card-title">{{ \App\Models\Post::count() }}</h5>
            </div>
        </div>
        <div class="card text-white bg-success mb-3">
            <div class="card-header">评论</div>
            <div class="card-body">
                <h5 class="card-title">{{ \App\Models\Comment::count() }}</h5>
            </div>
        </div>
        <div class="card text-white bg-danger mb-3">
            <div class="card-header">产品</div>
            <div class="card-body">
                <h5 class="card-title">{{ \App\Models\Product::count() }}</h5>
            </div>
        </div>
    </div>
@endsection
