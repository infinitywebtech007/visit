<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    /** @use HasFactory<\Database\Factories\VisitorFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'address',
        'company_name',
        'photo_url',
        'id_proof',
        'id_proof_img',
    ];

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}
