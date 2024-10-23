<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

//index or all jobs
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

//create
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

//store
Route::post('/jobs', function () {
    //validation
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

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

//show
Route::get("/jobs/{id}", function ($id) {
    $job = Job::find($id);
    return view("jobs.show", ['job' => $job]);
});

//update
Route::patch("/jobs/{id}", function ($id) {
    //validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);
    //authorize
    //update job
    $job = Job::findOrFail($id);

    $job->update([
        'title' => request('title'),
        'salary' => request('salary')
    ]);
    //redirect to the job page
    return redirect('/jobs/' . $job->id);
});

//delete
Route::delete("/jobs/{id}", function ($id) {
    //authorize
    //delete
    $job = Job::findOrFail($id);
    $job->delete();
    return redirect('/jobs');
});

//edit
Route::get("/jobs/{id}/edit", function ($id) {
    $job = Job::find($id);
    return view("jobs.edit", ['job' => $job]);
});
