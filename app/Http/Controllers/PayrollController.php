<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Payroll;
use DB;
use Brian2694\Toastr\Facades\Toastr;

class PayrollController extends Controller
{
    public function payrollView()
    {
        $payroll = Payroll::orderBy('id','DESC')->with('employee')->get();
   
        $employees= Employee::orderBy('id','DESC')->get();

        return view('payrolls.payroll',compact('payroll','employees'));
    }

     //add the payroll
     public function addPayroll(Request $request)
     {
         $request->validate([
             'employee_id' => 'required',
             'basic'=>'required',
             'hra'=> 'required'
         ]);
 
         $payroll = new Payroll;
         $payroll->employee_id = $request->employee_id;
         $payroll->basic = $request->basic;
         $payroll->hra = $request->hra;
         $payroll->allowance = $request->allowance;
         $payroll->medical_allowance = $request->medical_allowance;
         $payroll->pf = $request->pf;
         $payroll->salary = ($request->basic + $request->hra + $request->allowance + $request->medical_allowance) - ($request->pf);
         
         $payroll->save();
         
         Toastr::success('Payroll has been added successfully :)','Success');
         return redirect()->route('payrolls/payroll');
     }
 
     //edit or update the payroll
     public function editPayroll(Request $request)
     {   
         try{
             $update_payroll = [
                 'employee_id'=>$request->employee_id,
                 'basic' => $request->basic,
                 'hra' => $request->hra,
                 'allowance' => $request->allowance,
                 'medical_allowance' => $request->medical_allowance,
                 'pf' => $request->pf,
                 'salary' => ($request->basic + $request->hra + $request->allowance + $request->medical_allowance) - ($request->pf),
             ];
     
             Payroll::where('id',$request->id)->update($update_payroll);
 
             Toastr::success('Updated record successfully :)','Success');
             return redirect()->route('payrolls');
 
         }catch(\Exception $e){
             // Toastr::error('Failed to Update the record','Error');
             return redirect()->back();
         }
     }
 
    //delete payroll
    public function deletePayroll($emp_id)
    {
        try{
        Payroll::where('id',$emp_id)->delete();

        Toastr::success('Record has been deleted successfully :)','Success');
        return redirect()->route('payrolls');

        }catch(\Exception $e){
            // Toastr::error('Failed to Delete the record','Error');
            return redirect()->back();
        }
    }

    //display employee details
    public function employeeDetails($payroll_id)
    {
        $employee_detials = Payroll::where('id',$payroll_id)->with('employee')->first();

        $full_details = Employee::where('id',$employee_detials->employee->id)->with(['departments','designations','levels','reporting_manager','age_groups','genders','regions'])->first();

        // $chart_data = [];

        return view('payrolls.employee-details',compact('employee_detials','full_details'));
    }
}
