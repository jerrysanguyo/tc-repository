<?php

namespace App\Services;

use App\{
    Models\UserValidation,
    Models\UserDetail,
};
use Illuminate\Support\{
    Facades\Mail,
    Facades\Auth,
    Facades\File,
};

class UserValidationService
{
    public function validateUser($userId): UserValidation
    {
        // fetch user details for file name.
        $userDetail = UserDetail::getUserDetails($userId)->first();

        // create the user validation record
        $userValidation = UserValidation::create([
            'user_id'       =>  $userId,
            'validated_by'  =>  Auth::user()->id,
            'remarks'       =>  'User validated'
        ]);

        // create folder in public based on user details
        $folderName = $userDetail->first_name . '-'  . $userDetail->middle_name . '-'  . $userDetail->last_name . '-' . $userId;
        $folderPath = public_path('validated_users/' . $folderName);

        // Create folder if it doesn't exists
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true); // 0755 permission. For more info kindly search hehe.
        }

        return $userValidation;
    }

    public function unvalidateUser($userId): UserValidation
    {
        // Find validation record.
        $validation = UserValidation::where('user_id', $userId)->first();

        // If found, delete and return it.
        if ($validation) {
            $validation->delete();
            return $validation; // return validation if there is a record.
        }

        return null; //return null if no validation found.
    }
}