<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Electronics',
            'status' => '1',
        ]);
        Category::create([
            'name' => 'Technology',
            'status' => '1',
        ]);
        Category::create([
            'name' => 'Business',
            'status' => '1',
        ]);
        Category::create([
            'name' => 'Fashion',
            'status' => '1',
        ]);
        Category::create([
            'name' => 'Lifestyle',
            'status' => '1',
        ]);
        Category::create([
            'name' => 'Food',
            'status' => '1',
        ]);
        Category::create([
            'name' => 'Other',
            'status' => '1',
        ]);
    }
}
