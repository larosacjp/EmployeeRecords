<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function(){
    return redirect("/login");
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function () {
    Volt::route('/employee-records', 'pages.employeerecords')
        ->name('employee-records');

    Volt::route('employee-statistics', 'pages.employeestatistics')
        ->name('employee-statistics');

    Volt::route('create-employee-record', 'pages.createemployeerecord')
    ->name('create-employee-record');

    Volt::route('update-employee-record', 'pages.updateemployeerecord')
    ->name('update-employee-record');

});

require __DIR__.'/auth.php';
