<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Response;
use App\Http\Resources\Response\ResponseIndexResource;

class GetResponseController extends Controller
{
    public function index()
    {
        $responses = Response::latest()->get();
        return ResponseIndexResource::collection($responses);
    }
}
