<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;

    protected $table = 'otps';
    protected $fillable = [
        'otp',
        'user_id',
        'remarks',
    ];

    public static function getOtp($userId)
    {
        return self::where('user_id', $userId);
    }

    public function user()
    {
        return $this->belongsTO(User::class, 'user_id');
    }
}
