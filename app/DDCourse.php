<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DDCourse extends Model
{
    public $table = 'ddcourses';
    protected $fillable = [
        'course_id', 'dd_title', 'body', 'order'
    ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
