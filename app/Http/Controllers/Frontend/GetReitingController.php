<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Reiting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GetReitingController extends Controller
{
    public function store(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'reiting' => ['required'],

        ]);
        if ($validation->fails()) {
            return response()->json([
                'success' => true,
                'message' => $validation->errors()->all(),
            ]);
        } else {
            $result = Reiting::create([
                'post_id' => $id,
                'reiting' => $request->reiting,
            ]);
            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => 'Reinting Successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Some Problem'
                ]);
            }
        }
    }

    public function getReitings()
    {
        try {
            $reitings = Reiting::orderBy('id', 'desc')->get();

            return response()->json([
                'success' => true,
                'reitings' => $reitings
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}