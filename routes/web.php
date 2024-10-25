<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Jobs\TranslateJob;
use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    $job = Job::first();
    TranslateJob::dispatch($job);
    return 'done';
});
// Route::get('/', function () {
//     return view('home');
// });
Route::view('/', 'home'); //3.route::view

// Route::get("/contact", function () {
//     return view("contact");
// });
Route::view('/contact', 'contact');

//4. route lists- php artisan route:list --except-vendor

// Route::controller(JobController::class)->group(function () {  //5.route groups
//     Route::get("/jobs", 'index');
//     Route::get('/jobs/create', 'create');
//     Route::post('/jobs', 'store');
//     Route::get("/jobs/{job}", 'show');
//     Route::patch("/jobs/{job}", 'update');
//     Route::delete("/jobs/{job}", 'delete');
//     Route::get("/jobs/{job}/edit", 'edit');
// });

// Route::resource('jobs', JobController::class); //6.route resource

Route::get("/jobs", [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create']);
Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');
Route::get("/jobs/{job}", [JobController::class, 'show']);
Route::patch("/jobs/{job}", [JobController::class, 'update'])->middleware('auth');
Route::delete("/jobs/{job}", [JobController::class, 'destroy'])->middleware('auth');
Route::get("/jobs/{job}/edit", [JobController::class, 'edit'])
    ->middleware('auth')
    ->can('edit', 'job');

Route::get("/register", [RegisteredUserController::class, 'create']);
Route::post("/register", [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
