<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[PageController::class,'index']);
Route::post('/',[PageController::class,'store']);
Route::get('/test',function(){
    $day_arr = [date('D')];
    // $day_arr[]= date('D',strtotime("-1 day"));
    for($i=1;$i<=6;$i++){
        $day_arr[] = date('D',strtotime("-$i day"));
    }
    return $day_arr;
});

