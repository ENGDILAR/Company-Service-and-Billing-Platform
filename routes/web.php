<?php

use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TableController;
use App\Models\Product;
use App\Models\Row;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $products=Product::all();
    $services = Service::all();
    return view('Welcome',compact(['products','services']));
});

Route::get('/Login',function(){
return view('signin');
})->name('Sigin');

Route::middleware('auth')->group(function () {


 Route::get('admin/dashboard',[UserController::class,'index'])  ->name('dashboard');


  Route::get('Tables/All',[TableController::class,'index'])  ->name('Table.all');
  Route::get('Table/Create',[TableController::class,'Create'])  ->name('Table.Create');
  Route::post('Table/Store',[TableController::class,'Store'])  ->name('Table.Store');
  Route::get('Table/{id}/edit',[TableController::class,'Edit'])  ->name('Table.Edit');
  Route::put('Table/{id}',[TableController::class,'Update'])  ->name('Table.Update');
  Route::delete('Table/Delete/{id}',[TableController::class,'Destroy'])  ->name('Table.Destroy');
  Route::get('/tables/{id}/print', [TableController::class, 'print'])->name('Table.Print');


 Route::get('Product/All',[ProductController::class,'index'])->name('Product.all');
 Route::post('Product/Addnew',[ProductController::class,'store'])->name('Product.store');
 Route::put('Product/{id}',[ProductController::class,'update'])->name('Product.update');
 Route::delete('Product/{id}',[ProductController::class,'destroy'])->name('Product.destroy');

 Route::get('Services/All',[ServiceController::class,'index'])->name('Services.index');
  Route::post('Services/Addnew',[ServiceController::class,'store'])->name('Services.store');
 Route::put('Services/{id}',[ServiceController::class,'update'])->name('Services.update');
 Route::delete('Services/{id}',[ServiceController::class,'destroy'])->name('Services.destroy');



});
require __DIR__.'/auth.php';
