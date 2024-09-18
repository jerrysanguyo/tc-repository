<?php

namespace App\Services\CMS;

use App\{
    Models\Tag,
};

use Illuminate\Support\Facades\Auth;

class TagService
{
    public function store(array $data): Tag
    {
        return Tag::create([
            'name'          =>  $data['name'],
            'remarks'       =>  $data['remarks'],
            'department_id' =>  Auth::user()->detail->department_id,
            'created_by'    =>  Auth::user()->id,
            'updated_by'    =>  Auth::user()->id,
        ]);
    }

    public function update($Tag, array $data): Tag
    {
        $Tag->update([
            'name'          =>  $data['name'],
            'remarks'       =>  $data['remarks'],
            'updated_by'    =>  Auth::user()->id,
        ]);

        return $Tag;
    }

    public function destroy($Tag): Tag
    {
        $Tag->delete();

        return $Tag;
    }
}