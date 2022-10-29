<?php

namespace App\Http\Controllers\Charity;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Beneficiary;
use App\Models\BeneficiaryBgInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Exports\Benefactors;
use App\Exports\BeneficiaryExport;
use App\Models\BeneficiaryFamilyInfo;
use App\Models\Notification;
use App\Models\User;
// use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
// use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class Beneficiary3Controller extends Controller
{

    public function createPart3($id)
    {
        # Retrieve the beneficiary record with background info using foreign key
        $beneficiary = Beneficiary::where('code', $id)->firstorFail();

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
        $beneficiary = Beneficiary::where('code', $id)->firstorFail();

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
        $beneficiary = Beneficiary::where('code', $id)->firstorFail();

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
        $beneficiary = Beneficiary::where('code', $id)->firstorFail();
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


    public function BackupBeneficiary()
    {
        $beneficiaries = Beneficiary::where('charitable_organization_id', Auth::user()->charitable_organization_id)->get();

        # Check if atleast one beneficiary exists before attempting to generate.
        if ($beneficiaries->count() == 0) {

            $notification = array(
                'message' => 'Sorry, cannot generate a backup unless one (1) or more beneficiaries exist.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        # Create Audit Logs
        $log = new AuditLog;
        $log->user_id = Auth::user()->id;
        $log->action_type = 'GENERATE EXCEL';
        $log->charitable_organization_id = Auth::user()->charitable_organization_id;
        $log->table_name = 'Beneficiary, Beneficiary_Bg_Info , Beneficiary_Family, Address';
        $log->record_id = null;
        $log->action = Auth::user()->role . ' generated Excel to backup all Beneficiariesq in ' . Auth::user()->charity->name;
        $log->performed_at = Carbon::now();
        $log->save();


        # Send Notification
        $users = User::where('charitable_organization_id', Auth::user()->charitable_organization_id)->where('status', 'Active')->get();
        foreach ($users as $user) {
            $notif = new Notification();
            $notif->code = Str::uuid()->toString();
            $notif->user_id = $user->id;
            $notif->category = 'Beneficiary';
            $notif->subject = 'Backup Beneficiary';
            $notif->message = Auth::user()->role . ' [' . Auth::user()->info->first_name . ' ' . Auth::user()->info->last_name .
                '] has attempted to back up a copy of All Beneficiaries from [' . Auth::user()->charity->name . '] into an Excel File.';
            $notif->icon = 'mdi mdi-file-download';
            $notif->color = 'warning';
            $notif->created_at = Carbon::now();
            $notif->save();
        }


        return Excel::download(new BeneficiaryExport(), Auth::user()->charity->name . ' Beneficiaries (' . Carbon::now()->isoFormat('lll') . ').xlsx');
    }

    public function GeneratePDF($code)
    {
        # Retrieve Record for the select Beneficiaries
        $beneficiary = Beneficiary::where('code', $code)->firstOrFail();

        # Check if beneficiary belongs to same org as user
        if ($beneficiary->charitable_organization_id !=  Auth::user()->charitable_organization_id) {
            $toastr = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($toastr);
        }

        $mytime = Carbon::now();
        $beneficiaryimage = $beneficiary->profile_photo;
        $orgimage = $beneficiary->charitableOrganization->profile_photo;
        // $familymember = BeneficiaryFamilyInfo::where('beneficiary_id',$beneficiary->id)->get();


        # Create Audit Logs
        $log = new AuditLog;
        $log->user_id = Auth::user()->id;
        $log->action_type = 'GENERATE PDF';
        $log->charitable_organization_id = Auth::user()->charitable_organization_id;
        $log->table_name = 'Beneficiary, Beneficiary_Bg_Info , Beneficiary_Family, Address';
        $log->record_id = $beneficiary->code;
        $log->action = Auth::user()->role . ' generated filled out PDF to Export individual Beneficiary [ '
            . $beneficiary->last_name . ', ' . $beneficiary->last_name . ' '
            . $beneficiary->middle_name . ' ] record.';
        $log->performed_at = Carbon::now();
        $log->save();


        # Send notification to User
        $users = User::where('charitable_organization_id', Auth::user()->charitable_organization_id)->where('status', 'Active')->get();
        foreach ($users as $user) {
            $notif = new Notification();
            $notif->code = Str::uuid()->toString();
            $notif->user_id = $user->id;
            $notif->category = 'Beneficiary';
            $notif->subject = 'Export Beneficiary';
            $notif->message = Auth::user()->role . ' [' . Auth::user()->info->first_name . ' ' . Auth::user()->info->last_name .
                '] has attempted to export a filled record of Beneficiary [ ' . $beneficiary->last_name . ', ' . $beneficiary->first_name . ' ] into a PDF File.';
            $notif->icon = 'mdi mdi-file-download';
            $notif->color = 'warning';
            $notif->created_at = Carbon::now();
            $notif->save();
        }

        // return view('charity.main.beneficiaries.BackupPdf', compact('beneficiary','mytime'));

        $pdf = PDF::loadView('charity.main.beneficiaries.BackupPdf', compact('beneficiary', 'mytime', 'beneficiaryimage', 'orgimage'));
        return $pdf->download($beneficiary->charitableOrganization->name . '-' . $beneficiary->last_name . ', ' . $beneficiary->first_name . '.pdf');
    }
    public function GeneratePDFblank($code)
    {
        # Retrieve Record for the select Beneficiaries
        $beneficiary = Beneficiary::where('code', $code)->firstOrFail();

        # Check if beneficiary belongs to same org as user
        if ($beneficiary->charitable_organization_id !=  Auth::user()->charitable_organization_id) {
            $toastr = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($toastr);
        }

        // return view('charity.main.beneficiaries.BackupPdf', compact('beneficiary','mytime'));

        $mytime = Carbon::now();
        $beneficiaryimage = $beneficiary->profile_photo;
        $orgimage = $beneficiary->charitableOrganization->profile_photo;
        // $familymember = BeneficiaryFamilyInfo::where('beneficiary_id',$beneficiary->id)->get();


        # Create Audit Logs
        $log = new AuditLog;
        $log->user_id = Auth::user()->id;
        $log->action_type = 'GENERATE PDF';
        $log->charitable_organization_id = Auth::user()->charitable_organization_id;
        $log->table_name = 'Beneficiary, Beneficiary_Bg_Info , Beneficiary_Family, Address';
        $log->record_id = Null;
        $log->action = Auth::user()->role . ' generated blank copy of PDF to Export Beneficiary [ '
            . $beneficiary->last_name . ', ' . $beneficiary->last_name . ' '
            . $beneficiary->middle_name . ' ] record.';
        $log->performed_at = Carbon::now();
        $log->save();


        # Send notification to User
        $users = User::where('charitable_organization_id', Auth::user()->charitable_organization_id)->where('status', 'Active')->get();
        foreach ($users as $user) {
            $notif = new Notification();
            $notif->code = Str::uuid()->toString();
            $notif->user_id = $user->id;
            $notif->category = 'Beneficiary';
            $notif->subject = 'Export Beneficiary';
            $notif->message = Auth::user()->role . ' [' . Auth::user()->info->first_name . ' ' . Auth::user()->info->last_name .
                '] has attempted to export a blank copy record of Beneficiary [ ' . $beneficiary->last_name . ', ' . $beneficiary->first_name . ' ] into a PDF File.';
            $notif->icon = 'mdi mdi-file-download';
            $notif->color = 'warning';
            $notif->created_at = Carbon::now();
            $notif->save();
        }

        $pdf = PDF::loadView('charity.main.beneficiaries.BackupPdfblank', compact('beneficiary', 'mytime', 'beneficiaryimage', 'orgimage'));
        return $pdf->download($beneficiary->charitableOrganization->name . '-' . $beneficiary->last_name . ', ' . $beneficiary->first_name . '.pdf');
    }
}
