<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SeekerController extends Controller
{
    //

    public function index(){
        return Inertia::render('jobSeeker/Index');
    }
}
