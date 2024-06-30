<?php

test('get all posts with category, user, and tags', function () {
    $randNumber = fake()->numberBetween(5, 20);

    \App\Models\Post::factory($randNumber)->hasTags(3)->create();

    $response = $this->get('/posts');

    $response->assertStatus(200);

    expect(count($response->getOriginalContent()->all()))->toBe($randNumber)
        ->and($response->getOriginalContent()->first()->user->name)->toBeString()
        ->and($response->getOriginalContent()->first()->category->name)->toBeString()
        ->and(count($response->getOriginalContent()->first()->tags))->toBe(3)
        ->and($response->getOriginalContent()->first()->tags->first()->name)->toBeString();
});
