<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Throwable;

class CommentController extends BaseController
{
    /**
     * Display a listing of comments for a product.
     * GET /api/comments?product_id=1
     */
    public function index(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $comments = Comment::with('user:id,name')
            ->where('product_id', $request->product_id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $comments,
        ]);
    }

    /**
     * Store a newly created comment.
     * POST /api/comments
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'product_id' => ['required', 'exists:products,id'],
                'comment' => ['required', 'string'],
            ]);

            $comment = Comment::create([
                'product_id' => $request->productId,
                'user_id' => Auth::id(),
                'comment' => $request->comment,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Comment added successfully',
                'data' => $comment,
            ], 201);
        } catch (Throwable $t) {
            return $this->sendError($t->getMessage());
        }
    }

    /**
     * Display a specific comment.
     * GET /api/comments/{comment}
     */
    public function show(Comment $comment)
    {
        return response()->json([
            'success' => true,
            'data' => $comment->load('user:id,name'),
        ]);
    }

    /**
     * Update a comment.
     * PUT /api/comments/{comment}
     */
    public function update(Request $request, Comment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 403);
        }

        $request->validate([
            'comment' => ['required', 'string'],
        ]);

        $comment->update([
            'comment' => $request->comment,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment updated successfully',
            'data' => $comment,
        ]);
    }

    /**
     * Remove a comment.
     * DELETE /api/comments/{comment}
     */
    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 403);
        }

        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Comment deleted successfully',
        ]);
    }
}
