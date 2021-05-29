<?php
/**
 * @var \App\Models\Post[]|\Illuminate\Pagination\LengthAwarePaginator $posts
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            {{-- 左侧 --}}
            <div class="col-md-3">
                <form id="search-form" action="" method="get">
                    <div class="form-group">
                        <input
                            type="search"
                            name="search"
                            class="form-control"
                            placeholder="搜索帖子"
                            onsearch="if (this.value == '' && location.search.indexOf('search') != -1) {location.href = location.pathname;}"
                            maxlength="40"
                            required
                            value="{{ $search ?? old('search') }}"
                        >
                    </div>
                </form>
                <div>
                    <h4>排行榜</h4>
                    @empty($ranking_posts)
                        <div class="alert alert-warning text-center">暂无数据。</div>
                    @else
                        <ul class="list-unstyled">
                            @foreach($ranking_posts as $index => $post)
                                <li class="py-2 text-truncate">
                                    <span class="badge {{ $index < 3 ? 'badge-success' : 'badge-secondary' }}">{{ $index + 1 }}</span>
                                    <a href="{{ $post->path }}" target="_blank">{{ $post->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endempty
                </div>
            </div>
            {{-- 中间 --}}
            <div class="col-md">
                <ul class="list-group list-group-flush">
                    @foreach($posts as $post)
                        <li class="list-group-item bg-transparent">
                            <div class="media">
                                <div class="media-body align-self-stretch d-flex flex-column">
                                    <h3>
                                        <a href="{{ $post->path }}" target="_blank">{{ $post->title }}</a>
                                    </h3>
                                    <div class="text-muted flex-grow-1">{{ $post->summary }}</div>
                                    <div class="media small">
                                        <img class="mr-3 img-fluid rounded-circle" style="width: 30px;" src="{{ asset($post->user->profile_picture_url) }}" alt="">
                                        <div class="media-body align-self-center d-flex justify-content-between">
                                            <ul class="list-inline text-muted">
                                                <li class="list-inline-item">{{ $post->user->name }}</li>
                                                <li class="list-inline-item">{{ $post->category->name }}</li>
                                                <li class="list-inline-item">{{ $post->views }}浏览</li>
                                                <li class="list-inline-item">{{ $post->likes_count }}点赞</li>
                                                <li class="list-inline-item">{{ $post->favorites_count }}收藏</li>
                                                <li class="list-inline-item">{{ $post->comments_count }}评论</li>
                                            </ul>
                                            <div class="dropdown">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#" target="_blank">举报</a>
                                                    @if($post->user_id == auth()->id())
                                                        <a class="dropdown-item" href="{{ route('posts.edit', ['post' => $post->id]) }}" target="_blank">编辑</a>
                                                        {{-- 删除帖子按钮 --}}
                                                        <button type="submit" class="dropdown-item" form="delete-form" formaction="{{ route('posts.destroy', ['post' => $post->id]) }}">删除</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <img class="ml-3 img-fluid rounded" style="max-width: 160px;" src="{{ asset($post->cover_url) }}" alt="">
                            </div>
                        </li>
                    @endforeach
                </ul>
                {{ $posts->links() }}
            </div>
            {{-- 右侧 --}}
            <div class="col-md-1">
                @include('posts._category-nav')
            </div>
        </div>
    </div>
    {{-- 删除帖子按钮对应的表单 --}}
    <form id="delete-form" action="" method="post" onsubmit="if (!confirm('您坚持要删除该帖子吗？')) { return false; }">
        @csrf
        @method('delete')
    </form>
@endsection
