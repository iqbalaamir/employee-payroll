<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Employee;
use App\Models\Department;
use App\Models\module_permission;

class DepartmentController extends Controller
{
    public function deptView()
    {
        $departments = Department::orderBy('id','DESC')->get();

        return view('organisation.departments',compact('departments'));
    }

     //add the departments
     public function addDept(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
         ]);
 
         $departments = new Department;
         $departments->name = $request->name;
         $departments->save();
         
         Toastr::success('Department has been added successfully :)','Success');
         return redirect()->route('organisation/departments');
     }
 
     //edit or update the departments
     public function editDept(Request $request)
     {   
         try{
             $update_age_group = [
                 'name'=>$request->name,
             ];
     
             Department::where('id',$request->id)->update($update_age_group);
 
             Toastr::success('Updated record successfully :)','Success');
             return redirect()->route('departments');
 
         }catch(\Exception $e){
             // Toastr::error('Failed to Update the record','Error');
             return redirect()->back();
         }
     }
 
    //delete department
    public function deleteDept($dept_id)
    {
        try{
        Department::where('id',$dept_id)->delete();

        Toastr::success('Record has been deleted successfully :)','Success');
        return redirect()->route('departments');

        }catch(\Exception $e){
            // Toastr::error('Failed to Delete the record','Error');
            return redirect()->back();
        }
    }
}
