<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Salary;
use Carbon\Carbon;
class SalaryController extends Controller
{
    public function paid(Request $request,$employee_id){

        $request->validate([
            'salary' => 'required|numeric|',
            'salary_month' => 'required',
        ],[
            'salary_month.required' => 'salary month is required',
        ]);
        $chek_exist = Salary::where('employee_id',$employee_id)->where('salary_month',$request->salary_month)->where('salary_year',Carbon::now()->format('Y'))->first();
        if ($chek_exist) {
            $request->validate([
                'employee_id' => 'required',
            ],[
                'employee_id.required' => 'This month salery is already paid',
            ]);
          return response()->json('salary already paid');
        }else{
            $salary_paid = Salary::insert([
                 'employee_id' => $employee_id,
                 'amount' => $request->salary,
                 'salary_date' => Carbon::now()->format('d F Y'),
                 'salary_month' => $request->salary_month,
                 'salary_year' => Carbon::now()->format('Y'),
                 'created_at' => Carbon::now(),
            ]);
             return response()->json('successfully sallery paid');
        }
    }

    // ================= get all salary ================ 
    public function allSalary(){
        $salary = Salary::select('salary_month')->groupBy('salary_month')->latest()->get();
        return response()->json($salary);
    }

    // ------------------------- view salary ---------------------------- 
    public function salaryView($month){
        $salary = Salary::where('salary_month',$month)->with('employee')->get();
        return response()->json($salary);
    }

    // -------------------- edit salary ------------------------- 
    public function salaryEdit($salary_id){
        $salary = Salary::with('employee')->where('id',$salary_id)->first();
        return response()->json($salary);
    }

    // ------------- update salary ---------------- 
    public function salaryUpdate(Request $request,$salary_id){

        $request->validate([
            'amount' => 'required|numeric|',
            'salary_month' => 'required',
            ],[
            'salary_month.required' => 'salary month is required',
            ]);

        $employee_id = $request->employee_id;
        // $chek_exist = Salary::where('employee_id',$employee_id)->where('salary_month',$request->salary_month)->where('salary_year',Carbon::now()->format('Y'))->first();
        // if ($chek_exist) {
        //     $request->validate([
        //         'employee_id' => 'required',
        //     ],[
        //         'employee_id.required' => 'This month salery is already paid',
        //     ]);
        //   return response()->json('salary already paid');
        // }else{
            $salary_paid = Salary::findOrFail($salary_id)->update([
                 'employee_id' => $employee_id,
                 'amount' => $request->amount,
                 'salary_date' => Carbon::now()->format('d F Y'),
                 'salary_month' => $request->salary_month,
                 'salary_year' => Carbon::now()->format('Y'),
                 'created_at' => Carbon::now(),
            ]);
             return response()->json('successfully sallery paid');
        // }
    }
}
