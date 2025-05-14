<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use Validator;
class sizeController extends Controller
{
    public function index()
    {
        $data=Size::get();
        return view('admin.Size.size',get_defined_vars());
    }
    public function store(Request $request)
    {
        $validationRules = [
            'text' => 'required|string'
        ];



        $validation = Validator::make($request->all(), $validationRules);

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validation->messages()
            ]);
        }

        $userData = [
            'text' => $request->text
        ];



        try {
            Size::updateOrCreate(
                ['id' => $request->id],
                $userData
            );

            return response()->json([
                'status' => 200,
                'message' => 'Size updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error updating size: ' . $e->getMessage()
            ]);
        }
    }
}
