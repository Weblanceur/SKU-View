<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::match(['GET', 'POST'],'/', [ItemController::class, 'index'])->name('home');
