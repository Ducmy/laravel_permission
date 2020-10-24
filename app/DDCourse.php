<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DDCourse extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public $table = 'ddcourses';

    protected $attributes = [
        'url' => "no_video_link",
    ];

    protected $fillable = [
        'course_id', 'dd_title', 'body', 'url', 'order'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
}
