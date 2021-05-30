<?php
/**
 * @var \App\Models\Post[]|\Illuminate\Pagination\LengthAwarePaginator $posts
 */
?>
@extends('admin.layouts.app')

@section('content')
    <h1>帖子</h1>
    <table class="table">
        <thead>
        <tr>
            <th>标题</th>
            <th>作者</th>
            <th>创建日期</th>
            <th>更新日期</th>
            <th>评论数</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->user->name }}</td>
                <td>{{ $post->created_at }}</td>
                <td>{{ $post->updated_at }}</td>
                <td>{{ $post->comments_count }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $posts->links() }}
@endsection
