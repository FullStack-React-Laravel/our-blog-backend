<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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

        $post_dt = new Carbon($this->created_at);
        $since = $post_dt->diffForHumans(Carbon::now());
        $since = str_replace('before' , 'ago' , $since);



        $data = [
            "slug" => $this->slug,
            "title" => $this->title,
            "attachment" => $this->attachment,
            "user" => UserResource::make($this->user),
            "category" => CategoryResource::make($this->category),
            "comments" => CommentResource::collection($this->comments),
            "since" => $since,
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
