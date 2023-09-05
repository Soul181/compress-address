<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

Route::get('/',       [MainController::class, 'index']);

Route::get('/{path}', [MainController::class, 'redirect_to']);

Route::post('/store', [MainController::class, 'store']);