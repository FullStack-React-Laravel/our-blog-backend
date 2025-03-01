<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method getHidden()
 */
class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $hidden = $this->getHidden();

        $data = [
            'slug' => $this->slug,
            'title' => $this->title,
            'attachment' => $this->attachment,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => UserResource::make($this->user),
            'category' => CategoryResource::make($this->category),
            'tags' => TagResource::collection($this->tags)
        ];

        foreach (['content', 'excerpt'] as $item) {
            if (!in_array($item, $hidden)) {
                $data[$item] = $this->$item;
            }
        }

        return $data;
    }
}
