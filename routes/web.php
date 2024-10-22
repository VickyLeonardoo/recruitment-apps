<?php

use App\Http\Controllers\ChoiceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('department',DepartmentController::class)
    ->middleware('role:superadmin');

    Route::get('/add/position/{department:id}', [PositionController::class, 'create'])
        ->middleware('role:superadmin')
        ->name('department.create.position');

    Route::post('/add/position/store/{department:id}', [PositionController::class, 'store'])
        ->middleware('role:superadmin')
        ->name('department.store.position');

    Route::resource('position',PositionController::class)
    ->middleware('role:superadmin');

    Route::resource('staff',StaffController::class)
    ->middleware('role:superadmin');

    Route::resource('question',QuestionController::class)
    ->middleware('role:superadmin');

    Route::get('/add/choice/{question:id}', [ChoiceController::class, 'create'])
        ->middleware('role:superadmin')
        ->name('question.create.choice');

    Route::post('/add/choice/store/{question:id}', [ChoiceController::class, 'store'])
        ->middleware('role:superadmin')
        ->name('question.store.choice');

    Route::resource('choice',ChoiceController::class)
    ->middleware('role:superadmin');

});

require __DIR__.'/auth.php';
