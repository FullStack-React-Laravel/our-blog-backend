<?php

namespace App\Http\Controllers\API\V1;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(User::with('role')->get());
    }

    /**
     * return the current authenticated user
     */
    public function authUser()
    {
        return response()->json([
            'name' => auth()->user()->name,
            'username' => auth()->user()->username,
            'role' => auth()->user()->role
        ]);
    }
}
