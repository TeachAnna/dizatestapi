<?php

namespace App\Http\Controllers\Admin\Desk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\Desk\DeskIndexResource;

use App\Models\Desk;


class IndexController extends Controller
{
    public function index() {

        $desks = Desk::latest()->get();

        return DeskIndexResource::collection($desks);
    }
}
