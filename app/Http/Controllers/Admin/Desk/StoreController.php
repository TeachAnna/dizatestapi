<?php

namespace App\Http\Controllers\Admin\Desk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use App\Http\Requests\Desk\StoreRequest;
use Carbon\Carbon;
use App\Models\Image;
use App\Models\Desk;


class StoreController extends Controller
{
    public function store(StoreRequest $request) {
        $data = $request->validated();

        $images = $data['images'];
        unset($data['images']);

        $desk = Desk::firstOrCreate($data);

        foreach ($images as $image) {
            $name =md5(Carbon::now() . '_' . $image->getClientOriginalName()) . '_' . $image->getClientOriginalExtension();
            $filePath = Storage::disk('public')->putFileAs('/images', $image, $name);

            Image::create([
                'path' => $filePath,
                'url' => url('/storage/' . $filePath),
                'desk_id' => $desk->id
            ]);
        }

    }
}
