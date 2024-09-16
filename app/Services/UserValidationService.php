<?php

namespace App\Services;

use App\{
    Models\UserValidation,
};
use Illuminate\Support\{
    Facades\Mail,
    Facades\Auth,
};

class UserValidationService
{
    public function validateUser($userId): UserValidation
    {
        return UserValidation::create([
            'user_id'       =>  $userId,
            'validated_by'  =>  Auth::user()->id,
            'remarks'       =>  'User validated'
        ]);
    }

    public function unvalidateUser($userId): UserValidation
    {
        $validation = UserValidation::where('user_id', $userId)->first();

        if ($validation) {
            $validation->delete();
            return $validation;
        }

        return null;
    }
}