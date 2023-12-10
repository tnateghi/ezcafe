<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'پيتزا',
            'پاستا',
            'برگر',
            'ساندویچ',
            'سوخاری',
        ];

        foreach ($categories as $category) {
            Category::create([
                'title'     => $category,
                'slug'      => $category,
                'published' => true
            ]);
        }
    }
}
