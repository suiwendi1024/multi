<?php
/**
 * @var \Illuminate\Http\Resources\Json\ResourceCollection $posts
 * @var \App\Models\Post[]|\Illuminate\Pagination\LengthAwarePaginator $ranking_posts
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            {{-- 排行榜 --}}
            <div class="col-md-3">
                <form id="search-form" action="" method="get">
                    <div class="form-group">
                        <input
                            type="search"
                            name="search"
                            class="form-control"
                            placeholder="搜索帖子标题或摘要"
                            onsearch="if (this.value == '' && location.search.indexOf('search') != -1) {location.href = location.pathname;}"
                            maxlength="40"
                            required
                            value="{{ old('search') }}"
                            onload="let search = new URLSearchParams(location.search); this.value = search.get('search');"
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
                                    <span
                                        class="badge {{ $index < 3 ? 'badge-success' : 'badge-secondary' }}">{{ $index + 1 }}</span>
                                    <a href="{{ $post->path }}" target="_blank">{{ $post->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endempty
                </div>
            </div>
            {{-- 帖子 --}}
            <div class="col-md">
                <post-section :posts="{{ $posts->toJson() }}"></post-section>
            </div>
            {{-- 分类 --}}
            <div class="col-md-1">
                @include('posts._category-nav')
            </div>
        </div>
    </div>
@endsection
