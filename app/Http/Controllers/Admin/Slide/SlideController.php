<?php

namespace App\Http\Controllers\Admin\Slide;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Slide\SlideIndexResource;
use App\Http\Resources\Slide\SlideShowResource;
use App\Http\Requests\Slide\StoreRequest;
// use App\Http\Requests\Gallery\UpdateRequest;


class SlideController extends Controller
{

    public function index()
    {
        $slides = Slide::latest()->get();

        return SlideIndexResource::collection($slides);
    }

    public function edit(Slide $slide)
    {
        return new SlideShowResource($slide);
    }

     public function store(StoreRequest $request) {
        $data = $request->validated();
        if ( $data['image']) {
            $data['image'] = Storage::disk('public')->put('/slides', $data['image']);
        }
        Slide::create($data);
        return response([]);

    }

    public function update(Request $request)
    {
        try {
            $slides =Slide::findOrFail($request->id);
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
                $destination = public_path('storage\\' . $slides->image);
                if ($request->file('new_image')) {
                    if (File::exists($destination)) {
                        File::delete($destination);
                    }
                    $filename = $request->file('new_image')->store('slides', 'public');
                } else {
                    $filename = $request->old_image;
                }
                $slides->title = $request->title;
                $slides->intro = $request->intro;
                $slides->status = $request->status;
                $slides->image = $filename;
                $result = $slides->save();
                if ($result) {
                    return response()->json([
                        'success' => true,
                        'message' => "slide Update Successfully",
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

        public function delete(Slide $slide)
    {
        $destination = public_path('storage\\' . $slide->image);

        if (File::exists($destination)) {
            File::delete($destination);
        }
        $slide->delete();
    }



}
