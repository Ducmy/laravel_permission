<?php

namespace App;

use willvincent\Rateable\Rateable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use Rateable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'summary', 'teacher_id', 'price', 'cat_id', 'thumb'
    ];

    public function ddcourse()
    {
        return $this->hasMany(DDCourse::class);
    }

    public function category()
    {
        return $this->hasMany(Category::class)->whereNull('cat_id');
    }
}
