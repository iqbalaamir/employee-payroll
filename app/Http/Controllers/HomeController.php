<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Employee;
use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
use App\Models\AgeGroup;
use App\Models\Gender;
use App\Models\Level;
use App\Models\Region;
use App\Models\Holiday;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $employees = Employee::orderBy('id','DESC')->get();
        $department = Department::orderBy('id','DESC')->get();
        $designation = Designation::orderBy('id','DESC')->get();
        $age_group = AgeGroup::orderBy('id','DESC')->get();
        $gender = Gender::orderBy('id','DESC')->get();
        $level = Level::orderBy('id','DESC')->get();
        $region = Region::orderBy('id','DESC')->get();
        $reporting_mgr = User::orderBy('id','DESC')->get();
        $holidays = Holiday::orderBy('holiday_date','ASC')->get();

        return view('home',compact(['employees','department','designation','age_group','reporting_mgr','gender','level','region','holidays']));
    }
}
