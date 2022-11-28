<?php

namespace App\Http\Controllers\Charity;

use App\Http\Controllers\Controller;
use App\Models\Charity\Public\Lead;
use App\Models\Charity\Public\Prospect;
use App\Models\Charity\Public\ProspectTrail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class LeadController extends Controller
{
    public function AllLeads()
    {
        $leads = Lead::where('charitable_organization_id', Auth::user()->charitable_organization_id)->latest()->get();

        return view('charity.donors.leads.all', compact('leads'));
    }

    public function ViewLead($code)
    {

        $lead = lead::where('code', $code)->firstOrFail();

        return view('charity.donors.leads.view', compact('lead'));
    }
    public function DeleteLead($code)
    {

        $lead = lead::where('code', $code)->firstOrFail();

        # Delete old proof of payment photo if exists
        $oldImg = $lead->proof_of_payment_photo;
        if ($oldImg) unlink(public_path('upload/charitable_org/donates/') . $oldImg);

        $lead->delete();

        # Send success toastr
        $toastr = array(
            'message' => 'Selected Lead has been removed successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('leads.all')->with($toastr);
    }

    public function MoveAsProspect($code)
    {
        # Retrieve Selected Lead Record
        $lead = lead::where('code', $code)->firstOrFail();

        # Add total of each prospects
        $pros = DB::table('prospects')
            ->where('charitable_organization_id', Auth::user()->charitable_organization_id)
            ->sum('amount');

        # Create new instances of prospect
        $prospect = new Prospect;

        # Update the Selected Lead to prospect
        $prospect->code = $lead->code;
        $prospect->charitable_organization_id =  $lead->charitable_organization_id;
        $prospect->proof_of_payment_photo = $lead->proof_of_payment_photo;
        $prospect->amount = $lead->amount;
        $prospect->mode_of_donation = $lead->mode_of_donation;
        $prospect->message = $lead->message;
        $prospect->first_name = $lead->first_name;
        $prospect->last_name = $lead->last_name;
        $prospect->middle_name = $lead->middle_name;
        $prospect->email_address = $lead->email_address;
        $prospect->paid_at = $lead->paid_at;
        $prospect->created_at = Carbon::now();
        $prospect->total = $lead->amount +  $pros;
        $prospect->save();


        # Update the Prospect Trail Table
        $prospectTrail = new ProspectTrail;
        $prospectTrail->charitable_organization_id =  $lead->charitable_organization_id;
        $prospectTrail->amount = $lead->amount;
        $prospectTrail->mode_of_payment = $lead->mode_of_donation;
        $prospectTrail->action = 'Add';
        $prospectTrail->running_balance = $lead->amount +  $pros;
        $prospectTrail->paid_at = $lead->paid_at;
        $prospectTrail->created_at = Carbon::now();
        $prospectTrail->save();


        # Delete the Select Leads
        $lead->delete();

        $toastr = array(
            'message' => 'Selected Lead has been added to Prospects successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('leads.all')->with($toastr);
    }
}
