<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
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
        $name = join(" ", fake()->unique()->words(fake()->numberBetween(4, 8)));

        $role_id = Role::all()->where('name', '=', 'admin')->value('id');

        $users_admin = User::with('role')
            ->where('role_id', '=', $role_id)
            ->first();

        $category = Category::all()->whenNotEmpty(fn($query) => $query->random())->value('id');

        return [
            'title' => $name,
            'excerpt' => fake()->sentence(20),
            'content' => fake()->paragraph(10),
            'attachment' => fake()->imageUrl,
            'slug' => Str::slug($name),
            'user_id' => $users_admin ?? User::factory(1)->create(['role_id' => $role_id])->first()['id'],
            'category_id' => $category ?? Category::factory(1)->create()->first()['id'],
        ];
    }
}
