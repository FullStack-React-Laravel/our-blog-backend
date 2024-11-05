<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return response()->json([
            'success' => true,
            'message' => 'user logged in successfully',
            'data'    => [
                'name' => auth()->user()->name,
                'username' => auth()->user()->name,
                'token' => null // this will be usefull if every user has an api token so that for each request that usr make we should authorize the request with his token
            ]
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json([
            'success' => true,
            'message' => 'user has logged out successfully'
        ]);
    }
}
