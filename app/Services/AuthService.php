<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            session()->regenerate();

            return $this->redirectUserBasedOnRole(Auth::user());
        }

        return false;
    }

    protected function redirectUserBasedOnRole($user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'superadmin') {
            return redirect()->route('superadmin.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }

        return redirect()->route('user.dashboard');
    }
}
