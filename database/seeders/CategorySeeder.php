<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = ['Personal', 'Work', 'Social'];
        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
} 