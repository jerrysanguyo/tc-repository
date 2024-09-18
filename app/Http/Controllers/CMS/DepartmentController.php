<?php

namespace App\Http\Controllers\CMS;

use App\{
    Http\Controllers\Controller,
    Http\Requests\CMS\DepartmentRequest,
    DataTables\UniversalDataTable,
    Services\CMS\DepartmentService,
    Models\Department,
};

use Illuminate\{
    Support\Facades\Auth,
};

class DepartmentController extends Controller
{
    protected $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function index(UniversalDataTable $dataTable)
    {
        $data = Department::getAllDepartment();
        $pageTitle = 'Department';
        $columns = ['Name', 'Remarks', 'Created by', 'Updated by', 'Action'];

        return $dataTable->render('cms.universal.index', compact(
            'data', 
            'pageTitle', 
            'columns',
        ));
    }
    
    public function store(DepartmentRequest $request)
    {
        $userRole = Auth::user()->role;
        $this->departmentService->store($request->validated());

        return redirect()->route($userRole . '.Department.index')->with('success', 'Department added successfully!');
    }
    
    public function edit(Department $Department)
    {
        $pageTitle = 'Department';
        $$pageTitle = $Department;

        return view('cms.universal.edit', compact(
            $pageTitle, 
            'pageTitle'
        ));
    }
    
    public function update(DepartmentRequest $request, Department $Department)
    {
        $userRole = Auth::user()->role;
        $this->departmentService->update($Department, $request->validated());

        return redirect()->route($userRole . '.Department.edit', $Department)->with('success', 'Department updated successfully!');
    }
    
    public function destroy(Department $Department)
    {
        $userRole = Auth::user()->role;
        $this->departmentService->destroy($Department);

        return redirect()->route($userRole . '.Department.index')->with('success', 'Department deleted successfully!');
    }
}
