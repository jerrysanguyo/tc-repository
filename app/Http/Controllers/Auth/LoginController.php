<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if ($this->authService->login($credentials)) {
            $userId = Auth::id();
            $detailExists = UserDetail::getUserDetails($userId)->first();
            // check if user has details or user is_verified
            if (!$detailExists || Auth::user()->is_verified === false) {
                return redirect()->route('verification', $userId)->with('error', 'Kindly complete the registration');
            } else {
                // if both verified true it will log in the user.
                return $this->authService->redirectUserBasedOnRole(Auth::user());
            }
        }

        return back()->withErrors([
            //if account doesn't exist
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
