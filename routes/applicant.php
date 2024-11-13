<?php

use App\Http\Controllers\ApplicationController as ControllersApplicationController;
use App\Http\Controllers\Front\ApplicationController;
use App\Http\Controllers\Front\JobController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\TestController;
use Illuminate\Support\Facades\Route;


// Rute yang dapat diakses oleh siapa saja (termasuk yang belum login)

    Route::resource('job', JobController::class)
        ->only('index'); 

Route::middleware(['auth', 'verified'])->group(function () {

    Route::resource('job', JobController::class)
        ->except('index') // Melamar pekerjaan hanya bisa setelah login
        ->middleware('role:applicant');

    Route::resource('profile',ProfileController::class)
        ->middleware('role:applicant');

    Route::post('/profile/education/store', [ProfileController::class, 'store_education'])
        ->middleware('role:applicant')
        ->name('profile.education.store');
    
    Route::delete('/profile/education/destroy/{education:id}', [ProfileController::class, 'destroy_education'])
        ->middleware('role:applicant')
        ->name('profile.education.destroy');

    Route::post('/profile/skill/store', [ProfileController::class, 'store_skill'])
        ->middleware('role:applicant')
        ->name('profile.skill.store');
 
    Route::delete('/profile/skill/destroy/{skill:id}', [ProfileController::class, 'destroy_skill'])
        ->middleware('role:applicant')
        ->name('profile.skill.destroy');

    Route::post('/profile/experience/store', [ProfileController::class, 'store_experience'])
        ->middleware('role:applicant')
        ->name('profile.experience.store');

    Route::delete('/profile/experience/destroy/{experience:id}', [ProfileController::class, 'destroy_experience'])
        ->middleware('role:applicant')
        ->name('profile.experience.destroy');

    Route::put('/profile/update/photo', [ProfileController::class, 'updatePhoto'])
        ->middleware('role:applicant')
        ->name('profile.photo.update');
    
    Route::put('/profile/update/personal-information', [ProfileController::class, 'update_personal_information'])
        ->middleware('role:applicant')
        ->name('profile.update.personal.information');

    Route::post('/application/test/open/{application:id}', [TestController::class, 'startTest'])
        ->middleware('role:applicant')
        ->name('application.test.open');

    Route::get('/application/test/index/{application:id}', [TestController::class, 'continueTest'])
        ->middleware('role:applicant')
        ->name('application.test.index');


    Route::post('/application/test/save-answer', [TestController::class, 'saveAnswer'])
        ->middleware('role:applicant')
        ->name('application.test.saveAnswer');

    Route::post('/application/test/save-answer/{id}', [TestController::class, 'submitApplication'])
            ->middleware('role:applicant')
            ->name('application.submit');
            
    Route::resource('application',ApplicationController::class)
        ->middleware('role:applicant');

    // Rute untuk melamar pekerjaan yang hanya bisa diakses setelah login
    // Route::resource('job', JobController::class)
    // ->middleware('auth')
    // ->except(['index', 'show']); // Melamar pekerjaan hanya bisa setelah login

    // Route::resource('job',JobController::class)
    // ->middleware('role:applicant');

    // BATAS=========================================================================================

    // Route::get('/profile/my-info/', [ProfileController::class, 'show_my_info'])
    //     ->middleware('role:applicant')
    //     ->name('profile.show.info');

    // Route::get('/profile/my-education', [ProfileController::class, 'show_my_education'])
    //     ->middleware('role:applicant')
    //     ->name('profile.education.show');

    // Route::post('/profile/my-education/store', [ProfileController::class, 'store_my_education'])
    //     ->middleware('role:applicant')
    //     ->name('profile.education.store');

    // Route::post('/profile/my-education/update/{education:id}', [ProfileController::class, 'update_my_education'])
    //     ->middleware('role:applicant')
    //     ->name('profile.education.update');

    // Route::get('/profile/my-education/delete/{education:id}', [ProfileController::class, 'destroy_my_education'])
    //     ->middleware('role:applicant')
    //     ->name('profile.education.destroy');

    // Route::get('/profile/my-experience/', [ProfileController::class, 'show_my_experience'])
    //     ->middleware('role:applicant')
    //     ->name('profile.experience.show');

    // Route::post('/profile/my-experience/store', [ProfileController::class, 'store_my_experience'])
    //     ->middleware('role:applicant')
    //     ->name('profile.experience.store');

    // Route::post('/profile/my-experience/update/{experience:id}', [ProfileController::class, 'update_my_experience'])
    //     ->middleware('role:applicant')
    //     ->name('profile.experience.update');

    // Route::get('/profile/my-experience/delete/{experience:id}', [ProfileController::class, 'destroy_my_experience'])
    //     ->middleware('role:applicant')
    //     ->name('profile.experience.destroy');

    // Route::get('/profile/my-skill/', [ProfileController::class, 'show_my_skill'])
    //     ->middleware('role:applicant')
    //     ->name('profile.skill.show');
    
    // Route::post('/profile/my-skill/store', [ProfileController::class, 'store_my_skill'])
    //     ->middleware('role:applicant')
    //     ->name('profile.skill.store');

    // Route::post('/profile/my-skill/update/{skill:id}', [ProfileController::class, 'update_my_skill'])
    //     ->middleware('role:applicant')
    //     ->name('profile.skill.update');

    // Route::get('/profile/my-skill/delete/{skill:id}', [ProfileController::class, 'destroy_my_skill'])
    //     ->middleware('role:applicant')
    //     ->name('profile.skill.destroy');

    // Route::get('/profile/my-language/', [ProfileController::class, 'show_my_language'])
    //     ->middleware('role:applicant')
    //     ->name('profile.language.show');
    
    // Route::post('/profile/my-language/store', [ProfileController::class, 'store_my_language'])
    //     ->middleware('role:applicant')
    //     ->name('profile.language.store');

    // Route::post('/profile/my-language/update/{language:id}', [ProfileController::class, 'update_my_language'])
    //     ->middleware('role:applicant')
    //     ->name('profile.language.update');

    // Route::get('/profile/my-language/delete/{language:id}', [ProfileController::class, 'destroy_my_language'])
    //     ->middleware('role:applicant')
    //     ->name('profile.language.destroy');

    // Route::get('/profile/overview/', [ProfileController::class, 'show_overview'])
    //     ->middleware('role:applicant')
    //     ->name('profile.overview.show');

    // Route::resource('profile',ProfileController::class)
    // ->middleware('role:applicant');

    // Route::resource('job',JobController::class)
    // ->middleware('role:applicant');

    

    

    

    // Route::resource('application',ApplicationController::class)
    // ->middleware('role:applicant');



});

require __DIR__.'/auth.php';