<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Http\Resources\Gallery\GalleryIndexResource;

class GetGalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->get();
        return GalleryIndexResource::collection($galleries);
    }
}
