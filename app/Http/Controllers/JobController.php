<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class JobController extends Controller //2.controller classes
{
    public function index()
    {
        //eager loading with employer rln as part of one single query
        //to solve N+1 problem or remove lazy loading
        //$jobs = Job::with('employer')->get();
        $jobs = Job::with('employer')->latest()->simplePaginate(3);
        //$jobs = Job::with('employer')->paginate(3);
        //$jobs = Job::with('employer')->cursorPaginate(3);

        return view("jobs.index", [
            'jobs' => $jobs
        ]);
    }

    public function show(Job $job) //1.Route model building
    {
        return view("jobs.show", ['job' => $job]);
    }

    public function store()
    {
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
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function update(Job $job)
    {
        //validate
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);
        //authorize
        //update job
        $job->update([
            'title' => request('title'),
            'salary' => request('salary')
        ]);
        //redirect to the job page
        return redirect('/jobs/' . $job->id);
    }

    public function edit(Job $job)
    {
        return view("jobs.edit", ['job' => $job]);
    }

    public function destroy(Job $job)
    {
        //authorize
        //delete
        $job->delete();
        return redirect('/jobs');
    }
}
