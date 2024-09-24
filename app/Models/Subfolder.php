<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subfolder extends Model
{
    use HasFactory;

    protected $table = 'subfolders';
    protected $fillable = [
        'user_id',
        'subfolder_location',
        'subfolder_path',
        'subfolder_name',
        'remarks',
        'permission',
        'sharable'
    ];

    public function getSubfolder($fileLocation)
    {
        return self::where('subfolder_location', $fileLocation);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
