<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Resources\Post\PostShowResource;
use App\Http\Resources\Post\PostIndexResource;

class GetPostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->where('status', '=', 'true')->get();
        return PostIndexResource::collection($posts);
    }

    //  public function index()
    //  {
    //      try {
    //          $posts = Post::with('categorys')->with('tags')->latest()->get();
    //          return response()->json([
    //              'success' => true,
    //              'posts' => $posts
    //          ]);
    //      } catch (\Exception $e) {
    //          return response()->json([
    //              'success' => false,
    //              'message' => $e->getMessage(),
    //          ]);
    //      }
    //  }


        //   public function tags()
        //   {
        //       try {
        //           $tags = Tag::with('posts')->latest()->get();
        //           return response()->json([
        //               'success' => true,
        //               'tags' => $tags
        //           ]);
        //       } catch (\Exception $e) {
        //           return response()->json([
        //               'success' => false,
        //               'message' => $e->getMessage(),
        //           ]);
        //       }
        //   }


    public function popularPost()
       {
        $posts = Post::latest()->where('views', '>', 4)->limit(3)->get();
        return PostIndexResource::collection($posts);
       }


    public function latestPost()
       {
        $posts = Post::latest()->limit(3)->get();
        return PostIndexResource::collection($posts);
       }


    public function show($id)
    {
        try {
            $posts = Post::with('category')->with('tags')->findOrFail($id);
            $posts->views = $posts->views + 1;
            $posts->save();
            return response()->json([
                'success' => true,
                'posts' => $posts
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function getPostByCategory($id)
    {
        try {
            $posts = Post::with('category')->where('category_id', $id)->latest()->get();
            return response()->json([
                'success' => true,
                'posts' => $posts,
                // 'category' => $category,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function getPostByTag($id)
    {
        try {

            $posts = Post::with('category')->latest()->get();

            return response()->json([
                'success' => true,
                'posts' => $posts,
                // 'category' => $category,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

}
