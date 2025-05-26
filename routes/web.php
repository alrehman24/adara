<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use Illuminate\Support\Facades\Auth;
//use App\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    //return view('admin.');
    return view('index');
});
Route::get('/apiDocs', function () {
    return view('apiDocs');
});
Route::get('/login', function () {
    return view('auth.signin');
});
Route::post('/login_user', [AuthController::class, 'loginUser']);
Route::get('/logout', function () {
    Auth::logout();
   return redirect('login');
});
//Route::get('/createCustomer',[AuthController::class,'createCustomer']);
// Route::get('/createRole', function () {
//     $role = new Role();
//     $role->name = 'Customer';
//     $role->slug = 'customer';
//     $role->save();
// });
