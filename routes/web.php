<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function(){

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::middleware(['admin'])->group(function(){
        Route::get('/employees',\App\Http\Livewire\Employees::class)->name('employees');
        Route::get('/performance-reviews',\App\Http\Livewire\PerformanceReviews::class)->name('performance-reviews');
    });
    Route::get('/feedback-request',\App\Http\Livewire\FeedbackRequest::class)->name('feedback-request');
});


