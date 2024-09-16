<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'email',
        'contact_number',
        'password',
        'is_verified',
        'role',
        'slug'
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getAllUser($department)
    {
        return User::with('detail')
                    ->whereHas('detail', function($accountPerDept) use ($department) {
                        $accountPerDept->where('department_id', $department);
                    })
                    ->get();
    }

    public function detail()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function validation()
    {
        return $this->hasOne(UserValidation::class);
    }
}
