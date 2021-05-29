<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function index(int $id)
    {
        if (\request()->wantsJson()) {
            $comments = \App\Models\Comment::appendIsLiked()
                ->whereCommentableType('App\Models\\' . ucfirst(\request()->route()->parameterNames()[0]))
                ->whereCommentableId($id)
                ->paginate();

            return CommentResource::collection($comments);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        if ($request->wantsJson()) {
            $comment = \App\Models\Comment::create($request->validationData())->setAttribute('likes_count', 0);

            return CommentResource::make($comment);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\request()->wantsJson()) {
            $comment = \App\Models\Comment::find($id);

            $this->authorize('delete', $comment);
            $comment->delete();

            return response()->noContent();
        }
    }
}
