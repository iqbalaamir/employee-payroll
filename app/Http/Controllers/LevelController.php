<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Employee;
use App\Models\Level;
use App\Models\module_permission;

class LevelController extends Controller
{
    public function levelView()
    {
        $level = Level::orderBy('id','DESC')->get();

        return view('organisation.levels',compact('level'));
    }

     //add the level
     public function addLevel(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
         ]);
 
         $levels = new Level;
         $levels->name = $request->name;
         $levels->save();
         
         Toastr::success('Level has been added successfully :)','Success');
         return redirect()->route('organisation/levels');
     }
 
     //edit or update the level
     public function editLevel(Request $request)
     {   
         try{
             $update_level = [
                 'name'=>$request->name,
             ];
     
             Level::where('id',$request->id)->update($update_level);
 
             Toastr::success('Updated record successfully :)','Success');
             return redirect()->route('levels');
 
         }catch(\Exception $e){
             // Toastr::error('Failed to Update the record','Error');
             return redirect()->back();
         }
     }
 
    //delete gender
    public function deleteLevel($level_id)
    {
        try{
            Level::where('id',$level_id)->delete();

        Toastr::success('Record has been deleted successfully :)','Success');
        return redirect()->route('genders');

        }catch(\Exception $e){
            // Toastr::error('Failed to Delete the record','Error');
            return redirect()->back();
        }
    }
}
