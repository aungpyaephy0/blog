<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Article::factory()->count(20)->create();
        Category::factory()->count(5)->create();
        Comment::factory()->count(40)->create();

        \App\Models\User::factory()->create([
            'name' => 'Rio',
            'email' => 'rio@example.com',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Emily',
            'email' => 'emily@example.com',
        ]);

    }
}
