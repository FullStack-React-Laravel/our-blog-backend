<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\StorePostRequest;
use App\Http\Requests\API\V1\UpdatePostRequest;
use App\Http\Resources\API\V1\PostCollection;
use App\Http\Resources\API\V1\PostResource;
use App\Models\Post;
use App\Traits\HasSearch;
use App\Traits\ResponseHandler;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class PostController extends Controller
{
    use HasSearch, ResponseHandler;

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
    public function store(StorePostRequest  $request)
    {
        $request->validated();
        return Post::create($request->toArray()) ? $this->responseSuccess('new post has been added successfully', 201)
            : $this->responseFailure('somthing went wrong', 'unKnown', 200);
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
        $request->validated();
        return $post->update($request->toArray()) ?
            $this->responseSuccess('post has been updated', 200) : $this->responseFailure('somthing went wrong','unknown', 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->noContent();
    }
}
