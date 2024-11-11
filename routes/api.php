<?php

use App\Http\Controllers\Accesscontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/login', [Accesscontroller::class, 'login']);
Route::post('/useradd', [Accesscontroller::class, 'useradd']);
Route::post('/updateuser/{id}', [Accesscontroller::class, 'updateUser']);
Route::get('/useredit/{id}', [Accesscontroller::class, 'UserEdit']);
Route::get('/userdelete/{id}', [Accesscontroller::class, 'UserDelete']);