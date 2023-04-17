<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Exception;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\File;
// use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Menu\MenuIndexResource;
use App\Http\Resources\Menu\MenuShowResource;
use App\Http\Requests\Menu\StoreRequest;
use App\Http\Requests\Menu\UpdateRequest;


class MenuController extends Controller
{

    public function index()
    {
        $menus = Menu::latest()->get();
        return MenuIndexResource::collection($menus);
    }

    public function edit(Menu $menu)
    {
        return new MenuShowResource($menu);
    }

     public function store(StoreRequest $request) {
        $data = $request->validated();
        Menu::create($data);
        return response([]);
    }

    public function update(UpdateRequest $request, Menu $menu)
    {
        $data = $request->validated();
        $menu->update($data);
        return response([]);
    }

        public function delete(Menu $menu)
    {
        $menu->delete();
    }




}