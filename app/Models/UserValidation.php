<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserValidation extends Model
{
    use HasFactory;

    protected $table = 'user_validations';
    protected $fillable = [
        'user_id',
        'validated_by',
        'remarks',
    ];

    public static function userStatus($userId)
    {
        return self::where('user_id', $userId);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function validatedBy()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }
}
