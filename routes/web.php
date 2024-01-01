<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\ProductController;


Route::get('/', [ProductController::class,'index'])->name('products.index');
Route::get('products/create', [ProductController::class,'create'])->name('products.create');
Route::post('products/store', [ProductController::class,'store'])->name('products.store');
Route::get('products/{id}/edit',[ProductController::class,'edit']);
Route::put('products/{id}/update',[ProductController::class,'update']);
Route::delete('products/{id}/delete',[ProductController::class,'destory']);
Route::delete('/products/{id}/force-delete',[ProductController::class,'forceDelete'])->name('products.forceDelete');
Route::get('products/{id}/restore',[ProductController::class,'restore'])->name('products.restore');
Route::get('products/{id}/show',[ProductController::class,'show']);
Route::get('/products/trash', [ProductController::class,'trash'])->name('products.trash');

