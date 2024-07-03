<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            "slug" => $this->slug,
            "title" => $this->title,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "user" => [
                "username" => $this->user->username,
                "name" => $this->user->name,
                "avatar" => $this->user->avatar,
                "role" => $this->user->role->name
            ],
            "category" => [
                "name" => $this->category->name,
                "slug" => $this->category->slug
            ],
            "tags" => $this->tags->select(['name', 'slug', 'color'])
        ];

        if (!in_array('content', $hidden)) {
            $data["content"] = $this->content;
        }

        if (!in_array('excerpt', $hidden)) {
            $data["excerpt"] = $this->excerpt;
        }

        return $data;
    }
}
