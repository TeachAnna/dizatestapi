<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;
use App\Http\Resources\Slide\SlideIndexResource;

class GetSlideController extends Controller
{
    public function index()
    {
        $slides = Slide::latest()->get();
        return SlideIndexResource::collection($slides);
    }
}
