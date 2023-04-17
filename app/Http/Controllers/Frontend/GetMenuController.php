<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Http\Resources\Menu\MenuIndexResource;

class GetMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::latest()->get();
        return MenuIndexResource::collection($menus);
    }
}
