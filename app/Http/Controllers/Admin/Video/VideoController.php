<?php

namespace App\Http\Controllers\Admin\Video;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Video\VideoIndexResource;
use App\Http\Resources\Video\VideoShowResource;
use App\Http\Requests\Video\StoreRequest;
// use App\Http\Requests\Gallery\UpdateRequest;


class VideoController extends Controller
{

    public function index()
    {
        $videos = Video::latest()->get();

        return VideoIndexResource::collection($videos);
    }

    public function edit(Video $video)
    {
        return new VideoShowResource($video);
    }

     public function store(StoreRequest $request) {
        $data = $request->validated();
        Video::create($data);
        return response([]);
    }

    public function update(Request $request)
    {
        try {
            $videos =Video::findOrFail($request->id);
            $validation = Validator::make($request->all(), [
                'title' => ['required', 'string', 'max:100', 'min:10'],
            ]);
            if ($validation->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validation->errors()->all(),
                ]);
            } else {

                $videos->title = $request->title;
                $videos->url = $request->url;
                $videos->intro = $request->intro;
                $videos->status = $request->status;
                $result = $videos->save();
                if ($result) {
                    return response()->json([
                        'success' => true,
                        'message' => "video Update Successfully",
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

        public function delete(Video $video)
    {
        $destination = public_path('storage\\' . $video->image);

        if (File::exists($destination)) {
            File::delete($destination);
        }
        $video->delete();
    }



}
