<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Reaction;
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

        User::factory()->hasPosts(10)->hasComments(3)->hasReactions(3)->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role_id' => 1,
        ]);

        $tags = Tag::factory()->count(20)->create();

        Post::all()->each(function (Post $post) use ($tags) {
            $post->tags()->attach(
                $tags->random(
                    fake()->numberBetween(1, 4)
                )->pluck('id')->toArray()
            );
        });

        Comment::all()->each(function (Comment $comment){
           if($comment->id === 3){
               $comment->parent_id = 1 ;
               $comment->save();
               dump($comment->parent_id);
           }
        });

    }
}
