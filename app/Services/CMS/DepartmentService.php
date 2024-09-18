<?php

namespace App\Services\CMS;

use App\{
    Models\Department,
};

use Illuminate\{
    Support\Facades\Auth,
};

class DepartmentService
{
    public function store(array $data): Department
    {
        return Department::create([
            'name'          =>  $data['name'],
            'remarks'       =>  $data['remarks'],
            'created_by'    =>  Auth::user()->id,
            'updated_by'    =>  Auth::user()->id,
        ]);
    }

    public function update($Department, array $data): Department
    {
        $Department->update([
            'name'          =>  $data['name'],
            'remarks'       =>  $data['remarks'],
            'updated_by'    =>  Auth::user()->id,
        ]);

        return $Department;
    }

    public function destroy($Department): Department
    {
        $Department->delete();

        return $Department;
    }
}