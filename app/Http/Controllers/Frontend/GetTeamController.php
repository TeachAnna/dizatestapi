<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Http\Resources\Team\TeamIndexResource;

class GetTeamController extends Controller
{
    public function index()
    {
        $teams = Team::latest()->get();
        return TeamIndexResource::collection($teams);
    }
}
