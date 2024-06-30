<?php

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('get all categories', function () {
    $randNumber = fake()->numberBetween(5, 20);

    \App\Models\Category::factory($randNumber)->create();

    $response = $this->get('/categories');

    $response->assertStatus(200);

    expect(count($response->getOriginalContent()->all()))->toBe($randNumber);
});

