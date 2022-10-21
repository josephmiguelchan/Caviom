<?php

namespace App\Http\Controllers\Charity;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\GiftGiving;
use App\Models\Beneficiaries;
use App\Models\Beneficiary;
use App\Models\CharitableOrganization;
use App\Models\GiftGivingBeneficiaries;
use App\Models\GiftGivingBeneficiary;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class GiftGivingController extends Controller
{
    public function AllGiftGiving()
    {

        $GiftGivings = GiftGiving::where('charitable_organization_id', Auth::user()->charity->id)->latest()->get();
        // $GiftGivings = Auth::user()->charity->giftgiving->latest()->get();

        return view('charity.gifts.all', compact('GiftGivings'));
    } // End Method

    public function AddGiftGiving()
    {

        # Check if Charity has sufficient Star Tokens with the chosen role
        if (Auth::user()->charity->star_tokens < 300) {
            $toastr = array();
            $toastr = array(
                'message' => 'Sorry, your Charitable Organization does not have sufficient Star Tokens.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($toastr);
        }

        return view('charity.gifts.add');
    } // End Method

    public function StoreGiftGiving(Request $request)
    {
        # Check first if Charitable Organization has sufficient Star Tokens
        if (Auth::user()->charity->star_tokens < 300) {
            $toastr = array();
            $toastr = array(
                'message' => 'Sorry, your Charitable Organization does not have sufficient Star Tokens.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($toastr);
        }

        $request->validate([
            'name' => 'required|min:5|max:50|unique:App\Models\GiftGiving,name',
            'amount_per_pack' => 'required|numeric|between:0,999999.99',
            'no_of_packs' => 'required|integer|min:1',
            'objective' => 'required|max:2000|min:10',
            'venue' => 'required|min:2|max:255',
            'start_at' => 'required|after:' . now(),
            'sponsors' => 'nullable',
        ], [
            // For custom message if need ， just delete it if no need custom message
            'start_at.after' => 'The datetime of the Gift Giving must be in the future.',
        ]);



        # Generate the uuid
        $uuid = Str::uuid()->toString();

        # Get the value of the total budget for the event
        $numberofpack = $request->no_of_packs;

        # Convert amount_per_pack to decimal
        $amountperpack = $request->amount_per_pack;
        $totalbuget = $amountperpack * $numberofpack;

        # Insert data to database
        GiftGiving::insert([
            'code' => $uuid,
            'name' => $request->name,
            'charitable_organization_id' => Auth::user()->charity->id,
            'amount_per_pack' => $request->amount_per_pack,
            'no_of_packs' => $request->no_of_packs,
            'objective' => $request->objective,
            'venue' => $request->venue,
            'start_at' => $request->start_at,
            'sponsor' => $request->sponsors,
            'total_budget' => $totalbuget,
            'created_at' => Carbon::now(),

        ]);

        # Deduct the total star tokens
        $current_bal = CharitableOrganization::findOrFail(Auth::user()->charitable_organization_id);
        $current_bal->star_tokens = $current_bal->star_tokens - 300;
        $current_bal->save();


        # Create Audit Logs
        $log = new AuditLog;
        $log->user_id = Auth::user()->id;
        $log->action_type = 'INSERT';
        $log->charitable_organization_id = Auth::user()->charitable_organization_id;
        $log->table_name = 'Gift Giving';
        $log->record_id = $uuid;
        $log->action = 'Charity Admin created Gift Giving [' . $request->name . '] using 300 Star Tokens.';
        $log->performed_at = Carbon::now();
        $log->save();


        # Shows notification
        $toastr = array(
            'message' => 'Gift Giving Added Successfully',
            'alert-type' => 'success'
        );


        # Send Notification to each user in their Charitable Organizations
        $users = User::where('charitable_organization_id', Auth::user()->charitable_organization_id)->where('status', 'Active')->get();

        foreach ($users as $user) {
            $notif = new Notification;
            $notif->code = Str::uuid()->toString();
            $notif->user_id = $user->id;
            $notif->category = 'Gift Giving';
            $notif->subject = 'Gift Giving Created';
            $notif->message = 'A new Gift Giving project has been created by ' . Auth::user()->role . ' [' . Auth::user()->info->first_name .
                ' ' . Auth::user()->info->last_name . '] named [' . $request->name . '] using 300 Star Tokens. ';
            $notif->icon = 'mdi mdi-gift';
            $notif->color = 'success';
            $notif->created_at = Carbon::now();
            $notif->save();
        }

        return redirect()->route('gifts.all')->with($toastr);
    }

    public function ViewGiftGivingProjectDetail($code)
    {
        $GiftGivings = GiftGiving::where('code', $code)->firstOrFail();

        # Users can only access their own charity's records
        if ($GiftGivings->charitable_organization_id == Auth::user()->charitable_organization_id) {

            # Retrieve the list of the beneficiaries for the selection
            $listofBeneficiaries = Beneficiary::where('charitable_organization_id', Auth::user()->charitable_organization_id)->get();

            # Retrive the list of beneficiaries being added based on the 'Gift_Giving_Project' (CAN BE IMPROVED using Relationship Keys in Model)
            $GiftGivingBeneficiaries = GiftGivingBeneficiary::where('gift_giving_id', $GiftGivings->id)->get();

            return view('charity.gifts.view', compact(['GiftGivings', 'listofBeneficiaries', 'GiftGivingBeneficiaries']));
        } else {
            $toastr = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($toastr);
        }
    } // End Method

    public function StoreSelectedBeneficiary(Request $request, $code)
    {
        # Generate the random 5-digit Ticket No.
        $randomNumber = random_int(10000, 99999);

        # Retrieve the gift giving details using $code
        $GiftGiving = GiftGiving::where('code', $code)->firstOrFail();

        # Retrieve the total number of beneficiaries in the gift giving
        $count = DB::table('gift_giving_beneficiaries')->where('gift_giving_id',  $GiftGiving->id)->count();

        # Retrieve the no. of packs initially set in the gift giving
        $no_of_pack = $GiftGiving->no_of_packs;

        # Checks if there is a duplicate in name within the same gift giving project
        $hasDuplicate = GiftGivingBeneficiary::where('name', $request->beneficiaries)->where('gift_giving_id', $GiftGiving->id)->first();

        if ($count >= $no_of_pack) {

            # Set conditon for the count of the Beneficiary of the GiftGiving Project will not surpass the no_of_pack
            $toastr = array(
                'message' => 'You have already reached the limit of adding the beneficiary to this project.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($toastr);
        }
        if ($request->beneficiaries == null) {

            # Set conditon for the dropdown must have a value first
            $toastr = array(
                'message' => 'the beneficiary name is required.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($toastr);
        }
        // if ($hasDuplicate) {

        //     # Set conditon for when the beneficiary must not have existing names within the same Gift Giving.
        //     $notification = array(
        //         'message' => 'The beneficiary already exists in this gift giving.',
        //         'alert-type' => 'warning'
        //     );

        //     return redirect()->back()->with($notification);
        // }

        # Main Success Scenario
        if ($GiftGiving->charitable_organization_id == Auth::user()->charitable_organization_id) {
            $beneficiary = new GiftGivingBeneficiary;
            $beneficiary->gift_giving_id = $GiftGiving->id;
            $beneficiary->name = $request->beneficiaries;
            $beneficiary->ticket_no = $randomNumber;
            $beneficiary->save();

            # Shows success toastr
            $toastr = array(
                'message' => 'The selected beneficiary has been added successfully.',
                'alert-type' => 'success'
            );


            return redirect()->back()->with($toastr);
        } else {

            # If the record was manipulated by non-members of the organization

            $toastr = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($toastr);
        }
    } // End Method

    public function StoreCustomBeneficiary(Request $request, $code)
    {
        # Generate the random 5-digit Ticket No.
        $randomNumber = random_int(10000, 99999);

        # Retrieve the gift giving details using $code
        $GiftGiving = GiftGiving::where('code', $code)->firstOrFail();

        # Retrieve the total number of beneficiaries in the gift giving
        $count = DB::table('gift_giving_beneficiaries')->where('gift_giving_id',  $GiftGiving->id)->count();

        # Retrieve the no. of packs initially set in the gift giving
        $no_of_pack = $GiftGiving->no_of_packs;

        # Checks if there is a duplicate in name within the same gift giving project
        $encryptedBeneficiary = new GiftGivingBeneficiary;
        $encryptedBeneficiary->where('name',)->where('gift_giving_id', $GiftGiving->id)->first();


        // $hasDuplicate = GiftGivingBeneficiary::where('name', $encryptedBeneficiary)->where('gift_giving_id', $GiftGiving->id)->first();

        if ($count >= $no_of_pack) {

            # Set conditon for the count of the Beneficiary of the GiftGiving Project will not surpass the no_of_pack

            $toastr = array(
                'message' => 'You have already reached the limit of adding the beneficiary to this project.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($toastr);
        }
        /* elseif ($request->custom_name == null) {

            # Set conditon for the dropdown must have a value first
            $notification = array(
                'message' => 'The beneficiary name is required.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }


        elseif ($hasDuplicate) {

            # Set conditon for when the beneficiary must not have existing names within the same Gift Giving.
            $notification = array(
                'message' => 'The beneficiary already exists in this gift giving.',
                'alert-type' => 'warning'
            );

            return redirect()->back()->with($notification);
        } */ else {

            # Validate first the custom name
            $request->validate([
                'custom_name' => 'required|string|min:2|max:128',
            ]);

            $beneficiary = new GiftGivingBeneficiary;
            $beneficiary->gift_giving_id = $GiftGiving->id;
            $beneficiary->name = $request->custom_name;
            $beneficiary->ticket_no = $randomNumber;
            $beneficiary->save();

            # Shows success toastr
            $toastr = array(
                'message' => 'The beneficiary has been added successfully.',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($toastr);
        }
    } // End Method

    public function DeleteGiftGivingBeneficiaries($id)
    {
        # Attempt to delete the beneficiary using id
        GiftGivingBeneficiary::findOrFail($id)->delete();
        $toastr = array(
            'message' => 'Selected beneficiary has been deleted successfully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($toastr);
    } // End Method


    public function GenerateTicket($code)
    {
        # Retrieve the records using $code
        $GiftGiving = GiftGiving::where('code', $code)->firstOrFail();
        $tickets = GiftGivingBeneficiary::where('gift_giving_id', $GiftGiving->id)->get();

        # Users can only access their own charity's records
        if ($GiftGiving->charitable_organization_id == Auth::user()->charitable_organization_id) {

            # Must have at least one beneficiary before generating tickets
            if ($tickets->count() < 1) {
                $toastr = array(
                    'message' => 'Gift Giving must have at least one (1) beneficiary first before generating tickets',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($toastr);
            }

            # Retrieve the last batch no. from the gift giving.
            $batch_no = $GiftGiving->batch_no;

            # Increment Batch no. by +1
            $GiftGiving->update([
                'last_downloaded_by' => Auth::id(),
                'batch_no' => $batch_no + 1,
            ]);

            $pdf = PDF::loadView('charity.gifts.generate_ticket', compact('tickets'));

            # Audit Logs Creation
            $log = new AuditLog;
            $log->user_id = Auth::user()->id;
            $log->action_type = 'GENERATE PDF';
            $log->charitable_organization_id = Auth::user()->charitable_organization_id;
            $log->table_name = 'Gift Giving';
            $log->record_id = $GiftGiving->code;
            $log->action =  Auth::user()->role . ' generated tickets for the Gift Giving [' . $GiftGiving->name . '] with batch no. ' . $GiftGiving->batch_no . '.';
            $log->performed_at = Carbon::now();
            $log->save();


            # Send Notification to each user in their Charitable Organizations
            $users = User::where('charitable_organization_id', Auth::user()->charitable_organization_id)->where('status', 'Active')->get();

            foreach ($users as $user) {
                $notif = new Notification;
                $notif->code = Str::uuid()->toString();
                $notif->user_id = $user->id;
                $notif->category = 'Gift Giving';
                $notif->subject = 'Generated Tickets';
                $notif->message = Auth::user()->role . ' ' . Auth::user()->info->first_name . ' ' .
                    Auth::user()->info->last_name . ' has generated tickets for [' . $GiftGiving->name . '] with batch no. ' .
                    $GiftGiving->batch_no . '.';
                $notif->icon = 'mdi mdi-ticket';
                $notif->color = 'info';
                $notif->created_at = Carbon::now();
                $notif->save();
            }

            return $pdf->download($GiftGiving->name . ' - No. ' . $GiftGiving->batch_no . '.pdf');
        } else {

            $toastr = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($toastr);
        }
    }
}
