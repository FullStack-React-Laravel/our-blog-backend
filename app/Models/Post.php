<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory, Searchable;

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

    public function searchableAs():string{
        return 'posts_index';
    }
//    public function toSearchableArray()
//    {
//        return [
//            'title' => $this->title,
//        ];
//    }


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->attributes['slug'] = $this->getSlug();
    }

    public function getSlug(): string
    {
        $max_char = 20;
        $slug = Str::slug($this->title);

        if (strlen($slug) > $max_char) {
            $position = Str::position($slug, '-', $max_char);

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

    public function reactions(){
        return $this->morphMany('App\Models\Reaction' , 'reactionable');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
