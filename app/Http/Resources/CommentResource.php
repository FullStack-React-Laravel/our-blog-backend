<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $comment_dt = new Carbon($this->created_at);
        $since = $comment_dt->diffForHumans(Carbon::now());
        $since = str_replace('before' , 'ago' , $since);
        return [
            'text'=> $this->text ,
            'since' => $since,
            'user' => UserResource::make($this->user),
//            'post' => PostResource::make($this->post),
            'replay_to' => CommentResource::make(Comment::find($this->parent_id)),
            'reactions' => ReactionResource::collection($this->reactions),
        ];
    }
}
