<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Bills;
use App\DDCourse;


class DDCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ddcourses = DDCourse::orderBy('order','ASC')->latest()->paginate(5);
        return view('admin.ddcourses.index', compact('ddcourses'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $input = $request->all();
        $course_id = $input['course_id'];
        return view('admin.ddcourses.create',compact('course_id'));
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
            'course_id' => 'required',
            'dd_title' => 'required',
            'body' => 'required',
        ]);
        DDCourse::create($request->all());
        return redirect()->route('admin.courses.edit', $request->all()['course_id'])
            ->with('success', 'Bài học đã được tạo thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DDCourse  $ddcourse
     * @return \Illuminate\Http\Response
     */
    public function show(DDCourse $ddcourse)
    {
        return view('admin.ddcourses.show', compact('ddcourse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DDCourse  $ddcourse
     * @return \Illuminate\Http\Response
     */
    public function edit(DDCourse $ddcourse)
    {
        return view('admin.ddcourses.edit', compact('ddcourse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DDCourse  $ddcourse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DDCourse $ddcourse)
    {
        request()->validate([
            'dd_title' => 'required',
            'body' => 'required',
        ]);
        $ddcourse->update($request->all());
        return redirect()->route('admin.courses.edit',$ddcourse->course_id)
            ->with('success', 'Bài học đã được cập nhật.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DDCourse  $ddcourse
     * @return \Illuminate\Http\Response
     */
    public function destroy(DDCourse $ddcourse)
    {
        $ddcourse->delete();
        return redirect()->route('admin.courses.edit',$ddcourse->course_id)
            ->with('success', 'Bài học đã bị xóa.');
    }

    public function updateOrder(Request $request){
        $posts = Post::all();
        foreach ($posts as $post) {
            foreach ($request->order as $order) {
                if ($order['id'] == $post->id) {
                    $post->update(['order' => $order['position']]);
                }
            }
        }
        return response('Update Successfully.', 200);
    }
}
