<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\CommentPosted;
use App\Http\Requests\StoreComment;
use App\Models\Comment;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Http\Resources\Comment as CommentResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PostCommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->only(['store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(BlogPost $post, Request $request)
    {
        $perPage = $request->input('per_page') ?? 15;
        return CommentResource::collection(
            $post->comments()->with('user')->paginate($perPage)->appends(
                [
                    'per_page' => $perPage
                ]
            )
        );
    }
// use this command in postman for above http://127.0.0.1:8000/api/v1/posts/4/comments?per_page=2$page=1
// nb above was  $post->comments()->with('user')->get()  //comment out when adding in pagination in lecture 256/7


    /**
     * Store a newly created resource in storage.
     *
     * @param BlogPost $post
     * @param StoreComment $request
     * @return CommentResource
     */
    public function store(BlogPost $post, StoreComment $request)
    {
        $comment = $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id
        ]);
        event(new CommentPosted($comment));


        return new CommentResource($comment);
    }
//Note http://127.0.0.1:8000/api/v1/posts/1/comments?api_token=


    /**
     * Display the specified resource.
     *
     * @param BlogPost $post
     * @param Comment $comment
     * @return CommentResource
     */
    public function show(BlogPost $post, Comment $comment)
    {
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BlogPost $post
     * @param Comment $comment
     * @param StoreComment $request
     * @return CommentResource
     * @throws AuthorizationException
     */
    public function update(BlogPost $post, Comment $comment, StoreComment $request)
    {
        $this->authorize($comment);
        $comment->content = $request->input('content');
        $comment->save();

        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BlogPost $post
     * @param Comment $comment
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(BlogPost $post, Comment $comment)
    {
        $this->authorize($comment);
        $comment->delete();

        return response()->noContent();
    }
}
