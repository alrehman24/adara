<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function deleteData($id, $table)
    {
        DB::table($table)->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Data deleted successfully.');
    }

}
