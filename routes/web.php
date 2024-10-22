<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

Route::get("/jobs", function () {
    //eager loading with employer rln as part of one single query
    //to solve N+1 problem or remove lazy loading
    $jobs = Job::with('employer')->get();

    return view("jobs", [
        'jobs' => $jobs
    ]);
});

Route::get("/contact", function () {
    return view("contact");
});

Route::get("/jobs/{id}", function ($id) {
    $job = Job::find($id);
    return view("job", ['job' => $job]);
});
