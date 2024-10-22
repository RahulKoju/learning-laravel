<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

Route::get("/jobs", function () {
    //eager loading with employer rln as part of one single query
    //to solve N+1 problem or remove lazy loading
    //$jobs = Job::with('employer')->get();
    $jobs = Job::with('employer')->latest()->simplePaginate(3);
    //$jobs = Job::with('employer')->paginate(3);
    //$jobs = Job::with('employer')->cursorPaginate(3);

    return view("jobs.index", [
        'jobs' => $jobs
    ]);
});

Route::get('/jobs/create', function () {
    return view('jobs.create');
});

Route::post('/jobs', function () {
    //validation
    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1,
    ]);
    return redirect('/jobs');
});

Route::get("/contact", function () {
    return view("contact");
});

Route::get("/jobs/{id}", function ($id) {
    $job = Job::find($id);
    return view("jobs.show", ['job' => $job]);
});
