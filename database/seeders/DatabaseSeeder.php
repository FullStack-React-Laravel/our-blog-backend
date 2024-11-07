<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory()->count(20)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => '000',
            'username' => 'admin',
        ]);

        User::factory(3)->hasPosts(10)->create([
            'role_id' => Role::where('name', 'admin')->value('id'),
        ]);

        $tags = Tag::factory()->count(20)->create();

        Post::all()->each(function (Post $post) use ($tags) {
            $post->tags()->attach(
                $tags->random(
                    fake()->numberBetween(1, 4)
                )->pluck('id')->toArray()
            );
        });
    }
}
