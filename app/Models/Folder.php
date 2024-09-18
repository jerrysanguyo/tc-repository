<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $table = 'folders';
    protected $fillable = [
        'user_id',
        'folder_name',
        'folder_path',
        'permission',
        'remarks'
    ];

    public static function userFolder($userId)
    {
        return self::where('user_id', $userId);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
