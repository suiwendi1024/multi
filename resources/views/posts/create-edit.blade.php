<?php
/**
 * @var \Illuminate\Support\ViewErrorBag $errors
 * @var \App\Models\Post $post
 */
$is_edit = isset($post);
?>
@extends('layouts.app')

@section('content')
    <div class="container bg-white py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form
                    action="{{ $is_edit ? route('posts.update', ['post' => $post->id]) : route('posts.store') }}"
                    method="post"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @if($is_edit)
                        @method('patch')
                    @endif
                    {{-- 分类 --}}
                    <div class="form-group">
                        <label for="category_id">分类</label>
                        <select
                            name="category_id"
                            id="category_id"
                            class="form-control"
                            {{ $is_edit ? '' : 'required' }}
                        >
                            @foreach($categories as $category)
                                <optgroup label="{{ $category->name }}">
                                    @foreach($category->children as $child)
                                        <option value="{{ $child->id }}">{{ $child->name }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                    {{-- 封面 --}}
                    <div class="form-group">
                        @if($is_edit)
                            <img class="img-fluid rounded mb-2" src="{{ asset($post->cover_url) }}" alt="">
                        @endif
                        <label for="cover">封面</label>
                        <input
                            type="file"
                            name="cover"
                            id="cover"
                            class="form-control-file{{ $errors->has('cover') ? ' is-invalid' : '' }}"
                            accept="image/*"
                            {{ $is_edit ? '' : 'required' }}
                        >

                        @error('cover')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- 标题 --}}
                    <div class="form-group">
                        <label for="title" class="sr-only">标题</label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            class="form-control form-control-lg{{ $errors->has('title') ? ' is-invalid' : '' }}"
                            value="{{ $post->title ?? old('title') }}"
                            placeholder="标题"
                            {{ $is_edit ? '' : 'required' }}
                            maxlength="40"
                        >
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- 正文 --}}
                    <div class="form-group">
                        <label for="body" class="sr-only">正文</label>
                        <textarea
                            name="body"
                            id="body"
                            cols="30"
                            rows="10"
                            class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}"
                            placeholder="正文"
                            {{ $is_edit ? '' : 'required' }}
                            maxlength="20000"
                        >{{ $post->title ?? old('body') }}</textarea>
                        @error('body')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- 摘要 --}}
                    <div class="form-group">
                        <label for="summary" class="sr-only">摘要</label>
                        <textarea
                            name="summary"
                            id="summary"
                            cols="30"
                            rows="3"
                            class="form-control{{ $errors->has('summary') ? ' is-invalid' : '' }}"
                            placeholder="摘要"
                            maxlength="200"
                            {{ $is_edit ? '' : 'required' }}
                        >{{ $post->summary ?? old('summary') }}</textarea>

                        @error('summary')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">投稿</button>
                </form>
            </div>
        </div>
    </div>
@endsection
