<?php

use Illuminate\Support\Facades\Route;

  Route::group(['prefix'  =>  'admin'], function () {

    Route::get('/login', [App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login.post');
    Route::get('/logout', [App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('admin.login.logout');


    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/', function () { return view('admin.dashboard.index'); })->name('admin.dashboard');
        Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('admin.settings');
        Route::post('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('admin.settings.update');

        Route::group(['prefix'  =>   'categories'], function() {
            Route::get('/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.categories.index');
            Route::get('/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.categories.create');
            Route::post('/store', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.categories.store');
            Route::get('/{id}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.categories.edit');
            Route::post('/update', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.categories.update');
            Route::get('/{id}/delete', [App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('admin.categories.delete');
        });
    //
    //     Route::group(['prefix'  =>   'attributes'], function() {
    //         Route::get('/', [App\Http\Controllers\Admin\AttributeController::class, 'index'])->name('admin.attributes.index');
    //         Route::get('/create', [App\Http\Controllers\Admin\AttributeController::class, 'create'])->name('admin.attributes.create');
    //         Route::post('/store', [App\Http\Controllers\Admin\AttributeController::class, 'store'])->name('admin.attributes.store');
    //         Route::get('/{id}/edit', [App\Http\Controllers\Admin\AttributeController::class, 'edit'])->name('admin.attributes.edit');
    //         Route::post('/update', [App\Http\Controllers\Admin\AttributeController::class, 'update'])->name('admin.attributes.update');
    //         Route::get('/{id}/delete', [App\Http\Controllers\Admin\AttributeController::class, 'delete'])->name('admin.attributes.delete');
    //
    //         Route::get('/{id}/edit-values', [App\Http\Controllers\Admin\AttributeValueController::class, 'editValues'])->name('admin.attribute_values.edit');
    //         Route::post('/update-values', [App\Http\Controllers\Admin\AttributeValueController::class, 'updateValues'])->name('admin.attribute_values.update');
    //         Route::post('/add-values', [App\Http\Controllers\Admin\AttributeValueController::class ,'addValues'])->name('admin.attribute_values.add');
    //         Route::get('/{id}/delete-values', [App\Http\Controllers\Admin\AttributeValueController::class ,'delete'])->name('admin.attribute_values.delete');
    //     });
    //
    //     Route::group(['prefix'  =>   'brands'], function() {
    //         Route::get('/', [App\Http\Controllers\Admin\BrandController::class, 'index'])->name('admin.brands.index');
    //         Route::get('/create', [App\Http\Controllers\Admin\BrandController::class, 'create'])->name('admin.brands.create');
    //         Route::post('/store', [App\Http\Controllers\Admin\BrandController::class, 'store'])->name('admin.brands.store');
    //         Route::get('/{id}/edit', [App\Http\Controllers\Admin\BrandController::class, 'edit'])->name('admin.brands.edit');
    //         Route::post('/update', [App\Http\Controllers\Admin\BrandController::class, 'update'])->name('admin.brands.update');
    //         Route::get('/{id}/delete', [App\Http\Controllers\Admin\BrandController::class, 'delete'])->name('admin.brands.delete');
    //     });
    //
    //     Route::group(['prefix' => 'products'], function () {
    //         Route::get('/', [App\Http\Controllers\Admin\ProductController::class,'index'])->name('admin.products.index');
    //         Route::get('/create', [App\Http\Controllers\Admin\ProductController::class,'create'])->name('admin.products.create');
    //         Route::post('/store', [App\Http\Controllers\Admin\ProductController::class,'store'])->name('admin.products.store');
    //         Route::get('/edit/{id}', [App\Http\Controllers\Admin\ProductController::class,'edit'])->name('admin.products.edit');
    //         Route::post('/update', [App\Http\Controllers\Admin\ProductController::class,'update'])->name('admin.products.update');
    //     });
    //
    });

  });
