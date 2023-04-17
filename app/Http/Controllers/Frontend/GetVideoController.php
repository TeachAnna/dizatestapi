<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Http\Resources\Video\VideoIndexResource;

class GetVideoController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->get();
        return VideoIndexResource::collection($videos);
    }
}
