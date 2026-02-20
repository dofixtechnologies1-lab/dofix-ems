<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\PartnerFamily;
use Illuminate\Http\Request;
use App\Models\BankInformation;
use App\Http\Controllers\DB;

class PartnerProfileController extends Controller
{

/** All Employee List */
    public function listAllPartner()
    {
        $partners = Partner::all();
        return view('partner.partnerlist',compact('partners'));
    }

    // 🔹 Show Profile
    public function show($id)
    {
        $employee = Partner::with('families')->findOrFail($id);

        return view('Partner.Partnerprofile', compact('Partner'));
    }

    // 🔹 Store Family
    // public function storeFamily(Request $request)
    // {
    //     $request->validate([
    //         'employee_id' => 'required',
    //         'name' => 'required',
    //     ]);

    //     EmployeeFamily::create([
    //         'employee_id' => $request->employee_id,
    //         'name' => $request->name,
    //         'relationship' => $request->relationship,
    //         'dob' => $request->dob,
    //         'phone' => $request->phone,
    //     ]);

    //     return redirect()->back()->with('success', 'Family member added successfully');
    // }

    // 🔹 Delete Family
    // public function deleteFamily($id)
    // {
    //     EmployeeFamily::findOrFail($id)->delete();

    //     return redirect()->back()->with('success', 'Deleted successfully');
    // }

    // 🔹 Bank Update (FINAL WORKING)
    public function bankUpdatePartner(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'bank_name' => 'required',
            'bank_account_no' => 'required',
            'ifsc_code' => 'required',
            'pan_no' => 'required',
        ]);


       $bankInformationPartner = BankInformationPartner::where('user_id', $request->user_id)->firstOrFail();
        // print_r($bankInformation);
        // die;

        $bankInformationPartner->update([
            'bank_name' => $request->bank_name,
            'bank_account_no' => $request->bank_account_no,
            'ifsc_code' => $request->ifsc_code,
            'pan_no' => $request->pan_no,
        ]);
    

        // dd("fiufiu");
        return redirect()->back()->with('success', "Partner's Bank details updated successfully");

        // return redirect()->route('employee.profile', $bankInformation->user_id)
        //     ->with('success', 'Bank details updated successfully');
    }
}

