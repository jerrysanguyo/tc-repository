<?php

namespace App\Http\Controllers\Auth;

use App\{
    Http\Controllers\Controller,
    Http\Requests\OtpRequest,
    Http\Requests\UserDetailRequest,
    Models\Otp,
    Models\User,
    Models\Department,
    Services\RegisterService,
};
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    protected $registerService;
    
    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function index($userId)
    {
        $listOfDepartment = Department::getAllDepartment();
        $user = User::findOrFail($userId);
        return view('auth.verify', compact(
            'user',
            'listOfDepartment',
        ));
    }

    public function verify(OtpRequest $request, $userId)
    {
        $otpRecord = Otp::getOtp($userId)->first();
        // check if the otp that was sent to email and otp entered is matched.
        if ($otpRecord && $otpRecord->Otp === $request->otp) {
            //update the is_verified to true.
            $this->registerService->otpVerify($userId);

            return redirect()->route('verification', $userId)
                            ->with('success', 'OTP verified successfully!');
        } else {
            // if otp incorrect this will pop up.
            return back()->withError(['otp' =>  'The OTP that you entered is incorrect.']);
        }
    }

    public function userDetail( $userId, UserDetailRequest $request)
    {
        // store for storing user details.
        $this->registerService->userDetail($userId, $request->validated());
        
        return redirect()->route('login')->with('success', 'You may now login your account!');
    }
}
