<?php

namespace App\Http\Controllers\Charity;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Beneficiary;
use App\Models\BeneficiaryBgInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Beneficiary3Controller extends Controller
{

    public function createPart3($id)
    {
        # Retrieve the beneficiary record with background info using foreign key
        $beneficiary = Beneficiary::where('id', $id)->orWhere('code', $id)->firstorFail();

        if ($beneficiary->charitable_organization_id != Auth::user()->charitable_organization_id) {

            $notification = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {

            return view('charity.main.beneficiaries.add-part3', compact('beneficiary'));
        }
    }

    public function storePart3(Request $request, $id)
    {
        # Retrieve the beneficiary record with background info using foreign key
        $beneficiary = Beneficiary::where('id', $id)->orWhere('code', $id)->firstorFail();

        if ($beneficiary->charitable_organization_id != Auth::user()->charitable_organization_id) {

            $notification = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {

            $beneficiaryBgInfoId = BeneficiaryBgInfo::where('beneficiary_id', $beneficiary->id)->firstorFail();

            # Validation of New Beneficiary Background Info
            $request->validate([
                'problem_presented' => ['required', 'string'],
                'about_client' => ['required', 'string'],
                'about_family' => ['required', 'string'],
                'about_community' => ['required', 'string'],
                'assessment' => ['required', 'string'],

                'prepared_by' => ['nullable', 'string', 'min:1', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                'noted_by' => ['nullable', 'string', 'min:1', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                'category' => ['nullable', 'string', 'min:1', 'max:64'],
                'label' => ['nullable', 'string', 'min:1', 'max:64'],
            ]);

            # Begin updating the background info of the retrieved beneficiary.
            BeneficiaryBgInfo::findOrFail($beneficiaryBgInfoId->id)->update([
                'problem_presented' => $request->problem_presented,
                'about_client' => $request->about_client,
                'about_family' => $request->about_family,
                'about_community' => $request->about_community,
                'assessment' => $request->assessment,
            ]);

            # Begin updating the background other info of the retrieved beneficiary.
            Beneficiary::findOrFail($beneficiary->id)->update([
                'category' => $request->category,
                'label' => $request->label,
                'prepared_by' => $request->prepared_by,
                'noted_by' => $request->noted_by,
            ]);

            # Create Audit Logs
            $log = new AuditLog;
            $log->user_id = Auth::user()->id;
            $log->action_type = 'UPDATE';
            $log->charitable_organization_id = Auth::user()->charitable_organization_id;
            $log->table_name = 'Beneficiary Background Info';
            $log->record_id = $beneficiary->code;
            $log->action = Auth::user()->role . ' added Beneficiary Background Info for [ ' . $beneficiary->first_name . ' ' . $beneficiary->last_name . ' ].';
            $log->performed_at = Carbon::now();
            $log->save();

            # Success toastr message
            $notification = array(
                'message' => 'A new beneficiary record has been saved successfully!',
                'alert-type' => 'success',
            );

            return redirect()->route('charity.beneficiaries.all')->with($notification);
        }
    }

    public function editPart3($id)
    {
        # Retrieve the beneficiary record with background info using foreign key
        $beneficiary = Beneficiary::where('id', $id)->orWhere('code', $id)->firstorFail();

        if ($beneficiary->charitable_organization_id != Auth::user()->charitable_organization_id) {

            $notification = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {

            $bgInfo = BeneficiaryBgInfo::where('beneficiary_id', $beneficiary->id)->get();
            return view('charity.main.beneficiaries.edit-part3', compact('beneficiary', 'bgInfo'));
        }
    }

    public function update(Request $request, $id)
    {
        # Retrieve the beneficiary record with background info using foreign key
        $beneficiary = Beneficiary::where('id', $id)->orWhere('code', $id)->firstorFail();
        $beneficiaryBgInfoId = BeneficiaryBgInfo::where('beneficiary_id', $beneficiary->id)->firstorFail();

        if ($beneficiary->charitable_organization_id != Auth::user()->charitable_organization_id) {

            $notification = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {

            # Validation of Edit Beneficiary Background Info
            $request->validate([
                'problem_presented' => ['required', 'string'],
                'about_client' => ['required', 'string'],
                'about_family' => ['required', 'string'],
                'about_community' => ['required', 'string'],
                'assessment' => ['required', 'string'],

                'prepared_by' => ['nullable', 'string', 'min:1', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                'noted_by' => ['nullable', 'string', 'min:1', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                'category' => ['nullable', 'string', 'min:1', 'max:64'],
                'label' => ['nullable', 'string', 'min:1', 'max:64'],
            ]);

            # Begin updating the background info of the retrieved beneficiary.
            BeneficiaryBgInfo::findOrFail($beneficiaryBgInfoId->id)->update([
                'problem_presented' => $request->problem_presented,
                'about_client' => $request->about_client,
                'about_family' => $request->about_family,
                'about_community' => $request->about_community,
                'assessment' => $request->assessment,
            ]);

            # Begin updating the background other info of the retrieved beneficiary.
            Beneficiary::findOrFail($beneficiary->id)->update([
                'category' => $request->category,
                'label' => $request->label,
                'prepared_by' => $request->prepared_by,
                'noted_by' => $request->noted_by,
            ]);

            # Create Audit Logs
            $log = new AuditLog;
            $log->user_id = Auth::user()->id;
            $log->action_type = 'UPDATE';
            $log->charitable_organization_id = Auth::user()->charitable_organization_id;
            $log->table_name = 'Beneficiary Background Info';
            $log->record_id = $beneficiary->code;
            $log->action = Auth::user()->role . ' updated Beneficiary Background Info for [ ' . $beneficiary->first_name . ' ' . $beneficiary->last_name . ' ].';
            $log->performed_at = Carbon::now();
            $log->save();

            $notification = array(
                'message' => 'Part 3 of this beneficiary record has been updated successfully!',
                'alert-type' => 'success',
            );

            return redirect()->route('charity.beneficiaries.show', $id)->with($notification);
        }
    }
}
