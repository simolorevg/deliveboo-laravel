<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories =[
            [
            'category_name'=>'Giapponese',
            'icon'=>'https://img.icons8.com/?size=512&id=omf8XAGTgy80&format=png'
            ],
            [
            'category_name'=>'Mediterraneo',
            'icon'=>'https://img.icons8.com/?size=512&id=0M0jyfju1JeN&format=png'
            ],
            [
            'category_name'=>'Pizza',
            'icon'=>'https://img.icons8.com/?size=512&id=Q2fre4pbJjTx&format=png'
            ],
            [
            'category_name'=>'Hamburger',
            'icon'=>'https://img.icons8.com/?size=512&id=erEevcUCwAMR&format=png'
            ],
            [
            'category_name'=>'Hawaiano',
            'icon'=>'https://img.icons8.com/?size=512&id=yoflzK7JQMwS&format=png'
            ],
            [
            'category_name'=>'Ittico',
            'icon'=>'https://img.icons8.com/?size=512&id=59n5849FEYbs&format=png'
            ],
            [
            'category_name'=>'Medio-orientale',
            'icon'=>'https://img.icons8.com/?size=512&id=lCbXCZey2Wkp&format=png'
            ],
            [
            'category_name'=>'Vegetariano',
            'icon'=>'https://img.icons8.com/?size=512&id=MFBPHPkOvwSg&format=png'
            ],
            [
            'category_name'=>'Friggitoria',
            'icon'=>'https://img.icons8.com/?size=512&id=bcb11mkMayyc&format=png'
            ],
            [
            'category_name'=>'Dessert',
            'icon'=>'https://img.icons8.com/?size=512&id=2san48WPZRBS&format=png'
            ]
        ];
        
        
        foreach ($categories as $category_value){
            $new_category = new Category();
            $new_category->category_name = $category_value['category_name'];
            $new_category->slug = Str::slug($category_value['category_name']);
            $new_category->icon = $category_value['icon'];
            $new_category->save();

        }
    }
}
