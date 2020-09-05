<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DDCourse extends Model
{
    public $table = 'ddcourses';
    protected $fillable = [
        'course_id', 'dd_title', 'body', 
    ];
    protected $attributes = [
        'order' => 0,
     ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
