<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->id = 1;
        $category->name = 'Nhạc Trẻ';
        $category->save();

        $category = new Category();
        $category->name = 'Nhạc Vàng';
        $category->save();

        $category = new Category();
        $category->name = 'Nhạc Đỏ';
        $category->save();

        $category = new Category();
        $category->name = 'Nhạc Trữ Tình';
        $category->save();

        $category = new Category();
        $category->name = 'Nhạc Không Lời';
        $category->save();

        $category = new Category();
        $category->name = 'Nhạc Hoa';
        $category->save();

        $category = new Category();
        $category->name = 'Nhạc Hải Ngoại';
        $category->save();


        $category = new Category();
        $category->name = 'Nhạc Âu-Mỹ';
        $category->save();


        $category = new Category();
        $category->name = 'Nhạc Hàn';
        $category->save();


        $category = new Category();
        $category->name = 'Rap';
        $category->save();

        $category = new Category();
        $category->name = 'Song Ca';
        $category->save();


        $category = new Category();
        $category->name = 'Nhạc Quê Hương';
        $category->save();
    }
}
