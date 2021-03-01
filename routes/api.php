<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UploadController;

Route::post('/imageupload', [UploadController::class, 'imageupload'])
    ->name('imageupload');
