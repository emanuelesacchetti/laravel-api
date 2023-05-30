<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TypeController;
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

//ROTTA DELLA HOME DEL SITO
Route::get('/', function () {
    return view('home');
});

//GRUPPO DI ROTTE PER LA DASHBOARD (prefisso URI=admin  -  prefisso nome=admin. )
Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function() {
        //rotta che richiama la funzione index di DashController per la URI root
        Route::get('/', [DashController::class, 'index'])->name('dashboard');

        Route::resource('projects', ProjectController::class)
        ->parameters(['projects'=>'project:slug']);

        Route::resource('types', TypeController::class)
        ->parameters(['types' => 'type:slug'])->only('index');


    });



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
