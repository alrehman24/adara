<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeBanner;
use Illuminate\Http\Request;
use Validator;

class HomeBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=HomeBanner::get();
        return view('admin.HomeBanner.home_banner',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validationRules = [
            'text' => 'required|string',
            'link' => 'required|string'
        ];

        if ($request->hasFile('image')) {
            $validationRules['image'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        $validation = Validator::make($request->all(), $validationRules);

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validation->messages()
            ]);
        }

        $userData = [
            'text' => $request->text,
            'link' => $request->link
        ];

        if ($request->hasFile('image')) {
            $image_name = $request->name . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/'), $image_name);
            $userData['image'] = 'images/'.$image_name;
        }

        try {
            HomeBanner::updateOrCreate(
                ['id' => $request->id],
                $userData
            );

            return response()->json([
                'status' => 200,
                'message' => 'Banner updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error updating banner: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
