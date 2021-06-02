<?php
/**
 * @var \App\Models\Category[] $categories
 */
?>
<h4>分类</h4>
<ul class="nav nav-pills flex-column">
    @foreach($categories as $category)
        <li class="nav-item">
            <a
                class="nav-link{{ request('category') == $category->id ? ' active' : '' }}"
                href="{{ route('posts.index', ['category' => $category->id]) }}"
            >{{ $category->name }}</a>
        </li>
    @endforeach
</ul>
