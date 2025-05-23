<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ChoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Front\JobController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleLineController;

Route::get('/', function () {
    return view('welcome');
}); 

Route::get('/',[HomeController::class,'index'])->name('home');


Route::get('/dashboard',[DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/dashboard', function () {
//     return view('dashboard');

// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('department',DepartmentController::class)
    ->middleware('role:superadmin|admin');
 
    Route::get('/add/position/{department:id}', [PositionController::class, 'create'])
        ->middleware('role:superadmin|admin')
        ->name('department.create.position');

    Route::post('/add/position/store/{department:id}', [PositionController::class, 'store'])
        ->middleware('role:superadmin|admin')
        ->name('department.store.position');

    Route::resource('position',PositionController::class)
    ->middleware('role:superadmin|admin');

    Route::resource('staff',StaffController::class)
    ->middleware('role:superadmin|admin');

    Route::resource('question',QuestionController::class)
    ->middleware('role:superadmin|admin');

    Route::get('/add/choice/{question:id}', [ChoiceController::class, 'create'])
        ->middleware('role:superadmin|admin')
        ->name('question.create.choice');

    Route::post('/add/choice/store/{question:id}', [ChoiceController::class, 'store'])
        ->middleware('role:superadmin|admin')
        ->name('question.store.choice');

    Route::resource('choice',ChoiceController::class)
    ->middleware('role:superadmin|admin');

    Route::get('/job/applicant/{job:id}', [JobVacancyController::class, 'view_applicant'])
        ->middleware('role:superadmin|admin|hr')
        ->name('job.show.applicant');

    Route::get('/set/draft/{job:id}', [JobVacancyController::class, 'set_to_draft'])
        ->middleware('role:superadmin|admin|hr')
        ->name('job.set.draft');

    Route::get('/set/cancel/{job:id}', [JobVacancyController::class, 'set_to_cancel'])
        ->middleware('role:superadmin|admin|hr')
        ->name('job.set.cancel');

    Route::get('/set/active/{job:id}', [JobVacancyController::class, 'set_to_active'])
        ->middleware('role:superadmin|admin|hr')
        ->name('job.set.active');

    Route::get('/set/done/{job:id}', [JobVacancyController::class, 'set_to_done'])
        ->middleware('role:superadmin|admin|hr')
        ->name('job.set.done');

    Route::resource('job',JobVacancyController::class)
        ->middleware('role:superadmin|admin|hr|manager');

    Route::get('/generate-job-code', [JobVacancyController::class, 'generateCode'])->name('generate.job.code');


    Route::get('job/{job:id?}/application', [ApplicationController::class, 'index'])
        ->name('application.index')
        ->middleware('role:superadmin|admin|hr|manager');

    Route::put('/application/recomendation/{application:id}', [ApplicationController::class, 'set_recommendation'])
        ->name('application.recommendation')
        ->middleware('role:superadmin|manager|hr');

    Route::get('/application/mark/{ids}', [ApplicationController::class, 'set_mark'])
        ->name('application.mark')
        ->middleware('role:superadmin|manager|hr');

    Route::get('/application/unmark/{ids}', [ApplicationController::class, 'set_unmark'])
        ->name('application.unmark')
        ->middleware('role:superadmin|manager|hr');

    Route::get('/application/interview/{ids}', [ApplicationController::class, 'set_interview'])
        ->name('application.interview')
        ->middleware('role:superadmin|admin|hr|manager');

    Route::get('/application/reject/{ids}', [ApplicationController::class, 'set_reject'])
        ->name('application.reject')
        ->middleware('role:superadmin|manager|hr');

    Route::resource('application', ApplicationController::class)
        ->except(['index'])
        ->middleware('role:superadmin|admin|hr|manager');

    Route::post('/schedules/{id}/generate-applicants', [ScheduleController::class, 'generate_applicant'])->middleware('role:superadmin|hr|manager')->name('schedules.generate.applicants');

    Route::post('/schedules/sent-invitation/{schedule:id}', [ScheduleController::class, 'sent_invitation_mail'])->middleware('role:superadmin|hr|manager')->name('schedules.sent.invitation');


    Route::get('/schedule/upcoming/{schedule:id}', [ScheduleController::class, 'set_upcoming'])
        ->name('schedule.set.upcoming')
        ->middleware('role:superadmin|hr|manager');

    Route::get('/schedule/cancelled/{schedule:id}', [ScheduleController::class, 'set_cancelled'])
        ->name('schedule.set.cancelled')
        ->middleware('role:superadmin|admin|hr|manager');

    Route::get('/schedule/draft/{schedule:id}', [ScheduleController::class, 'set_draft'])
        ->name('schedule.set.draft')
        ->middleware('role:superadmin|admin|hr|manager');

    Route::get('/schedule/done/{schedule:id}', [ScheduleController::class, 'set_done'])
        ->name('schedule.set.done')
        ->middleware('role:superadmin|admin|hr|manager');

    Route::resource('schedule', ScheduleController::class)
        ->middleware('role:superadmin|admin|hr|manager');

    Route::get('/schedule/line/mark/{ids}', [ScheduleLineController::class, 'set_mark'])
        ->name('schedule.line.mark')
        ->middleware('role:superadmin|hr|manager|admin');

    Route::get('/schedule/line/unmark/{ids}', [ScheduleLineController::class, 'set_unmark'])
        ->name('schedule.line.unmark')
        ->middleware('role:superadmin|hr|admin|manager');

    Route::get('/schedule/line/approve/{ids}', [ScheduleLineController::class, 'set_approve'])
        ->name('schedule.line.approve')
        ->middleware('role:superadmin|hr|admin|manager');

    Route::get('/schedule/line/reject/{ids}', [ScheduleLineController::class, 'set_reject'])
        ->name('schedule.line.reject')
        ->middleware('role:superadmin|hr|admin|manager');
        
    Route::delete('/schedule/line/{line}', [ScheduleLineController::class, 'destroy'])->middleware('role:superadmin|hr|admin|manager')->name('schedule.line.destroy');
});

require __DIR__.'/auth.php';
 