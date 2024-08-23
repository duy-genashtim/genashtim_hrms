<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    use HasFactory;

    protected $table = "employee_performance";

    protected $fillable = [
        'employee_id',
        'performance_dates',
        'performance_scores',
        'description'    
    ];
}
