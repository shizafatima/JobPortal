<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SeekerController extends Controller
{
    //

    public function index()
    {

        $jobs = Job::with('company')->latest()->paginate(6);

        return Inertia::render('jobSeeker/Index', [
            'jobs' => $jobs,
        ]);
    }
}
