<?php

namespace App\Http\Controllers;

use App\{
    Models\User,
    Models\UserDetail,
    Models\UserValidation,
    DataTables\UniversalDataTable,
    Services\UserValidationService,
    Http\Requests\UserValidationRequest,
};
use Illuminate\{
    Http\Request,
    Support\Facades\Auth,
};

class AccountController extends Controller
{
    protected $userValidation;

    public function __construct(UserValidationService $userValidation)
    {
        $this->userValidation = $userValidation;
    }

    public function index(UniversalDataTable $dataTable)
    {
        $department = Auth::user()->load('detail')->detail->department_id;
        $allUser = User::getAllUser();
        // $adminDepartment = UserDetail::accountPerDepartment($department)->get();

        return $dataTable->render('cms.index', compact(
            // 'adminDepartment',
            'allUser',
        ));
    }

    public function accountValidate($userId)
    {
        $role = Auth::user()->role;
        $this->userValidation->validateUser($userId);
        
        return redirect()->route($role . '.account.index')->with('success', 'Account validated successfully!');
    }

    public function accountUnvalidate($userId)
    { 
        $role = Auth::user()->role;
        $this->userValidation->unvalidateUser($userId);

        return redirect()->route($role . '.account.index')->with('success', 'Account unvalidated successfully!');
    }
}
