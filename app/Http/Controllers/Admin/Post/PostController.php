<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Post\PostIndexResource;
use App\Http\Resources\Post\PostShowResource;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;


class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with('category')->latest()->get();
        return PostIndexResource::collection($posts);
    }

    public function edit(Post $post)
    {
        return new PostShowResource($post);
    }

     public function store(StoreRequest $request) {
        $data = $request->validated();
        if ( $data['image']) {
            $data['image'] = Storage::disk('public')->put('/posts', $data['image']);
        }
        $post = Post::firstOrCreate($data);
        $post->tags()->sync(request()->tags);
        return response([]);
    }

    public function update(Request $request)
    {
        try {
            $posts = Post::findOrFail($request->id);
            $validation = Validator::make($request->all(), [
                'title' => ['required', 'string', 'max:100', 'min:10'],
                // 'content' => ['required', 'string', 'max:1000', 'min:10'],
                'category_id' => ['required'],
            ]);
            if ($validation->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validation->errors()->all(),
                ]);
            } else {
                $filename = "";
                $destination = public_path('storage\\' . $posts->image);
                if ($request->file('new_image')) {
                    if (File::exists($destination)) {
                        File::delete($destination);
                    }
                    $filename = $request->file('new_image')->store('posts', 'public');
                } else {
                    $filename = $request->old_image;
                }
                $posts->title = $request->title;
                $posts->content = $request->content;
                $posts->category_id = $request->category_id;
                $posts->intro = $request->intro;
                $posts->slug = $request->slug;
                $posts->author = $request->author;
                $posts->meta_description = $request->meta_description;
                $posts->meta_key = $request->meta_key;
                $posts->meta_title = $request->meta_title;
                $posts->status = $request->status;
                $posts->image = $filename;
                $posts->tags()->sync(request()->tags);
                $result = $posts->save();
                if ($result) {
                    return response()->json([
                        'success' => true,
                        'message' => "Post Update Successfully",
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => "Some Problem",
                    ]);
                }
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

        public function delete(Post $post)
    {
        $destination = public_path('storage\\' . $post->image);

        if (File::exists($destination)) {
            File::delete($destination);
        }
        $post->delete();
    }

}