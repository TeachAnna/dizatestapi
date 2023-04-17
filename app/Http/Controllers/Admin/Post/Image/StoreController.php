<?php

namespace App\Http\Controllers\Admin\Post\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\Image\StoreRequest;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function store(StoreRequest $request)
    {

        $data = $request->validated();
        $image = $data['image'];
        $name =md5(Carbon::now() . '_' . $image->getClientOriginalName()) . '_' . $image->getClientOriginalExtension();
        $filePath = Storage::disk('public')->putFileAs('/images/editor', $image, $name);

        return response()->json(['url' => url('/storage/' . $filePath)]);
    }
}