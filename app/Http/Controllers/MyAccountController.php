<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Course;

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
        return view('my-account',compact('user'));
    }

    public function buy(Request $request) {
        $this->validate($request, [
            'course_id' => 'required',
        ]);

        $input = $request->all();
        $price =  Course::find($input['course_id'])->price;
        $id = Auth::id();
        $user = User::find($id);
        if($user->credit > $price ) {
            $user->credit = $user->credit - $price;
            $user->save();
            return redirect()->route('my-account')->with('success', 'Bạn đã mua khóa học thành công');
        } else {
            return redirect()->route('my-account')->with('failure', 'Bạn không đủ credit');
        }
    }
}
