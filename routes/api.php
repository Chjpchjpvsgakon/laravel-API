<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dummyApi;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get("data", [dummyApi::class, 'getData']);
Route::get("list", [DeviceController::class, 'list']);//get all data

//Thêm ? vào id để sử dụng giá trị mặc định cho id tránh trong trường hợp ko truyền id lên url báo lỗi 404.
Route::get("listbyid/{id?}", [DeviceController::class, 'listbyid']); //get data by id


//Post method
Route::post("add", [DeviceController::class, 'addDevice']);

//Put - updated method
Route::put("put", [DeviceController::class, 'updateDevice']);

//search
Route::get("search/{name}", [DeviceController::class, 'search']);

//delete
Route::delete("delete/{id}", [DeviceController::class, 'delete']);

//validate data
Route::post("testvalidate", [DeviceController::class, 'testvalidate']);


//API RESOURCE
 //Route::apiResource("member", MemberController::class);


//Auth Sanctum
Route::post("login", [UserController::class, 'index']);
//check auth bang cach send token to header {add Bearer token} to value ko hieu vi sao phai la Bearer
Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    Route::apiResource("member", MemberController::class);
});


//Upload File
Route::post("upload", [FileController::class, 'upload']);