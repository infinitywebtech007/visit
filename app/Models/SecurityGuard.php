<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecurityGuard extends Model
{
    /** @use HasFactory<\Database\Factories\SecurityGuardFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'company',
        'shift',
        'photo',
        'active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
