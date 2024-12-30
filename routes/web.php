<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});
// Route::get('/{vue_capture?}',function(){
//     return view('welcome');
// })->where('vue-capture','[\/\w\.-]*');

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
