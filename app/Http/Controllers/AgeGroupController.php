<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\AgeGroup;
use Carbon\Carbon;
use Session;
use Brian2694\Toastr\Facades\Toastr;

class AgeGroupController extends Controller
{
    public function ageGroupsView()
    {
        $age_group = AgeGroup::orderBy('id','DESC')->get();

        return view('organisation.age-groups',compact('age_group'));
    }

    //add the age groups
    public function addAgeGroups(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $age_groups = new AgeGroup;
        $age_groups->name = $request->name;
        $age_groups->save();
        
        Toastr::success('Age Group has been added successfully :)','Success');
        return redirect()->route('organisation/age-groups');
    }

    //edit or update the age groups
    public function editAgeGroups(Request $request)
    {   
        try{
            $update_age_group = [
                'name'=>$request->name,
            ];
    
            AgeGroup::where('id',$request->id)->update($update_age_group);

            Toastr::success('Updated record successfully :)','Success');
            return redirect()->route('age-groups');

        }catch(\Exception $e){
            // Toastr::error('Failed to Update the record','Error');
            return redirect()->back();
        }
    }

    //delete age groups
    public function deleteAgeGroups($age_grp_id)
    {
        try{
            AgeGroup::where('id',$age_grp_id)->delete();

            Toastr::success('Record has been deleted successfully :)','Success');
            return redirect()->route('age-groups');

        }catch(\Exception $e){
            // Toastr::error('Failed to Delete the record','Error');
            return redirect()->back();
        }
    }
}
