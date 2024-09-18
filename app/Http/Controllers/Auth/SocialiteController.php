<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        // Redirect the user to Google OAuth page
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // Get the user information from Google
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Check if the user exists by Google ID first, then by email
            $user = User::where('google_id', $googleUser->getId())->orWhere('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Register a new user if they don't exist
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                ]);
            }

            // Login the user
            Auth::login($user);

            // Create the API token for the authenticated user
            $token = $user->createToken('auth_token')->plainTextToken;

            // Respond with the token and user details for frontend use
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
                'status' => 'Login successful',
            ], 200);

        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Google OAuth Error: ' . $e->getMessage());

            // Return JSON error response for frontend to handle
            return response()->json([
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }
}
