<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $role_id = Role::all()->where('name', '=', 'admin')->value('id');

        $users_admin = User::with('role')
            ->where('role_id', '=', $role_id)
            ->first();

        $category = Category::all()->whenNotEmpty(fn($query) => $query->random(1))->value('id');

        $date = fake()->date();

        return [
            'title' => join(' ', fake()->unique()->words(fake()->numberBetween(4, 8))),
            'excerpt' => fake()->sentence(20),
            'content' => fake()->paragraph(10),
            'attachment' => fake()->imageUrl,
            'user_id' => $users_admin ?? User::factory(1)->create(['role_id' => $role_id])->first()['id'],
            'category_id' => $category ?? Category::factory(10)->create()->random(1)->value('id'),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
