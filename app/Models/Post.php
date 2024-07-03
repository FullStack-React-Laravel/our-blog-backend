<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'attachment',
        'excerpt',
        'content',
        'slug'
    ];

    protected $with = [
        'user.role',
        'category',
        'tags'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->attributes['slug'] = $this->getSlug();
    }

    public function getSlug(): string
    {
        $slug = Str::slug($this->title);

        if (strlen($slug) > 10) {
            $position = Str::position($slug, '-', 20);

            if ($position) {
                $slug = Str::substr($slug, 0, $position);
            }
        }

        return $slug . '-' . Str::random(5);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->BelongsToMany(Tag::class);
    }
}
