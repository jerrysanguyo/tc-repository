<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            'Information Technology',
            'Public Information Office',
            'City Treasury Office'
        ];

        foreach ($departments as $department) {
            Department::create([
                'name'          =>  $department,
                'remarks'       =>  'Seeder generated',
                'created_by'    =>  1,
                'updated_by'    =>  1,
            ]);
        }
    }
}
