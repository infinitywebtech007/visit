<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    /** @use HasFactory<\Database\Factories\VisitFactory> */
    use HasFactory;

    protected $fillable = [
        'visitor_id',
        'employee_id',
        'purpose',
        'HOD',
        'prebooked',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class,'HOD','id');
    }


}
