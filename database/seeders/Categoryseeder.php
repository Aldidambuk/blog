<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Categoryseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'web developer',
            'slug' => 'web developer'
        ]);

        Category::create([
            'name' => 'artificial intelegence',
            'slug' => 'ai'
        ]);

        Category::create([
            'name' => 'crypto currency',
            'slug' => 'crypto currency'
        ]);
    }
}
