<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

use Inertia\Inertia;

class JobController extends Controller
{
    //

    public function index()
    {
        // dd('Hello from all jobs created by every employer');
        $jobs = Job::paginate(5);
        return Inertia::render('jobs/Index', [
            'jobs' => $jobs,
        ]);
    }

    public function create()
    {
        return Inertia::render('jobs/Create'); // Match your React component name
    }

    public function store()
    {
        $validated = request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);



        $job = Job::create($validated);
        return redirect()->route('jobs.index');
    }

    public function myJobs()
    {
        $jobs = Job::paginate(5);
        return Inertia::render('jobs/MyJobs', [
            'jobs' => $jobs,
        ]);
    }

    public function edit(Job $job){
        return Inertia::render('jobs/Edit', [
            'job' => $job,
        ]);
    }

    public function update(Request $request, Job $job)
    {
        //validate
        $validated = $request->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        //authorize(on hold.. )

        //update the job and persist


        $job->update($validated);


        //redirect to the job page
        return redirect("/jobs/myJobs");
    }

    public function delete(Job $job)
    {
        //authorize(on hold.. )
        //delete the job
        $job->delete();

        //redirect 
        // return redirect('/jobs');
    }

}
