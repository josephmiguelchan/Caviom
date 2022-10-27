<?php

namespace App\Http\Controllers\Charity;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Charity\Public\Lead;
use App\Models\Charity\Public\Prospect;
use App\Models\Charity\Public\ProspectTrail;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

class ProspectController extends Controller
{
    public function AllProspect()
    {
        $prospects = Prospect::where('charitable_organization_id', Auth::user()->charitable_organization_id)->latest()->get();


        $totaldonation = DB::table('prospects')
            ->where('charitable_organization_id', Auth::user()->charitable_organization_id)
            ->sum('amount');


        return view('charity.donors.prospects.all', compact('prospects', 'totaldonation'));
    }

    public function ViewProspect($code)
    {

        $prospect = Prospect::where('code', $code)->firstOrFail();

        return view('charity.donors.prospects.view', compact('prospect'));
    }

    public function MoveToLeads($code)
    {
        # Retrieve selected Prospect Records
        $prospect = Prospect::where('code', $code)->firstOrFail();

        # Get the total running balance
        $totalbalance = DB::table('prospects')
            ->where('charitable_organization_id', Auth::user()->charitable_organization_id)
            ->sum('amount');

        # Create new instances of Lead
        $lead = new Lead;
        $lead->code = $prospect->code;
        $lead->charitable_organization_id = $prospect->charitable_organization_id;
        $lead->proof_of_payment_photo = $prospect->proof_of_payment_photo;
        $lead->amount = $prospect->amount;
        $lead->mode_of_donation = $prospect->mode_of_donation;
        $lead->message = $prospect->message;
        $lead->first_name = $prospect->first_name;
        $lead->last_name = $prospect->last_name;
        $lead->middle_name = $prospect->middle_name;
        $lead->email_address = $prospect->email_address;
        $lead->paid_at = $prospect->paid_at;
        $lead->created_at = Carbon::now();
        $lead->save();

        $prospectTrail = new ProspectTrail;
        $prospectTrail->charitable_organization_id = $prospect->charitable_organization_id;
        $prospectTrail->amount = $prospect->amount * -1;
        $prospectTrail->mode_of_payment = $prospect->mode_of_donation;
        $prospectTrail->action = 'Moved back to Leads';
        $prospectTrail->running_balance = $totalbalance - $prospect->amount;
        $prospectTrail->paid_at = $prospect->paid_at;
        $prospectTrail->created_at = Carbon::now();
        $prospectTrail->save();

        # Delete Prospect Record
        $prospect->delete();


        # Create Audits Logs
        $log = new AuditLog;
        $log->user_id = Auth::user()->id;
        $log->action_type = 'Update';
        $log->charitable_organization_id = Auth::user()->charitable_organization_id;
        $log->table_name = 'Prospect, Lead';
        $log->record_id = $prospect->id;
        $log->action = Auth::user()->info->last_name . ' ' .  Auth::user()->info->first_name . ' moved the Prospect
        [ ' . $prospect->first_name . ' ' . $prospect->last_name . ' ] back to leads.';
        $log->performed_at = Carbon::now();
        $log->save();


        # Send notification
        $users = User::where('charitable_organization_id', Auth::user()->charitable_organization_id)->where('status', 'Active')->get();

        foreach ($users as $user) {
            $notif = new Notification();
            $notif->code = Str::uuid()->toString();
            $notif->user_id = $user->id;
            $notif->category = 'Prospect';
            $notif->subject = 'Prospect Moved to Lead';
            $notif->message = Auth::user()->role . ' [ ' . Auth::user()->info->last_name . ' ' . Auth::user()->info->first_name . ' ]
                            has moved back the prospect [ ' . $prospect->first_name . ' ' . $prospect->last_name . ' ] to Leads';
            $notif->icon = 'mdi mdi-account-switch';
            $notif->color = 'warning';
            $notif->created_at = Carbon::now();
            $notif->save();
        }

        # Send success toastr
        $toastr = array(
            'message' => 'Selected Prospect has been move back to Lead successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('prospects.all')->with($toastr);
    }


    public function GenerateDonationReport(Request $request)
    {
        $min_date = Carbon::parse(Auth::user()->charity->created_at)->isoFormat('YYYY-M');
        $max_date = Carbon::now()->isoFormat('YYYY-M');

        $validator = Validator::make($request->all(), [
            'monthFilter' => [
                'required', 'date_format:Y-m',
                'after_or_equal:' . $min_date, 'before_or_equal:' . $max_date,
            ],
        ], [
            # Custom Error Messages
            'monthFilter.date_format' => 'The month filter does not follow a valid date format.',
            'monthFilter.after_or_equal' => 'Your organization has not yet been registered on this chosen month filter.',
            'monthFilter.before_or_equal' => 'The month filter should not be in the future.',
        ]);

        # Return error toastr if validate request failed
        if ($validator->fails()) {
            $toastr = array(
                'message' => $validator->errors()->first() . ' Please try again.',
                'alert-type' => 'error'
            );

            return redirect()->back()->withInput()->withErrors($validator->errors())->with($toastr);
        }

        $date_start = Carbon::parse($request->monthFilter)->firstOfMonth();
        $date_end = Carbon::parse($request->monthFilter)->lastOfMonth();

        $mytime = Carbon::now();
        $trail = ProspectTrail::where('charitable_organization_id', Auth::user()->charitable_organization_id)
            ->where('paid_at', '>=', $date_start)->where('paid_at', '<=', $date_end)
            ->get();
        $orgimage = Auth::user()->charity->profile_photo;
        $cashinflow = ProspectTrail::where('charitable_organization_id', Auth::user()->charitable_organization_id)
            ->where('paid_at', '>=', $date_start)->where('paid_at', '<=', $date_end)
            ->groupBy('mode_of_payment')->orderBy('mode_of_payment', 'ASC')
            ->pluck('mode_of_payment')->toArray();

        $donations = array();
        $deductions = array();
        $subtotal = array();
        foreach ($cashinflow as $key => $mode) {
            $donations[$key] = ProspectTrail::where('charitable_organization_id', Auth::user()->charitable_organization_id)
                ->where('paid_at', '>=', $date_start)->where('paid_at', '<=', $date_end)
                ->where('mode_of_payment', $mode)->where('amount', '>', '0')
                ->orderBy('mode_of_payment', 'ASC')
                ->sum('amount');
            $deductions[$key] = ProspectTrail::where('charitable_organization_id', Auth::user()->charitable_organization_id)
                ->where('paid_at', '>=', $date_start)->where('paid_at', '<=', $date_end)
                ->where('mode_of_payment', $mode)->where('amount', '<', '0')
                ->orderBy('mode_of_payment', 'ASC')
                ->sum('amount');
            $subtotal[$key] = ProspectTrail::where('charitable_organization_id', Auth::user()->charitable_organization_id)
                ->where('paid_at', '>=', $date_start)->where('paid_at', '<=', $date_end)
                ->where('mode_of_payment', $mode)
                ->orderBy('mode_of_payment', 'ASC')
                ->sum('amount');
        }

        # Audit Logs
        $log = new AuditLog;
        $log->user_id = Auth::user()->id;
        $log->action_type = 'Generate PDF';
        $log->charitable_organization_id = Auth::user()->charitable_organization_id;
        $log->table_name = 'Prospect Trail';
        $log->record_id = null;
        $log->action = Auth::user()->role . ' generated PDF of Donation report from Prospects.';
        $log->performed_at = Carbon::now();
        $log->save();


        # Send Notification to each user in their Charitable Organizations
        $users = User::where('charitable_organization_id', Auth::user()->charitable_organization_id)->where('status', 'Active')->get();

        foreach ($users as $user) {
            $notif = new Notification();
            $notif->code = Str::uuid()->toString();
            $notif->user_id = $user->id;
            $notif->category = 'Prospect';
            $notif->subject = 'Donations Report Generated';
            $notif->message = Auth::user()->role . ' ' . Auth::user()->info->first_name . ' ' . Auth::user()->info->last_name . '
                has attempted to generate a report of cash inflow dontation from Prospects into a PDF.';
            $notif->icon = 'mdi mdi-file-download';
            $notif->color = 'warning';
            $notif->created_at = Carbon::now();
            $notif->save();
        }

        // return view('charity.donors.prospects.DonationReport', compact(['orgimage', 'mytime', 'trail', 'cashinflow', 'donations', 'deductions', 'subtotal', 'date_start', 'date_end']));

        $pdf = PDF::loadView('charity.donors.prospects.DonationReport', compact(['orgimage', 'mytime', 'trail', 'cashinflow', 'donations', 'deductions', 'subtotal', 'date_start', 'date_end']));
        return $pdf->download(Auth::user()->charity->name . ' - Donation Transparency Report' . '.pdf');
    }

    public function AddRemarks(Request $request, $code)
    {
        # Validation Rules
        $request->validate([
            'remarks' => 'nullable|max:255',
        ], [
            //for custom message if need ， just delete it if no need custom message
        ]);

        # Retrieve Prospect Record
        $prospect = Prospect::where('code', $code)->firstOrFail();

        $prospect->remarks = $request->remarks;
        $prospect->save();
        $toastr = array(
            'message' => 'Selected Prospect\'s remark has been updated successfully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($toastr);
    }

    public function AddasOpportunityBenefactor($code)
    {

        $prospect = Prospect::where('code', $code)->firstOrFail();

        return view('charity.main.benefactors.add-opportunity', compact('prospect'));
    }

    public function AddasOpportunityVolunteer($code)
    {

        $prospect = Prospect::where('code', $code)->firstOrFail();

        return view('charity.main.volunteers.add-opportunity', compact('prospect'));
    }
}
