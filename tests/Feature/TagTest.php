<?php

test('get all tags', function () {
    $randNumber = fake()->numberBetween(5, 20);

    \App\Models\Tag::factory($randNumber)->create();

    $response = $this->get('/api/tags');

    $response->assertStatus(200);

    expect(count($response->getOriginalContent()->all()))->toBe($randNumber);
});
