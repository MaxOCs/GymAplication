<?php

use App\Http\Controllers\CategoriaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/upload', [UploadController::class, 'upload']);
