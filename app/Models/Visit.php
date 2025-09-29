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

    public function scopeOpen($query)
    {
        return $query->whereNull('out_time');
    }

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

    public function getPrebookedAttribute($value)
    {
        return (bool) $value;
    }
    
    public function setPrebookedAttribute($value)
    {
        $this->attributes['prebooked'] = (bool) $value;
    }

    public function setOutTimeAttribute($value=null)
    {   
        if($value && $value instanceof \DateTime) {
            $value = $value->format('Y-m-d H:i:s');
        }
        elseif($value && is_string($value)) {
            $value = date('Y-m-d H:i:s',strtotime($value));
        }
        else {
            $value = date('Y-m-d H:i:s');
        }
        $this->attributes['out_time'] = $value;
    }


}
