<?php

namespace App\Http\Controllers;

use App\Course;

class TopController extends Controller {
    function index() {
        $courses = Course::get();
        return view('top', compact('courses'));
    }
}