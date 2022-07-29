<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
use App\Models\AgeGroup;
use App\Models\Ethnicity;
use App\Models\Gender;
use App\Models\Level;
use App\Models\Region;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $guarded = ['id'];

    protected $fillable = [
        'id',
        'name',
        'email',
        'department_id',
        'designation_id',
        'level_id',
        'reporting_mgr_id',
        'age_group_id',
        'ethnicity_id',
        'date_of_join',
        'gender_id',
        'region_id'
    ];

    protected $date_of_join = ['date_of_join'];

    public function departments() 
    {
		return $this->belongsTo('App\Models\Department', 'department_id');
	  }

    public function designations() 
    {
		return $this->belongsTo('App\Models\Designation', 'designation_id');
	}

    public function levels() 
    {
		return $this->belongsTo('App\Models\Level', 'level_id');
	}

    public function reporting_manager() 
    {
		return $this->belongsTo('App\Models\User', 'reporting_mgr_id');
	}

    public function age_groups() 
    {
		return $this->belongsTo('App\Models\AgeGroup', 'age_group_id');
	}

    public function genders() 
    {
		return $this->belongsTo('App\Models\Gender', 'gender_id');
	}

    public function regions() 
    {
		return $this->belongsTo('App\Models\Region', 'region_id');
	}

}
