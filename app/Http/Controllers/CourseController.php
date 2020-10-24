<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Bills;
use App\DDCourse;
use App\Category;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::latest()->paginate(5);

        return view('admin.courses.index', compact('courses'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $teachers = User::whereHas(
            'roles', function($q){
                $q->where('name', 'teacher');
            }
        )->get();
        
        $categories = Category::get();

        return view('admin.courses.create',compact('teachers','categories'));
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
        return redirect()->route('courses.index')
            ->with('success', 'Khóa học đã được tạo thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $bill = Bills::where('user_id','=', Auth::id())
        ->where('course_id','=',$course->id)
        ->first();
        if(!empty($bill)) {
            $isPurchased = true;
        } else {
            $isPurchased = false;
        }

        $ddcourses = DDCourse::get();
        return view('admin.courses.show', compact('course','isPurchased','ddcourses'));
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
        $teachers = User::whereHas(
            'roles', function($q){
                $q->where('name', 'teacher');
            }
        )->get();

        $categories = Category::get();
        return view('admin.courses.edit', compact('course', 'teachers', 'ddcourses','categories'));
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
        return redirect()->route('courses.edit',$course->id)
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
        return redirect()->route('courses.index')
            ->with('success', 'Khóa học đã được xóa.');
    }


    public function status(Request $request, $id) {
        $course = Course::find($id);
        $course->active = $request->all()['active'];
        $course->save();
        return response()->json('Đã cập nhật status');
    }
}
