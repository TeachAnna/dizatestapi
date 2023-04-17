<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Http\Resources\Item\ItemIndexResource;

class GetItemController extends Controller
{
    public function index()
    {
        $items = Item::latest()->get();
        return ItemIndexResource::collection($items);
    }
}
