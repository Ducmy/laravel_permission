<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use SoftDeletes;
   
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'category_id'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }


    public function childrenCategories()
    {
        return $this->hasMany(Category::class)->with('categories');

    }
}
