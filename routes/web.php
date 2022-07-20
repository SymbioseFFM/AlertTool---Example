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

Route::get('/', function() {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/dashboard', \App\Http\Livewire\Alert\Index::class)->name('dashboard');

    Route::get('/customers', \App\Http\Livewire\Customer\Index::class)->name('customers');
    Route::get('/locations', \App\Http\Livewire\Location\Index::class)->name('locations');
    Route::get('/servers', \App\Http\Livewire\Server\Index::class)->name('servers');
    Route::get('/sensors', \App\Http\Livewire\Sensor\Index::class)->name('sensors');

    Route::get('/alerts/success', \App\Http\Livewire\Alert\Success::class)->name('alert_success');
    Route::get('/alerts/warning', \App\Http\Livewire\Alert\Warning::class)->name('alert_warning');
    Route::get('/alerts/error', \App\Http\Livewire\Alert\Error::class)->name('alert_error');
    Route::get('/alerts/unknown', \App\Http\Livewire\Alert\Unknown::class)->name('alert_unknown');
    Route::get('/alerts', \App\Http\Livewire\Alert\Index::class)->name('alerts');

    Route::get('/sensors/warning', \App\Http\Livewire\Sensor\Warning::class)->name('sensor_warning');
    Route::get('/sensors/threshold', \App\Http\Livewire\Sensor\Threshold::class)->name('sensor_threshold');

    Route::get('/alertcontent/{alertId}', function($alertId){
        return \App\Models\Alert::find($alertId)->content;
    })->name('alertcontent');
    
});
