<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeFamily;
use Illuminate\Http\Request;
use App\Models\BankInformation;

class EmployeeProfileController extends Controller
{

    // 🔹 Show Profile
    public function show($id)
    {
        $employee = Employee::with('families')->findOrFail($id);

        return view('employees.employeeprofile', compact('employee'));
    }

    // 🔹 Store Family
    public function storeFamily(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'name' => 'required',
        ]);

        EmployeeFamily::create([
            'employee_id' => $request->employee_id,
            'name' => $request->name,
            'relationship' => $request->relationship,
            'dob' => $request->dob,
            'phone' => $request->phone,
        ]);

        return redirect()->back()->with('success', 'Family member added successfully');
    }

    // 🔹 Delete Family
    public function deleteFamily($id)
    {
        EmployeeFamily::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Deleted successfully');
    }

    // 🔹 Bank Update (FINAL WORKING)
    public function bankUpdate(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'bank_name' => 'required',
            'bank_account_no' => 'required',
            'ifsc_code' => 'required',
            'pan_no' => 'required',
        ]);


       $bankInformation = BankInformation::where('user_id', $request->user_id)->firstOrFail();
        // print_r($bankInformation);
        // die;

        $bankInformation->update([
            'bank_name' => $request->bank_name,
            'bank_account_no' => $request->bank_account_no,
            'ifsc_code' => $request->ifsc_code,
            'pan_no' => $request->pan_no,
        ]);
    

        // dd("fiufiu");
        return redirect()->back()->with('success', 'Bank details updated successfully');

        // return redirect()->route('employee.profile', $bankInformation->user_id)
        //     ->with('success', 'Bank details updated successfully');
    }
}
