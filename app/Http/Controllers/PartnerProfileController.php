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

        $bankInformationPartner->update([
            'bank_name' => $request->bank_name,
            'bank_account_no' => $request->bank_account_no,
            'ifsc_code' => $request->ifsc_code,
            'pan_no' => $request->pan_no,
        ]);
    
        return redirect()->back()->with('success', "Partner's Bank details updated successfully");
    }
    public function toggleStatus(Request $request)
{
    $holiday = Holiday::findOrFail($request->holiday_id);

    $holiday->status = $holiday->status == 1 ? 0 : 1;
    $holiday->save();

    return redirect()->back();
}
}

