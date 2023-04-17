<?php

namespace App\Http\Controllers\Admin\Response;

use App\Http\Controllers\Controller;
use App\Models\Response;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Response\ResponseIndexResource;
use App\Http\Resources\Response\ResponseShowResource;
use App\Http\Requests\Response\StoreRequest;
// use App\Http\Requests\Gallery\UpdateRequest;


class ResponseController extends Controller
{

    public function index()
    {
        $responses = Response::latest()->get();

        return ResponseIndexResource::collection($responses);
    }

    public function edit(Response $response)
    {
        return new ResponseShowResource($response);
    }

     public function store(StoreRequest $request) {
        $data = $request->validated();
        if ( $data['image']) {
            $data['image'] = Storage::disk('public')->put('/responses', $data['image']);
        }
        Response::create($data);
        return response([]);

    }

    public function update(Request $request)
    {
        try {
            $responses =Response::findOrFail($request->id);
            $validation = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:100', 'min:10'],
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
                $destination = public_path('storage\\' . $responses->image);
                if ($request->file('new_image')) {
                    if (File::exists($destination)) {
                        File::delete($destination);
                    }
                    $filename = $request->file('new_image')->store('slides', 'public');
                } else {
                    $filename = $request->old_image;
                }
                $responses->name = $request->name;
                $responses->email = $request->email;
                $responses->intro = $request->intro;
                $responses->status = $request->status;
                $responses->image = $filename;
                $result = $responses->save();
                if ($result) {
                    return response()->json([
                        'success' => true,
                        'message' => "response Update Successfully",
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

        public function delete(Response $response)
    {
        $destination = public_path('storage\\' . $response->image);

        if (File::exists($destination)) {
            File::delete($destination);
        }
        $response->delete();
    }



}
