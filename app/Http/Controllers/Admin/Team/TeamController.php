<?php

namespace App\Http\Controllers\Admin\Team;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Team\TeamIndexResource;
use App\Http\Resources\Team\TeamShowResource;
use App\Http\Requests\Team\StoreRequest;
// use App\Http\Requests\Team\UpdateRequest;


class TeamController extends Controller
{

    public function index()
    {
        $teams = Team::latest()->get();
        return TeamIndexResource::collection($teams);
    }

    public function edit(Team $team)
    {
        return new TeamShowResource($team);
    }

     public function store(StoreRequest $request) {
        $data = $request->validated();
        if ( $data['image']) {
            $data['image'] = Storage::disk('public')->put('/teams', $data['image']);
        }
        Team::create($data);
        return response([]);
    }

    public function update(Request $request)
    {
        try {
            $teams = Team::findOrFail($request->id);
            $validation = Validator::make($request->all(), [
                'name' => ['required', 'string'],
                // 'intro' => ['required', 'string', 'max:1000', 'min:10'],
                // 'cat_id' => ['required'],
            ]);
            if ($validation->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validation->errors()->all(),
                ]);
            } else {
                $filename = "";
                $destination = public_path('storage\\' . $teams->image);
                if ($request->file('new_image')) {
                    if (File::exists($destination)) {
                        File::delete($destination);
                    }
                    $filename = $request->file('new_image')->store('tags', 'public');
                } else {
                    $filename = $request->old_image;
                }
                $teams->name = $request->name;
                $teams->intro = $request->intro;
                $teams->status = $request->status;
                $teams->position = $request->position;
                $teams->phone = $request->phone;
                $teams->image = $filename;
                $result = $teams->save();
                if ($result) {
                    return response()->json([
                        'success' => true,
                        'message' => "Team Update Successfully",
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => "Some Problem",
                    ]);
                }
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

        // $data = $request->validated();
        // $data['image'] = Storage::disk('public')->put('/', $data['image']);
        // $tag->update($data);
        // return response([]);
    }

        public function delete(Team $team)
    {
        $destination = public_path('storage\\' . $team->image);

        if (File::exists($destination)) {
            File::delete($destination);
        }
        $team->delete();
    }




}
