<?php

namespace App\Http\Controllers\Auth;

use App\{
    Http\Controllers\Controller,
    Http\Models\User,
    Http\Models\UserDetail,
    Http\Models\Otp,
    Http\Requests\RegisterRequest,
    Services\RegisterService,
};
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function index()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        // storing account.
        $user = $this->registerService->register($request->validated());
        
        return redirect()->route('verification', ['userId' => $user->id])
                         ->with('success', 'Registration successful! We have sent an OTP to your email.');
    }
}
