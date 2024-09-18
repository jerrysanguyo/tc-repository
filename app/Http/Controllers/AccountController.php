<?php

namespace App\Http\Controllers;

use App\{
    Models\User,
    Models\Department,
    Models\UserDetail,
    Models\UserValidation,
    DataTables\UniversalDataTable,
    Services\UserValidationService,
    Services\RegisterService,
    Http\Requests\UserValidationRequest,
    Http\Requests\UserDetailRequest,
};
use Illuminate\{
    Http\Request,
    Support\Facades\Auth,
};

class AccountController extends Controller
{
    protected $userValidation;
    protected $registerService;

    public function __construct(UserValidationService $userValidation, RegisterService $registerService)
    {
        $this->userValidation = $userValidation;
        $this->registerService = $registerService;
    }

    public function index(UniversalDataTable $dataTable)
    {
        $department = Auth::user()->load('detail')->detail->department_id;
        $allUser = User::getAllUser($department);

        return $dataTable->render('cms.account.index', compact(
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

    public function edit(User $account)
    {
        $listOfDepartment = Department::getAllDepartment();
        return view('cms.account.edit', compact(
            'account',
            'listOfDepartment'
        ));
    }

    public function update(UserDetailRequest $request, UserDetail $account)
    {
        $role = Auth::user()->role;
        $this->registerService->userUpdate($account, $request->validated());

        return redirect()->route($role . '.account.edit', $account)->with('success', 'User updated successfully!');
    }
}
