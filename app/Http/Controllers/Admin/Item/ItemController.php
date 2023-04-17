<?php

namespace App\Http\Controllers\Admin\Item;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Item\ItemIndexResource;
use App\Http\Resources\Item\ItemShowResource;
use App\Http\Requests\Item\StoreRequest;
// use App\Http\Requests\Item\UpdateRequest;


class ItemController extends Controller
{

    public function index()
    {
        $items = Item::latest()->get();
        return ItemIndexResource::collection($items);
    }

    public function edit(Item $item)
    {
        return new ItemShowResource($item);
    }

     public function store(StoreRequest $request) {
        $data = $request->validated();
        if ( $data['image']) {
             $data['image'] = Storage::disk('public')->put('/items', $data['image']);
        }
        Item::create($data);
        return response([]);
    }

    public function update(Request $request)
    {
        try {
            $items = Item::findOrFail($request->id);
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
                $destination = public_path('storage\\' . $items->image);
                if ($request->file('new_image')) {
                    if (File::exists($destination)) {
                        File::delete($destination);
                    }
                    $filename = $request->file('new_image')->store('items', 'public');
                } else {
                    $filename = $request->old_image;
                }
                $items->title = $request->title;
                $items->intro = $request->intro;
                $items->status = $request->status;
                $items->content = $request->content;
                $items->image = $filename;
                $result = $items->save();
                if ($result) {
                    return response()->json([
                        'success' => true,
                        'message' => "Item Update Successfully",
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

        // $data = $request->validated();
        // $data['image'] = Storage::disk('public')->put('/', $data['image']);
        // $tag->update($data);
        // return response([]);
    }

        public function delete(Item $item)
    {
        $destination = public_path('storage\\' . $item->image);

        if (File::exists($destination)) {
            File::delete($destination);
        }
        $item->delete();
    }



}
