<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;

use App\Http\Controllers\OrdenDeAbastecimientoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',function (){
    return view('Home');
});
// Route::get('/',[MaterialController::class,'index']);

Route::resource('material', MaterialController::class);
Route::resource('ordenDeAbastecimiento', OrdenDeAbastecimientoController::class);
