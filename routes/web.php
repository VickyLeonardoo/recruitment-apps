<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ChoiceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ScheduleController;
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

    Route::get('/job/applicant/{job:id}', [JobVacancyController::class, 'view_applicant'])
        ->middleware('role:superadmin')
        ->name('job.show.applicant');

    Route::get('/set/draft/{job:id}', [JobVacancyController::class, 'set_to_draft'])
        ->middleware('role:superadmin')
        ->name('job.set.draft');

    Route::get('/set/cancel/{job:id}', [JobVacancyController::class, 'set_to_cancel'])
        ->middleware('role:superadmin')
        ->name('job.set.cancel');

    Route::get('/set/active/{job:id}', [JobVacancyController::class, 'set_to_active'])
        ->middleware('role:superadmin')
        ->name('job.set.active');

    Route::get('/set/done/{job:id}', [JobVacancyController::class, 'set_to_done'])
        ->middleware('role:superadmin')
        ->name('job.set.done');

    Route::resource('job',JobVacancyController::class)
        ->middleware('role:superadmin');

    Route::get('job/{job:id?}/application', [ApplicationController::class, 'index'])
        ->name('application.index')
        ->middleware('role:superadmin');

    Route::put('/application/recomendation/{application:id}', [ApplicationController::class, 'set_recommendation'])
        ->name('application.recommendation')
        ->middleware('role:superadmin');

    Route::get('/application/mark/{ids}', [ApplicationController::class, 'set_mark'])
        ->name('application.mark')
        ->middleware('role:superadmin');

    Route::get('/application/unmark/{ids}', [ApplicationController::class, 'set_unmark'])
        ->name('application.unmark')
        ->middleware('role:superadmin');

    Route::get('/application/interview/{ids}', [ApplicationController::class, 'set_interview'])
        ->name('application.interview')
        ->middleware('role:superadmin');

    Route::get('/application/reject/{ids}', [ApplicationController::class, 'set_reject'])
        ->name('application.reject')
        ->middleware('role:superadmin');

    Route::resource('application', ApplicationController::class)
        ->except(['index'])
        ->middleware('role:superadmin');

    Route::resource('schedule', ScheduleController::class)
        ->middleware('role:superadmin');

});

require __DIR__.'/auth.php';
