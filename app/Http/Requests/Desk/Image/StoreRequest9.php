<?php

namespace App\Http\Controllers\Desk\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\Desk\Image\StoreRequest;

use App\Models\Desk;
use Carbon\Carbon;
use App\Models\Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function store(StoreRequest $request) {


        $data = $request->validated();
        $image = $data['image'];
        $name =md5(Carbon::now() . '_' . $image->getClientOriginalName()) . '_' . $image->getClientOriginalExtension();
        $filePath = Storage::disk('public')->putFileAs('/images', $image, $name);

        return response()->json(['url' => url('/storage/' . $filePath)]);
    }
}
