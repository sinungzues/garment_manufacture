<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Metode untuk menulis log ke dalam database
    public static function writeLog($message, $level = 'info', $id, $context = [])
    {
        self::create([
            'message' => $message,
            'level' => $level,
            'id_user_in' => $id,
            'context' => json_encode($context),
        ]);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
