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
    public function show($course_id)
    {
        $course = Course::find($course_id);
        $teacher = User::find($course->teacher_id);
        $bill = Bills::where('user_id', '=', Auth::id())
            ->where('course_id', '=', $course_id)
            ->first();
        if (!empty($bill)) {
            $isPurchased = true;
        } else {
            $isPurchased = false;
        }

        $ddcourses = DDCourse::orderBy('order')->get();
        return view('khoahoc.show', compact('course', 'teacher', 'isPurchased', 'ddcourses'));
    }

    public function showddcourse($course_id , $ddcourse_id)
    {
        $ddcourse = DDCourse::where('id', '=', $ddcourse_id)->first();
        $course_id =  $ddcourse->course_id;
        $course = Course::find($course_id);
        $teacher = User::find($course->teacher_id);
        $bill = Bills::where('user_id', '=', Auth::id())
            ->where('course_id', '=', $course_id)
            ->first();

        if (!empty($bill)) {
            $ddcourse = DDCourse::where('id', '=', $ddcourse_id)->first();

            $ddcourses = DDCourse::where('course_id','=', $course_id)->orderBy('order')->get();

            return view('khoahoc.showddcourse', compact('ddcourse','ddcourses','course_id'));
        } else {
            return redirect()->route('khoahoc', [ 'course_id' => $course->id]);
        }
    }
}
