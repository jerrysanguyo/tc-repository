<?php

namespace App\Services;

use App\{
    Models\User,
    Models\Otp,
    Models\userDetail,
    Mail\OtpMail,
};
use Illuminate\Support\{
    Facades\Hash,
    Facades\Mail,
    Str,
};

class RegisterService
{
    public function register(array $data): User
    {
        $user = User::create([
            'email'             => $data['email'],
            'contact_number'    => $data['contact_number'],
            'password'          => Hash::make($data['password']),
            'is_verified'       =>  0,
            'role'              => 'user',
        ]);

        $otp = Str::upper(Str::random(6));

        Otp::create([
            'otp'   =>  $otp,
            'user_id'   =>  $user->id,
            'remarks'   =>  'registration',
        ]);

        Mail::to($user->email)->send(new OtpMail($otp));

        return $user;
    }

    public function otpVerify($userId)
    {
        $user = User::findOrFail($userId);
        $user->update([
            'is_verified' => 1,
            'email_verified_at' =>  now(),
        ]);

        return $user;
    }

    public function userDetail($userId, array $data): UserDetail
    {
        return UserDetail::updateOrCreate(
            ['user_id' => $userId], 
            [
                'first_name'    => $data['first_name'],
                'middle_name'   => $data['middle_name'] ?? '', 
                'last_name'     => $data['last_name'],
                'department_id' => $data['department_id'],
            ]
        );
    }

    public function userUpdate($account, array $data): UserDetail
    {
        $account->update([
            'first_name'    =>  $data['first_name'],
            'middle_name'   =>  $data['middle_name'],
            'last_name'     =>  $data['last_name'],
            'department_id' =>  $data['department_id'],
        ]);

        return $account;
    }
}