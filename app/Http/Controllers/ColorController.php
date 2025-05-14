<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\color;
class ColorController extends Controller
{
    public function index()
    {
        $data=color::get();
        return view('admin.Color.color',get_defined_vars());
    }
    public function store(Request $request)
    {
        $validationRules = [
            'text' => 'required|string',
             'value' => 'required|string'
        ];



        $validation = Validator::make($request->all(), $validationRules);

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validation->messages()
            ]);
        }

        $userData = [
            'text' => $request->text,
            'value' => $request->text

        ];



        try {
            color::updateOrCreate(
                ['id' => $request->id],
                $userData
            );

            return response()->json([
                'status' => 200,
                'message' => 'Color updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error updating color: ' . $e->getMessage()
            ]);
        }
    }
}
