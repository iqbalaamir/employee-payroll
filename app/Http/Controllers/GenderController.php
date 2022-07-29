<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Employee;
use App\Models\Gender;
use App\Models\module_permission;

class GenderController extends Controller
{

    public function genderView()
    {
        $genders = Gender::orderBy('id','DESC')->get();

        return view('organisation.genders',compact('genders'));
    }

     //add the gender
     public function addGender(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
         ]);
 
         $genders = new Gender;
         $genders->name = $request->name;
         $genders->save();
         
         Toastr::success('Gender has been added successfully :)','Success');
         return redirect()->route('organisation/genders');
     }
 
     //edit or update the genders
     public function editGender(Request $request)
     {   
         try{
             $update_Gender = [
                 'name'=>$request->name,
             ];
     
             Gender::where('id',$request->id)->update($update_Gender);
 
             Toastr::success('Updated record successfully :)','Success');
             return redirect()->route('genders');
 
         }catch(\Exception $e){
             // Toastr::error('Failed to Update the record','Error');
             return redirect()->back();
         }
     }
 
    //delete gender
    public function deleteGender($gender_id)
    {
        try{
            Gender::where('id',$gender_id)->delete();

        Toastr::success('Record has been deleted successfully :)','Success');
        return redirect()->route('genders');

        }catch(\Exception $e){
            // Toastr::error('Failed to Delete the record','Error');
            return redirect()->back();
        }
    }
}
