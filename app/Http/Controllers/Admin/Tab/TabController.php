<?php

namespace App\Http\Controllers\Admin\Tab;

use App\Http\Controllers\Controller;
use App\Models\Tab;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Tab\TabIndexResource;
use App\Http\Resources\Tab\TabShowResource;
use App\Http\Requests\Tab\StoreRequest;
use App\Http\Requests\Tab\UpdateRequest;


class TabController extends Controller
{

    public function index()
    {
        $tabs = Tab::latest()->get();
        return TabIndexResource::collection($tabs);
    }

    public function edit(Tab $tab)
    {
        return new TabShowResource($tab);
    }

     public function store(StoreRequest $request) {
        $data = $request->validated();
        Tab::create($data);
        return response([]);
    }

    // public function update(UpdateRequest $request, Tab $tab)
    // {
    //     $data = $request->validated();
    //     $tab->update($data);
    //     return response([]);
    // }


    public function update(Request $request)
    {
        try {
            $tabs = Tab::findOrFail($request->id);
            $validation = Validator::make($request->all(), [
                'title' => ['required', 'string', 'max:100', 'min:10'],
                'content' => ['required', 'string', 'max:1000', 'min:10'],
            ]);
            if ($validation->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validation->errors()->all(),
                ]);
            } else {

                $tabs->title = $request->title;
                $tabs->status = $request->status;
                $tabs->content = $request->content;
                $result = $tabs->save();
                if ($result) {
                    return response()->json([
                        'success' => true,
                        'message' => "Tab Update Successfully",
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

    }

        public function delete(Tab $tab)
    {
        $tab->delete();
    }




}