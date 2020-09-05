<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'summary', 'teacher_id', 'price'
    ];

    public function ddcourse()
    {
        return $this->hasMany(DDCourse::class);
    }
}
