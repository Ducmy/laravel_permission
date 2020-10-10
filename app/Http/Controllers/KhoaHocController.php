<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Bills;
use App\Comment;
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

            $ddcourse = DDCourse::find($ddcourse_id);
            
            $comments = Comment::where('lession_id', '=',$ddcourse_id)->get();

            $ddcourses = DDCourse::where('course_id','=', $course_id)->orderBy('order')->get();

            return view('khoahoc.showddcourse', compact('ddcourse','ddcourses','course_id', 'comments'));
        } else {
            return redirect()->route('khoahoc', [ 'course_id' => $course->id]);
        }
    }

    public function rating(Request $request) {


        request()->validate(['rate' => 'required']);
        $post = Course::find($request->id);
        // $rating = new \willvincent\Rateable\Rating;
        // $rating->rating = $request->rate;
        // $rating->user_id =  Auth::id();
        $post->rateOnce($request->rate);
        // $post->ratings()->save($rating);


        return back();
    }
}
