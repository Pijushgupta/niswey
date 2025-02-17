<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Contacts ;

Route::get('/', function () {
   return Inertia::render('Home');
});
Route::get('/submitFile',function(){
   return redirect('/');
});

Route::post('/submitFile',[Contacts::class,'storFile'])->name('save-file');
Route::get('/contacts',[Contacts::class,'contacts']);
Route::get('/edit',[Contacts::class,'edit']);
Route::post('/save',[Contacts::class,'save']);
Route::get('/delete',[Contacts::class,'delete']);