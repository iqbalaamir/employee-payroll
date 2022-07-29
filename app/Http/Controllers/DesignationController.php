<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Employee;
use App\Models\Designation;
use App\Models\module_permission;

class DesignationController extends Controller
{
    public function desigView()
    {
        $designations = Designation::orderBy('id','DESC')->get();

        return view('organisation.designations',compact('designations'));
    }

     //add the Designation
     public function addDesig(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
         ]);
 
         $designations = new Designation;
         $designations->name = $request->name;
         $designations->save();
         
         Toastr::success('Designation has been added successfully :)','Success');
         return redirect()->route('organisation/designations');
     }
 
     //edit or update the departments
     public function editDesig(Request $request)
     {   
         try{
             $update_age_group = [
                 'name'=>$request->name,
             ];
     
             Designation::where('id',$request->id)->update($update_age_group);
 
             Toastr::success('Updated record successfully :)','Success');
             return redirect()->route('designations');
 
         }catch(\Exception $e){
             // Toastr::error('Failed to Update the record','Error');
             return redirect()->back();
         }
     }
 
    //delete designation
    public function deleteDesig($desig_id)
    {
        try{
            Designation::where('id',$desig_id)->delete();

        Toastr::success('Record has been deleted successfully :)','Success');
        return redirect()->route('designations');

        }catch(\Exception $e){
            // Toastr::error('Failed to Delete the record','Error');
            return redirect()->back();
        }
    }
}
