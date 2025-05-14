<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Auth;
use App\Traits\ApiResponse;

class ProfileController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.profile');
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
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . Auth::User()->id
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
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'fb_link' => $request->fb_link,
            'insta_link' => $request->insta_link,
            'twitter_link' => $request->twitter_link
        ];

        if ($request->hasFile('image')) {
            $image_name = $request->name . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/'), $image_name);
            $userData['image'] = 'images/'.$image_name;
        }

        try {
            User::updateOrCreate(
                ['id' => Auth::User()->id],
                $userData
            );

            // return response()->json([
            //     'status' => 200,
            //     'message' => 'Profile Updated Successfully'
            // ]);
            return $this->success([],'Profile Updated Successfully');
        } catch (\Exception $e) {
            // return response()->json([
            //     'status' => 500,
            //     'message' => 'Error updating profile'
            // ]);
            return $this->error([],'Error updating profile');
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
