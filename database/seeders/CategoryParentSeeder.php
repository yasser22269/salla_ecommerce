<?php

namespace Database\Seeders;

use App\Models\Category;
use Database\Factories\CategoryParentFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::factory()->state(new CategoryParentFactory)->create();

    }
}
