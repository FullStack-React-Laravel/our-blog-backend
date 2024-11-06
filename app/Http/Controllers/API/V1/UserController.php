<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        return UserResource::collection(User::with('role')->get())->response();
    }

    /**
     * return the current authenticated user
     */
    public function authUser()
    {
        $user = User::with('role')->find(auth()->user())->first();
        return UserResource::make($user)->response();
    }
}
