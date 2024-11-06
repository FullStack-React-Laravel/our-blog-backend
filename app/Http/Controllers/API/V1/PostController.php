<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\StorePostRequest;
use App\Http\Requests\API\V1\UpdatePostRequest;
use App\Http\Resources\API\V1\PostCollection;
use App\Http\Resources\API\V1\PostResource;
use App\Models\Post;
use App\Traits\HasSearch;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    use HasSearch;

    public function __construct()
    {
        $this->model = Post::class;
        $this->resource_callback = PostResource::class;
        $this->searchable = ['title', 'excerpt'];
        $this->makeHidden = ['content'];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return PostResource::collection(
        //     Post::query()->latest()->get()->makeVisible(['excerpt'])
        // );
        return (new PostCollection(
            Post::latest()
                ->paginate(3)
        ))->response()->setStatusCode(200);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): PostResource|JsonResponse
    {
        return PostResource::make($post->makeHidden(['excerpt']));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
