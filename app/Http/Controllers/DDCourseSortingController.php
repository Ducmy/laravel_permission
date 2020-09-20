<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\DDCourse;

class DDCourseSortingController extends Controller
{ 
    public function update(Request $request)
    {
        $posts = DDCourse::all();

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