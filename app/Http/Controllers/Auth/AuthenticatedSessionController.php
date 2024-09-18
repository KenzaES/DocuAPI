<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\RateLimiter;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request input
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Rate limiting to prevent brute force attacks
        $throttleKey = strtolower($request->input('email')).'|'.$request->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            return response()->json(['message' => 'Too many login attempts. Try again later.'], 429);
        }

        // Attempt to authenticate the user
        if (!Auth::attempt($request->only('email', 'password'))) {
            RateLimiter::hit($throttleKey); // Increment rate limit counter
            return response()->json(['message' => 'Invalid login credentials'], 401);
        }

        // Clear rate limiting if login is successful
        RateLimiter::clear($throttleKey);

        // Get the authenticated user and create a token
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
            'status' => 'Login successful',
        ], 200);
    }

    public function destroy(Request $request)
    {
        // Delete only the current access token
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout successful'], 200);
    }

    // Optional: To revoke all tokens on logout
    public function destroyAll(Request $request)
    {
        // Delete all tokens for the user
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logout from all devices successful'], 200);
    }
}
