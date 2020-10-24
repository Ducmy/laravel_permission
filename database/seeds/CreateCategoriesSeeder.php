<?php

use Illuminate\Database\Seeder;
use App\Category;

class CreateCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Tạo một chuyên mục mới
        $cat = new Category();
        $cat->name = 'Laravel 5.4';
        $cat->save();

        $cat = new Category();
        $cat->name = 'Laravel 5.5';
        $cat->category_id = 1;
        $cat->save();

        $cat = new Category();
        $cat->name = 'Laravel 5.6';
        $cat->category_id = 2;
        $cat->save();

        $cat = new Category();
        $cat->name = 'Laravel 7';
        $cat->category_id = 2;
        $cat->save();

        $cat = new Category();
        $cat->name = 'Laravel 8';
        $cat->category_id = 3;
        $cat->save();
    }
}
