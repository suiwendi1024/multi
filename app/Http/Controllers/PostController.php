<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = \App\Models\Post::query();

        if ($category = \request('category')) {
            $query = \App\Models\Post::ofCategory($category);
        }
        if ($search = \request('search')) {
            $query = \App\Models\Post::where('title', 'like', "%{$search}%")
                ->orWhere('summary', 'like', "%{$search}%");
        }

        $posts = $query->paginate();
        // 翻页链接的路径附加分类和搜索关键词
        $posts->setPath(route('posts.index', ['category' => $category, 'search' => $search]));

        if (\request()->wantsJson()) {
            return PostResource::collection($posts);
        }

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = \App\Models\Post::create($request->validationData());

        return redirect($post->path);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = \App\Models\Post::appendIsLiked()->appendIsFavorited()->find($id);

        $post->increment('views');

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = \App\Models\Post::find($id);

        $this->authorize('update', $post);

        return view('posts.create-edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = \App\Models\Post::find($id);

        $this->authorize('update', $post);
        $post->update($request->validationData());

        return redirect($post->path);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = \App\Models\Post::find($id);

        $this->authorize('delete', $post);
        $post->delete();

        return redirect(route('posts.index'));
    }
}
