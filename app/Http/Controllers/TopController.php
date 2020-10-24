<?php

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Course;
use App\Category;
use Spatie\QueryBuilder\QueryBuilder;

class TopController extends Controller
{
    function index()
    {

        $courses = QueryBuilder::for(Course::class)
            ->allowedFilters('title')
            ->where('active', '=', 1)
            ->get();
        // $courses = Course::get();
        $categories =  Category::get();
        return view('top', compact('courses', 'categories'));
    }


    function searchCourse(Request $Request)
    {

        $courses = QueryBuilder::for(Course::class)
            ->allowedFilters('title')
            ->get();
        return view('top', compact('courses'));
    }
}
