<?php

use Illuminate\Database\Seeder;
use App\Course;
use App\DDCourse;

class CreateCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Tạo một khóa học mới
        $course = new Course();
        $course->title = 'Test khóa học';
        $course->teacher_id = 1;
        $course->summary = 'Mô tả sản phẩm';
        $course->price = 50;
        $course->save();

        // Thêm bài học vào khóa học

        $ddcourse = new DDCourse();
        $ddcourse->course_id = $course->id;
        $ddcourse->dd_title = "Bai hoc so 1";
        $ddcourse->body = "Noi dung bai hoc aaaaaaaaaaa";
        $ddcourse->url = "https://www.youtube.com/watch?v=Jvf-w0L3nyQ";
        $ddcourse->save();

        $ddcourse = new DDCourse();
        $ddcourse->course_id = $course->id;
        $ddcourse->dd_title = "Bai hoc so 2";
        $ddcourse->body = "Noi dung bai hoc bbbbbbbbb";
        
        $ddcourse->save();
    }
}
