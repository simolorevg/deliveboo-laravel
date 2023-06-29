<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = [
            [
                'name' => 'Giapponese',
                'icon' => 'https://icons8.it/icon/omf8XAGTgy80/sushi'
            ],
            [
                'name' => 'Italiano',
                'icon' => 'https://icons8.it/icon/0M0jyfju1JeN/spaghetti'
            ],
            [
                'name' => 'Pizza',
                'icon' => 'https://icons8.it/icon/Iq8pQFiZuir9/salami-pizza'
            ],
            [
                'name' => 'Hamburger',
                'icon' => 'https://icons8.it/icon/erEevcUCwAMR/hamburger'
            ],
            [
                'name' => 'Hawaiano',
                'icon' => 'https://icons8.it/icon/yoflzK7JQMwS/ananas'
            ],

        ];

        foreach ($categories as $element) {
            $category = new Category();
            $category->category_name = $element['name'];
            $category->slug = Str::slug($category->category_name, '-');
            $category->icon = $element['icon'];
            $category->save();
        }
    }
}
