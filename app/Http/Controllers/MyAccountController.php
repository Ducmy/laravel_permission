<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Course;
use App\Bills;

class MyAccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::id();
        $user = User::find($id);
        $bills = Bills::where('user_id', '=', $id)->pluck('course_id');
        $myCourses = Course::whereIn('id', $bills)->get();
        return view('my-account', compact('user', 'myCourses'));
    }

    public function buy(Request $request)
    {
        $this->validate($request, [
            'course_id' => 'required',
        ]);

        $input = $request->all();
        $course = Course::find($input['course_id']);
        $price =  $course->price;
        $id = Auth::id();
        $user = User::find($id);
        $teacher = User::find($course->teacher_id);
        if ($user->credit > $price) {
            //Update bills
            $bill = new Bills;
            $bill->user_id = Auth::id();
            $bill->course_id = $input['course_id'];
            $bill->save();

            // Trừ tiền học viên
            $user->credit = $user->credit - $price;
            $user->save();

            // Cộng tiền 70% cho giáo viên
            $teacher->credit = $teacher->credit + round($price*70/100);
            $teacher->save();

            return redirect()->route('my-account')->with('success', 'Bạn đã mua khóa học thành công');
        } else {
            return redirect()->route('my-account')->with('failure', 'Rất tiếc ! Bạn không đủ credit! :(');
        }
    }
}
