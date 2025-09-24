<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /** @use HasFactory<\Database\Factories\ReportFactory> */
    use HasFactory;
    
    protected $guarded = [];

    // Relationships
    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
    
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    
    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
    
    // Scopes for filtering
    public function scopeDateWise($query, $dateFrom, $dateTo)
    {
        return $query->whereHas('visit', function($q) use ($dateFrom, $dateTo) {
            $q->whereBetween('created_at', [$dateFrom, $dateTo]);
        });
    }
    
    public function scopeEmployeeWise($query, $employeeId)
    {
        return $query->whereHas('visit', function($q) use ($employeeId) {
            $q->where('employee_id', $employeeId);
        });
    }
    
    public function scopeVisitorWise($query, $visitorId)
    {
        return $query->whereHas('visit', function($q) use ($visitorId) {
            $q->where('visitor_id', $visitorId);
        });
    }
    
    // Helper methods
    public function getTotalVisits()
    {
        return $this->visit()->count();
    }

}
