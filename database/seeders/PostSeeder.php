<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 10) as $i) {
            \App\Models\Post::create([
                'title' => fake()->title,
                'content' => fake()->text,
                'type' => 'memo',
                'is_exclusive' => $i % 2 == 0 ? true : false,
                'creator_id' => 1,
            ]);
        }
    }
}
