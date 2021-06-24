<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

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
        $query = Post::query();

        if ($category = current(Hashids::decode(\request('category')))) {
            $query = $query->ofCategory($category);
        }
        if ($search = \request('search')) {
            $like = "%{$search}%";
            $query = $query->where('title', 'like', $like)->orWhere('summary', 'like', $like);
        }

        $posts = $query->simplePaginate()->withQueryString();

        // 暴露path属性
        collect($posts->items())->each->setAppends(['path']);

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
        $post = Post::create($request->validationData());

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
        $post = Post::appendIsLiked()->appendIsFavorited()->find($id);
        $comments = $post->comments()->simplePaginate();

        $comments->withPath(route('posts.comments.index', compact('post')));

        $post->increment('views');

        return view('posts.show', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

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
        $post = Post::find($id);

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
        $post = Post::find($id);

        $this->authorize('delete', $post);
        $post->delete();

        return redirect(route('posts.index'));
    }
}
