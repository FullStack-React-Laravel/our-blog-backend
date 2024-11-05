<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\API\V1\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class LatestPosts extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return PostResource::collection(
            Post::query()->latest()->take(3)->get()->makeHidden(['content'])
        );
    }
}
