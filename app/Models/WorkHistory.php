<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkHistory extends Model
{
    use HasFactory;
    protected $table = "work_history";

    protected $fillable = [
        'employee_id',
        'department_id',
        'employment_status',
        'employee_type',
        'company_name',
        'job_title',
        'start_date',
        'end_date',
        'description' 
    ];

    // Relationship to Employee
    public function employees() {
        return $this->belongsto(Employee::class);
    }
}
