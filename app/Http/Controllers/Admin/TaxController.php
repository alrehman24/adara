<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tax;
use Validator;


class TaxController extends Controller
{
    public function index()
    {
        $data=Tax::get();
        return view('admin.Tax.tax',get_defined_vars());
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
            Tax::updateOrCreate(
                ['id' => $request->id],
                $userData
            );

            return response()->json([
                'status' => 200,
                'message' => 'Tax updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error updating Tax: ' . $e->getMessage()
            ]);
        }
    }
}
