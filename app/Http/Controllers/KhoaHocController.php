<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Bills;
use App\DDCourse;


class KhoaHocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::latest()->paginate(5);
        return view('khoahoc.index', compact('courses'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('khoahoc.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required',
            'summary' => 'required',
            'price' => 'required',
        ]);
        Course::create($request->all());
        return redirect()->route('khoahoc.index')
            ->with('success', 'Khóa học đã được tạo thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        $bill = Bills::where('user_id','=', Auth::id())
        ->where('course_id','=',$course->id)
        ->first();
        if(!empty($bill)) {
            $isPurchased = true;
        } else {
            $isPurchased = false;
        }

        $ddcourses = DDCourse::get();
        return view('khoahoc.show', compact('course','isPurchased','ddcourses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $ddcourses = DDCourse::orderBy('order','ASC')->get();
        return view('khoahoc.edit', compact('course','ddcourses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        request()->validate([
            'title' => 'required',
            'summary' => 'required',
            'teacher_id' => 'required',
            'price' => 'required',
        ]);
        $course->update($request->all());
        return redirect()->route('khoahoc.show',$course->id)
            ->with('success', 'Khóa học đã được cập nhật');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('khoahoc.index')
            ->with('success', 'Khóa học đã được xóa.');
    }
}
