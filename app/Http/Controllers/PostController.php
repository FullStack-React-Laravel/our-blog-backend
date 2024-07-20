<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
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
    public function index(): AnonymousResourceCollection
    {
        return PostResource::collection(
            Post::query()->latest()->get()->makeVisible(['excerpt'])
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show($slug): PostResource|JsonResponse
    {
        $post = Post::all()->where('slug', $slug)->first();

        if (!$post) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return PostResource::make($post->makeHidden(['excerpt']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
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
