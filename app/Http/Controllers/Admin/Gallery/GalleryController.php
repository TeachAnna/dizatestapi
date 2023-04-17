<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Gallery\GalleryIndexResource;
use App\Http\Resources\Gallery\GalleryShowResource;
use App\Http\Requests\Gallery\StoreRequest;
// use App\Http\Requests\Gallery\UpdateRequest;


class GalleryController extends Controller
{

    public function index()
    {
        $galleries = Gallery::latest()->get();
        return GalleryIndexResource::collection($galleries);
    }

    public function edit(Gallery $gallery)
    {
        return new GalleryShowResource($gallery);
    }

     public function store(StoreRequest $request) {
        $data = $request->validated();
        $data['image'] = Storage::disk('public')->put('/galleries', $data['image']);
        Gallery::create($data);
        return response([]);
    }

    public function update(Request $request)
    {
        try {
            $galleries =Gallery::findOrFail($request->id);
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
                $destination = public_path('storage\\' . $galleries->image);
                if ($request->file('new_image')) {
                    if (File::exists($destination)) {
                        File::delete($destination);
                    }
                    $filename = $request->file('new_image')->store('images', 'public');
                } else {
                    $filename = $request->old_image;
                }
                $galleries->title = $request->title;
                $galleries->intro = $request->intro;
                $galleries->status = $request->status;
                $galleries->image = $filename;
                $result = $galleries->save();
                if ($result) {
                    return response()->json([
                        'success' => true,
                        'message' => "gallery Update Successfully",
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

        public function delete(Gallery $gallery)
    {
        $destination = public_path('storage\\' . $gallery->image);

        if (File::exists($destination)) {
            File::delete($destination);
        }
        $gallery->delete();
    }



}
