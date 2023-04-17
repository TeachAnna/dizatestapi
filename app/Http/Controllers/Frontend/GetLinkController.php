<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Link;
use App\Http\Resources\Link\LinkIndexResource;

class GetLinkController extends Controller
{
    public function index()
    {
        $links = Link::latest()->get();
        return LinkIndexResource::collection($links);
    }
}
