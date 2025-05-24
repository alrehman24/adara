<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Attribute;
use App\Models\AttributeValue;

use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index_attribute_name()
    {
        $data=Attribute::get();
        return view('admin.Attribute.attribute',get_defined_vars());
    }
    public function store_attribute_name(Request $request)
    {
        $validationRules = [
            'name' => 'required|string'
        ];

        $validation = Validator::make($request->all(), $validationRules);

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validation->messages()
            ]);
        }

        $userData = [
            'name' => $request->name,
            'slug' => $request->slug

        ];



        try {
            Attribute::updateOrCreate(
                ['id' => $request->id],
                $userData
            );

            return response()->json([
                'status' => 200,
                'message' => 'Attribute updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error updating attribute: ' . $e->getMessage()
            ]);
        }
    }
    public function index_attribute_value()
    {
        $data=AttributeValue::with('attribute')->get();
//         echo '<pre>';
//         print_r($data->toArray());
// exit;
        $attribute=Attribute::get();
        return view('admin.Attribute.attribute_value',get_defined_vars());
    }
    public function store_attribute_value(Request $request)
    {
        $validationRules = [
            'attribute_id' => 'required|exists:attributes,id',
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
            'value' => $request->value,
            'attribute_id' => $request->attribute_id

        ];



        try {
            AttributeValue::updateOrCreate(
                ['id' => $request->id],
                $userData
            );

            return response()->json([
                'status' => 200,
                'message' => 'Attribute value updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error updating Attribute: ' . $e->getMessage()
            ]);
        }
    }
}
