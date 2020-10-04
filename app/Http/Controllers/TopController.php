<?php

use Illuminate\Http\Request;
namespace App\Http\Controllers;

use App\Course;
use Spatie\QueryBuilder\QueryBuilder;

class TopController extends Controller
{
    function index()
    {

        $courses = QueryBuilder::for(Course::class)
            ->allowedFilters('title')
            ->get();
        // $courses = Course::get();
        return view('top', compact('courses'));
    }


    function searchCourse(Request $Request) {

        $courses = QueryBuilder::for(Course::class)
            ->allowedFilters('title')
            ->get();
        return view('top', compact('courses'));
    }
}
