<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
        $comment_id = Comment::all()->random()->id ;
        $post_id = Comment::all()->random()->id ;
        return [
            'reaction' => 'L' , //for Love or Like
            'reactionable_type' => 'App\Models\Comment' ,
            'reactionable_id' => $comment_id,
        ];
    }
}
