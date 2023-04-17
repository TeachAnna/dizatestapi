<?php

namespace App\Http\Controllers\Admin\Link;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Link\LinkIndexResource;
use App\Http\Resources\Link\LinkShowResource;
use App\Http\Requests\Link\StoreRequest;
// use App\Http\Requests\Link\UpdateRequest;


class LinkController extends Controller
{

    public function index()
    {
        $links = Link::latest()->get();
        return LinkIndexResource::collection($links);
    }

    public function edit(Link $link)
    {
        return new LinkShowResource($link);
    }

     public function store(StoreRequest $request) {
        $data = $request->validated();
        $data['image'] = Storage::disk('public')->put('/links', $data['image']);
        Link::create($data);
        return response([]);
    }

    public function update(Request $request)
    {
        try {
            $links = Link::findOrFail($request->id);
            $validation = Validator::make($request->all(), [
                'title' => ['required', 'string'],
                // 'url' => ['required', 'string', 'max:1000', 'min:10'],
                // 'cat_id' => ['required'],
            ]);
            if ($validation->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validation->errors()->all(),
                ]);
            } else {
                $filename = "";
                $destination = public_path('storage\\' . $links->image);
                if ($request->file('new_image')) {
                    if (File::exists($destination)) {
                        File::delete($destination);
                    }
                    $filename = $request->file('new_image')->store('links', 'public');
                } else {
                    $filename = $request->old_image;
                }
                $links->title = $request->title;
                $links->status = $request->status;
                $links->url = $request->url;
                $links->image = $filename;
                $result = $links->save();
                if ($result) {
                    return response()->json([
                        'success' => true,
                        'message' => "Link Update Successfully",
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

        public function delete(Link $link)
    {
        $destination = public_path('storage\\' . $link->image);

        if (File::exists($destination)) {
            File::delete($destination);
        }
        $link->delete();
    }



}