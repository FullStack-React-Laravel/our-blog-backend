<?php

use Illuminate\Support\Facades\DB;

test('get all users with role', function () {
    $randNumber = fake()->numberBetween(5, 20);

    \App\Models\User::factory()->create([
        'role_id' => DB::table('roles')->where('name', '=', 'admin')->value('id'),
    ]);
    \App\Models\User::factory($randNumber)->create();

    $response = $this->get('/users');

    $response->assertStatus(200);

    expect(count($response->getOriginalContent()->all()))->toBe($randNumber + 1)
        ->and($response->getOriginalContent()->first()->role->name)->toBeString()
        ->and(
            $response->getOriginalContent()
                ->where('role_id', '=', DB::table('roles')->where('name', '=', 'admin')->value('id'))
                ->count()
        )->toBe(1)
        ->and(
            $response->getOriginalContent()
                ->where('role_id', '=', DB::table('roles')->where('name', '=', 'user')->value('id'))
                ->count()
        )->toBe($randNumber);
});
