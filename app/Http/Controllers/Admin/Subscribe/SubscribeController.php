<?php

namespace App\Http\Controllers\Admin\Subscribe;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use App\Http\Resources\Subscribe\SubscribeIndexResource;

class SubscribeController extends Controller
{
    public function index()
    {
        $subscribs = Subscribe::latest()->get();
        return SubscribeIndexResource::collection($subscribs);
    }

    public function delete(Subscribe $subscribe)
    {
        $subscribe->delete();
    }

}
