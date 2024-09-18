<?php

namespace App\Services;

use App\{
    Models\UserValidation,
    Models\UserDetail,
    Models\Folder,
};
use Illuminate\Support\Facades\{
    Auth,
    File,
};

class UserValidationService
{
    public function validateUser($userId): UserValidation
    {
        // Fetch user details for file name.
        $userDetail = UserDetail::getUserDetails($userId)->first();

        // Create the user validation record.
        $userValidation = UserValidation::create([
            'user_id'       => $userId,
            'validated_by'  => Auth::user()->id,
            'remarks'       => 'User validated'
        ]);

        // Create folder name based on user details.
        $folderName = $userDetail->first_name . '-' . $userDetail->middle_name . '-' . $userDetail->last_name . '-' . $userId;
        $folderPath = public_path('validated_users/' . $folderName);

        // Check if the folder exists in the database.
        $folderExists = Folder::userFolder($userId)->first();

        if (!$folderExists) {
            // Create folder if it doesn't exist in the file system.
            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true); // Folder creation with 0755 permissions.
            }

            // If the folder record doesn't exist, create it.
            Folder::create([
                'user_id'     => $userId,
                'folder_name' => $folderName,
                'folder_path' => $folderPath,
                'permission'  => '0755',
                'remarks'     => 'validated',
            ]);
        } else {
            // If the folder record exists, just update the remarks to 'validated'.
            $folderExists->update(['remarks' => 'validated']);
        }

        return $userValidation;
    }

    public function unvalidateUser($userId): ?UserValidation
    {
        // Find the validation record.
        $validation = UserValidation::where('user_id', $userId)->first();

        // If found, delete the validation record.
        if ($validation) {
            $validation->delete();

            // Check if the folder record exists.
            $folderExists = Folder::userFolder($userId)->first();
            if ($folderExists) {
                // Update the folder's remarks to 'unvalidated'.
                $folderExists->update(['remarks' => 'unvalidated']);
            }

            return $validation; // Return the deleted validation record.
        }

        return null; // Return null if no validation record is found.
    }
}