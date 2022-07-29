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
use App\Models\module_permission;

class EmployeesController extends Controller
{
    // employee view
    public function employeeViews()
    {
        $employees = Employee::orderBy('id','DESC')->get();
        $department = Department::orderBy('id','DESC')->get();
        $designation = Designation::orderBy('id','DESC')->get();
        $age_group = AgeGroup::orderBy('id','DESC')->get();
        $gender = Gender::orderBy('id','DESC')->get();
        $level = Level::orderBy('id','DESC')->get();
        $region = Region::orderBy('id','DESC')->get();
        $reporting_mgr = User::orderBy('id','DESC')->get();

        return view('organisation.employees',compact(['employees','department','designation','age_group','reporting_mgr','gender','level','region']));
    }

     //add the employee
     public function addEmployees(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|email',
         ]);
 
         $employee = new Employee;
         $employee->name = $request->name;
         $employee->email = $request->email;
         $employee->department_id = $request->department_id;
         $employee->designation_id = $request->designation_id;
         $employee->level_id = $request->level_id;
         $employee->reporting_mgr_id = $request->reporting_mgr_id;
         $employee->age_group_id = $request->age_group_id;
         $employee->date_of_join = $request->date_of_join;
         $employee->gender_id = $request->gender_id;
         $employee->region_id = $request->region_id;
         $employee->save();
         
         Toastr::success('Employee has been added successfully :)','Success');
         return redirect()->route('organisation/employees');
     }
 
     //edit or update the employee
     public function editEmployees(Request $request)
     {   
         try{
             $update_employee = [
                 'name'=>$request->name,
                 'email' => $request->email,
                 'department_id' => $request->department_id,
                 'designation_id' => $request->designation_id,
                 'level_id' => $request->level_id,
                 'reporting_mgr_id' => $request->reporting_mgr_id,
                 'age_group_id' => $request->age_group_id,              
                 'date_of_join' => $request->date_of_join,
                 'gender_id' => $request->gender_id,
                 'region_id' => $request->region_id,
             ];
     
             Employee::where('id',$request->id)->update($update_employee);
 
             Toastr::success('Updated record successfully :)','Success');
             return redirect()->route('employees');
 
         }catch(\Exception $e){
             // Toastr::error('Failed to Update the record','Error');
             return redirect()->back();
         }
     }
 
    //delete employee
    public function deleteEmployees($employee_id)
    {
        try{
            Employee::where('id',$employee_id)->delete();

        Toastr::success('Record has been deleted successfully :)','Success');
        return redirect()->route('employees');

        }catch(\Exception $e){
            // Toastr::error('Failed to Delete the record','Error');
            return redirect()->back();
        }
    }
}
