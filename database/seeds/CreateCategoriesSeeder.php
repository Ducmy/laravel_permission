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
        $cat->name = 'Chuyên mục';
        $cat->save();
    }
}
