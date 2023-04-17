<?php

namespace App\Http\Controllers\Admin\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\Comment\CommentIndexResource;

class CommentController extends Controller
{
    public function getComments()
    {
        $comments = Comment::latest()->get();
        return CommentIndexResource::collection($comments);
    }

    public function delete(Comment $comment)
    {
        $comment->delete();
    }

}
