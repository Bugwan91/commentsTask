<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{

    public function __construct()
    {
    }

    public function showPost(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        return view('post', [
            'post' => $post
        ]);
    }

    public function getComments(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $comments = Comment::where('post_id', $post->id)->whereNull('reply_to_id')->with('user')->orderBy('id', 'desc')->get();
        foreach ($comments as $comment) {
            $comment->parseAllReplies();
        }
        return response()->json([
            'status' => 'ok',
            'comments' => $comments,
        ]);
    }
}
