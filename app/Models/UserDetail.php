<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'user_details';

    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'department_id'
    ];
    // fetch User details per user
    public static function getUserDetails($userId)
    {
        return self::where('user_id', $userId);
    }
    
    // uncomment if needed.
    // fetch user with specific department and not validated.
    // public static function accountPerDepartment($department)
    // {
    //     return self::where('department_id', $department);
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
