<?php
/**
 * @var \App\Models\Post $post
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            {{-- 作者 --}}
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <img class="img-fluid rounded-circle mb-5" src="{{ asset($post->user->profile_picture_url) }}" alt="">
                        <h4>{{ $post->user->name }}</h4>
                    </div>
                </div>
            </div>
            {{-- 帖子 --}}
            <div class="col-md">
                <img class="img-fluid rounded mb-5" src="{{ asset($post->cover_url) }}" alt="">
                <h1>{{ $post->title }}</h1>
                <ul class="list-inline text-muted">
                    <li class="list-inline-item">{{ $post->created_at }}</li>
                    <li class="list-inline-item">{{ $post->category->name }}</li>
                    <li class="list-inline-item">{{ $post->views }}浏览</li>
                    <li class="list-inline-item">{{ $post->likes_count }}点赞</li>
                    <li class="list-inline-item">{{ $post->favorites_count }}收藏</li>
                    <li class="list-inline-item">{{ $post->comments_count }}评论</li>
                </ul>
                <div class="lead my-5">{!! $post->body !!}</div>
                <ul class="list-inline border-bottom h2">
                    <li class="list-inline-item">
                        <like-button :likeable="{{ $post }}" type="posts"></like-button>
                        <favorite-button :favoritable="{{ $post }}" type="posts"></favorite-button>
                    </li>
                </ul>
                {{-- 评论区 --}}
                <comment-section
                    :total="{{ $post->comments_count }}"
                    :comments="{{ $comments->toJson() }}"
                    class="mt-5"
                ></comment-section>
            </div>
            {{-- 分类 --}}
            <div class="col-md-1">
                @include('posts._category-nav')
            </div>
        </div>
    </div>
@endsection
