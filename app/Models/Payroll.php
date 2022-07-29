<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payroll extends Model
{
    use HasFactory;

    protected $table = 'payroll';

    protected $fillable = [
        'id',
        'employee_id',
        'basic',
        'hra',
        'allowance',
        'medical_allowance',
        'pf',
        'salary',
    ];

    public function employee() 
    {
		return $this->belongsTo('App\Models\Employee', 'employee_id');
	}


}
