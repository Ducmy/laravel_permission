<?php

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Course;
use App\Category;
use App\User;
use Spatie\QueryBuilder\QueryBuilder;

class TopController extends Controller
{
    function index()
    {

        $courses = QueryBuilder::for(Course::class)
            ->allowedFilters('title')
            ->where('active', '=', 1)
            ->get();
        $categories =  Category::where('id', '<>', 1)->get();

        $teachers = User::whereHas(
            'roles', function($q){
                $q->where('name', 'teacher');
            }
        )->get();
        return view('top', compact('courses', 'categories', 'teachers'));
    }


    function searchCourse(Request $Request)
    {

        $courses = QueryBuilder::for(Course::class)
            ->allowedFilters('title')
            ->get();
        return view('top', compact('courses'));
    }
}
