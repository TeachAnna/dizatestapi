<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Tag\TagIndexResource;
use App\Http\Resources\Tag\TagShowResource;
use App\Http\Requests\Tag\StoreRequest;
// use App\Http\Requests\Tag\UpdateRequest;


class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::latest()->get();
        return TagIndexResource::collection($tags);
    }

    public function edit(Tag $tag)
    {
        return new TagShowResource($tag);
    }

     public function store(StoreRequest $request) {
        $data = $request->validated();
        if ( $data['image']) {
            $data['image'] = Storage::disk('public')->put('/tags', $data['image']);
        }
        Tag::create($data);
        // $tag = Tag::firstOrCreate($data);
        return response([]);
    }

    public function update(Request $request)
    {
        try {
            $tags = Tag::findOrFail($request->id);
            $validation = Validator::make($request->all(), [
                'title' => ['required', 'string', 'max:100', 'min:10'],
                // 'intro' => ['required', 'string', 'max:1000', 'min:10'],
                // 'cat_id' => ['required'],
            ]);
            if ($validation->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validation->errors()->all(),
                ]);
            } else {
                $filename = "";
                $destination = public_path('storage\\' . $tags->image);
                if ($request->file('new_image')) {
                    if (File::exists($destination)) {
                        File::delete($destination);
                    }
                    $filename = $request->file('new_image')->store('tags', 'public');
                } else {
                    $filename = $request->old_image;
                }
                $tags->title = $request->title;
                $tags->intro = $request->intro;
                $tags->status = $request->status;
                $tags->image = $filename;
                $result = $tags->save();
                if ($result) {
                    return response()->json([
                        'success' => true,
                        'message' => "Tag Update Successfully",
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

        public function delete(Tag $tag)
    {
        $destination = public_path('storage\\' . $tag->image);

        if (File::exists($destination)) {
            File::delete($destination);
        }
        $tag->delete();
    }

    public function getTotalTag()
    {
        try {
            $tags = Tag::count();
            if ($tags) {
                return response()->json([
                    'success' => true,
                    'tags' => $tags,
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function search($search)
    {
        try {
            $tags = Tag::where('title', 'LIKE', '%' . $search . '%')->orderBy('id', 'desc')->with('posts')->get();
            if ($tags) {
                return response()->json([
                    'success' => true,
                    'tags' => $tags,
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}