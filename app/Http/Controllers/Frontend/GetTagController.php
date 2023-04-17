<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

use App\Http\Resources\Tag\TagIndexResource;
// use App\Http\Resources\Tag\TagShowResource;


class GetTagController extends Controller
{
    public function index()
    {
        $tags = Tag::latest()->get();
        return TagIndexResource::collection($tags);
    }

    public function show($id)
    {
        try {
            $tags = Tag::with('posts')->findOrFail($id);
            $tags->save();
            return response()->json([
                'success' => true,
                'tags' => $tags,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

}