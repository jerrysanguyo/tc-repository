<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    
    protected $table = 'tags';
    protected $fillable = [
        'name',
        'remarks',
        'department_id',
        'created_by',
        'updated_by',
    ];

    public static function getAllTags()
    {
        return self::all();
    }

    public static function tagsDepartment($department)
    {
        return self::where('department_id', $department);
    }  

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
