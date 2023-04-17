<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GetLikeController extends Controller
{
    public function store(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'like' => ['required'],

        ]);
        if ($validation->fails()) {
            return response()->json([
                'success' => true,
                'message' => $validation->errors()->all(),
            ]);
        } else {
            $result = Like::create([
                'post_id' => $id,
                'like' => $request->like,
            ]);
            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => 'Like Successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Some Problem'
                ]);
            }
        }
    }

    public function getLikes()
    {
        try {
            $likes = Like::orderBy('id', 'desc')->get();

            return response()->json([
                'success' => true,
                'likes' => $likes
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
