<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tab;
use App\Http\Resources\Tab\TabIndexResource;

class GetTabController extends Controller
{
    public function index()
    {
        $tabs = Tab::latest()->get();
        return TabIndexResource::collection($tabs);
    }
}
