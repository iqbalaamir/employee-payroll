<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Employee;
use App\Models\Holiday;


class HolidayController extends Controller
{
    public function holidayView()
    {
        $holidays = Holiday::orderBy('holiday_date','ASC')->get();

        return view('organisation.holidays',compact('holidays'));
    }

     //add the holidays
     public function addHoliday(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'holiday_date' => 'required|date',
         ]);
 
         $holidays = new Holiday;
         $holidays->name = $request->name;
         $holidays->holiday_date = $request->holiday_date;
         $holidays->save();
         
         Toastr::success('Holiday has been added successfully :)','Success');
         return redirect()->route('organisation/holidays');
     }
 
     //edit or update the holidays
     public function editHoliday(Request $request)
     {   
         try{
             $update_holiday = [
                 'name'=>$request->name,
                 'holiday_date'=>$request->holiday_date,
             ];
     
             Holiday::where('id',$request->id)->update($update_holiday);
 
             Toastr::success('Updated record successfully :)','Success');
             return redirect()->route('holidays');
 
         }catch(\Exception $e){
             // Toastr::error('Failed to Update the record','Error');
             return redirect()->back();
         }
     }
 
    //delete holiday
    public function deleteHoliday($holiday_id)
    {
        try{
            Holiday::where('id',$holiday_id)->delete();

        Toastr::success('Record has been deleted successfully :)','Success');
        return redirect()->route('genders');

        }catch(\Exception $e){
            // Toastr::error('Failed to Delete the record','Error');
            return redirect()->back();
        }
    }
}
