<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Employee;
use App\Models\Region;
use App\Models\module_permission;

class RegionController extends Controller
{

    public function regionView()
    {
        $region = Region::orderBy('id','DESC')->get();

        return view('organisation.region',compact('region'));
    }

     //add the region
     public function addRegion(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
         ]);
 
         $region = new Region;
         $region->name = $request->name;
         $region->save();
         
         Toastr::success('Region has been added successfully :)','Success');
         return redirect()->route('organisation/region');
     }
 
     //edit or update the region
     public function editRegion(Request $request)
     {   
         try{
             $update_region = [
                 'name'=>$request->name,
             ];
     
             Region::where('id',$request->id)->update($update_region);
 
             Toastr::success('Updated record successfully :)','Success');
             return redirect()->route('region');
 
         }catch(\Exception $e){
             // Toastr::error('Failed to Update the record','Error');
             return redirect()->back();
         }
     }
 
    //delete Region
    public function deleteRegion($region_id)
    {
        try{
            Region::where('id',$region_id)->delete();

        Toastr::success('Record has been deleted successfully :)','Success');
        return redirect()->route('region');

        }catch(\Exception $e){
            // Toastr::error('Failed to Delete the record','Error');
            return redirect()->back();
        }
    }
}
