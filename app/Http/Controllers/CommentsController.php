<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Votable;
use App\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(Request $request)
    {
        if ($request->has('text') && !empty($request->input('text'))) {
            $post = Post::findOrFail($request->input('post_id'));
            $replied_comment_id = null;
            if ($request->has('comment_id')) {
                $replied_comment_id = Comment::findOrFail($request->input('comment_id'))->id;
            }
            try {
                $comment = new Comment([
                    'content' => $request->input('text'),
                    'user_id' => $request->user()->id,
                    'reply_to_id' => $replied_comment_id
                ]);
                $post->comments()->save($comment);
                $comment = Comment::with('user', 'replies')->find($comment->id);
                return response()->json([
                    'status' => 'ok',
                    'comment' => $comment
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'status' => 'fail',
                    'message' => $e->getMessage()
                ], 400);
            }
        } else {
            return response()->json([
                'status' => 'fail',
                'message' => 'Comment can not be empty'
            ], 400);
        }
    }

    public function edit(Request $request) {
        $comment = Comment::findOrFail($request->input('comment_id'));
        if (empty($request->input('text'))) {
            return response()->json([
                'status' => 'fail',
                'message' => 'The comment can not be empty'
            ], 400);
        }
        if (Gate::denies('comment', $comment)) {
            return abort(403);
        } else {
            $comment->content = $request->input('text');
            $comment->save();
            return response()->json([
                'status' => 'ok',
            ]);
        }
    }

    public function vote(Request $request)
    {
        try {
            Votable::setVote(
                $request->input('votable_type'),
                $request->input('votable_id'),
                $request->input('vote_value'));
            return response()->json([
                'status' => 'ok',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function remove(Request $request) {
        $comment = Comment::findOrFail($request->input('comment_id'));
        if (Gate::denies('comment', $comment)) {
            return abort(403);
        } else {
            if ($comment->replies->isEmpty()) {
                $comment->delete();
                return response()->json([
                    'status' => 'ok'
                ]);
            } else {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Can not remove comment whit replies comments'
                ], 400);
            }
        }
    }
}
