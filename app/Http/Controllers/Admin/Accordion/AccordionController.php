<?php

namespace App\Http\Controllers\Admin\Accordion;

use App\Http\Controllers\Controller;
use App\Models\Accordion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Accordion\AccordionIndexResource;
use App\Http\Resources\Accordion\AccordionShowResource;
use App\Http\Requests\Accordion\StoreRequest;
// use App\Http\Requests\Gallery\UpdateRequest;


class AccordionController extends Controller
{

    public function index()
    {
        $accordions = Accordion::latest()->get();

        return AccordionIndexResource::collection($accordions);
    }

    public function edit(Accordion $accordion)
    {
        return new AccordionShowResource($accordion);
    }

     public function store(StoreRequest $request) {
        $data = $request->validated();
        if ( $data['image']) {
            $data['image'] = Storage::disk('public')->put('/accordions', $data['image']);
        }
        Accordion::create($data);
        return response([]);

    }

    public function update(Request $request)
    {
        try {
            $accordions =Accordion::findOrFail($request->id);
            $validation = Validator::make($request->all(), [
                'title' => ['required', 'string', 'max:100', 'min:10'],
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
                $destination = public_path('storage\\' . $accordions->image);
                if ($request->file('new_image')) {
                    if (File::exists($destination)) {
                        File::delete($destination);
                    }
                    $filename = $request->file('new_image')->store('accordions', 'public');
                } else {
                    $filename = $request->old_image;
                }
                $accordions->title = $request->title;
                $accordions->intro = $request->intro;
                $accordions->status = $request->status;
                $accordions->image = $filename;
                $result = $accordions->save();
                if ($result) {
                    return response()->json([
                        'success' => true,
                        'message' => "Accordion Update Successfully",
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

        public function delete(Accordion $accordion)
    {
        $destination = public_path('storage\\' . $accordion->image);

        if (File::exists($destination)) {
            File::delete($destination);
        }
        $accordion->delete();
    }



}
