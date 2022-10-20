<?php

namespace App\Http\Controllers\Charity;

use App\Http\Controllers\Controller;
use App\Models\Admin\order;
use App\Models\AuditLog;
use App\Models\CharitableOrganization;
use App\Models\User;
use App\Models\Admin\oder;
use App\Models\Admin\order_items;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


class StarTokenController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')
            ->where('charitable_organization_id', Auth::user()->charitable_organization_id)
            ->where('status', 'Pending')
            ->get();

        // TO DO
        # Getting the number of project collaboration left for FREE Subscribers
        //$projects = Project::where('charitable_organization_id', Auth::user()->charitable_organization_id)->get();
        //$projects->count();

        $numberOfGiftGivings = "";

        # Captions based on the subscription
        switch (Auth::user()->charity->subscription) {
            case 'Free':
                $subscription = "NOT SUBSCRIBED";
                //$numberOfProjectCollaborations = 5 - $projects->count() . " left";
                $numberOfProjectCollaborations = "?";
                $numberOfGiftGivings = "NO";
                break;
            case 'Caviom Pro':
                $subscription = "SUBSCRIBED TO CAVIOM PRO";
                $numberOfProjectCollaborations = "Unlimited";
                $numberOfGiftGivings = "Unlimited";
                break;
            case 'Caviom Premium':
                $subscription = "SUBSCRIBED TO CAVIOM PREMIUM";
                $numberOfProjectCollaborations = "Unlimited";
                $numberOfGiftGivings = "Unlimited";
                break;
        }

        return view('charity.star-tokens.bal', compact(
            'orders',
            'subscription',
            'numberOfProjectCollaborations',
            'numberOfGiftGivings'
        ));
    }

    public function viewTransactionHistory()
    {
        # Retrieve All Transaction Records
        $orders = order::where('charitable_organization_id', Auth::user()->charitable_organization_id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('charity.star-tokens.all', compact('orders'));
    }

    public function order()
    {
        # Retrieve the pending order(s)
        $orders = DB::table('orders')
            ->where('charitable_organization_id', Auth::user()->charitable_organization_id)
            ->where('status', 'Pending')
            ->get();

        # Check if the charity still has a pending order
        if ($orders->count() >= 1) {
            $toastMsg = array(
                'message' => 'Your charitable organization cannot make an order if it still has a pending order.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($toastMsg);
        }
        return view('charity.star-tokens.order');
    }

    public function store(Request $request)
    {

        # Retrieve the pending order(s)
        $orders = DB::table('orders')
            ->where('charitable_organization_id', Auth::user()->charitable_organization_id)
            ->where('status', 'Pending')
            ->get();

        # Check if the charity still has a pending order
        if ($orders->count() >= 1) {
            $toastMsg = array(
                'message' => 'Your charitable organization cannot make an order if it still has a pending order.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($toastMsg);
        }

        # Validation of New Order
        $validator = Validator::make(
            $request->all(),
            [
                # Validate Proof of Payment
                'proof_of_payment' => ['required', 'mimes:jpg,png,jpeg', 'max:2048', 'file'],

                # Validate Order Items
                'order_form_subscription_type' => ['nullable', Rule::in(['PRO', 'PREMIUM'])],
                'order_form_plan_a_qty' => ['nullable', 'numeric', 'digits:1', 'min:0', 'lte:5'],
                'order_form_plan_b_qty' => ['nullable', 'numeric', 'digits:1', 'min:0', 'lte:5'],
                'order_form_plan_c_qty' => ['nullable', 'numeric', 'digits:1', 'min:0', 'lte:5'],

                # Validate Order
                'mode_of_payment' => ['required', Rule::in(['GCash', 'Metrobank', 'Other'])],
                'paid_at' => ['required', 'before:' . now()->addDay()->toDateString(), 'after:' . now()->subDays(20)],
                'reference_no' => ['required', 'numeric', 'digits_between:1,15'],
            ],
            [
                # Custom Error Messages
                'order_form_subscription_type' => 'Make sure you entered a valid subscription type. Choose only from (2) options: Caviom Pro or Caviom Premium.',
                'order_form_plan_a_qty' => 'Make sure you entered a valid quantity for 600 Star Tokens .',
                'order_form_plan_b_qty' => 'Make sure you entered a valid quantity for 1,500 Star Tokens .',
                'order_form_plan_c_qty' => 'Make sure you entered a valid quantity for 3,000 Star Tokens .',
                'paid_at.before' => 'Payment must be made not more than one day from now.',
            ]
        );

        # Return error toastr if validate request failed
        if ($validator->fails()) {

            $toastr = array(
                'message' => $validator->errors()->first() . ' Please try again.',
                'alert-type' => 'error'
            );

            return redirect()->back()->withInput()->withErrors($validator->errors())->with($toastr);
        }

        # Validation to check if there are items in the order
        if ($request->order_form_subscription_type == '' && $request->order_form_plan_a_qty == 0 && $request->order_form_plan_b_qty == 0 && $request->order_form_plan_c_qty == 0) {
            $toastMsg = array(
                'message' => 'Please make sure your order summary is not empty and try again',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($toastMsg);
        }

        # Validation to check if the charity wants a subscription while having one
        if (Auth::user()->charity->subscription != "Free" && $request->order_form_subscription_type != '') {

            $toastMsg = array(
                'message' => 'You cannot have a subscription order because your charity currently have one.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($toastMsg);
        }

        # Create New Order
        $order = new order;
        $order->code = Str::uuid()->toString();
        $order->charitable_organization_id = Auth::user()->charitable_organization_id;
        $order->reference_no = $request->reference_no;

        # Store proof of payment
        if ($request->file('proof_of_payment')) {
            $file = $request->file('proof_of_payment');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/orders/'), $filename);
            $order->proof_of_payment = $filename;
        }

        $order->mode_of_payment = $request->mode_of_payment;
        $order->total = 0; //Set the Grand Total temporarily to 0
        $order->submitted_by = Auth::user()->id;
        $order->paid_at = $request->paid_at;
        $order->created_at = now();
        $order->save();

        # Initialize the grand total
        $grandTotal = 0;

        # Create New Order Item Record(s)
        if ($request->order_form_subscription_type == "PRO") {

            $item = new order_items;
            $item->order_id = $order->id;
            $item->name = "Caviom Pro";
            $item->price = "249";
            $item->quantity = 1;
            $item->subtotal = "249";

            $grandTotal += 249;

            $item->save();
        } elseif ($request->order_form_subscription_type == "PREMIUM") {

            $item = new order_items;
            $item->order_id = $order->id;
            $item->name = "Caviom Premium";
            $item->price = "2399";
            $item->quantity = 1;
            $item->subtotal = "2399";

            $grandTotal += 2399;

            $item->save();
        }

        if ($request->order_form_plan_a_qty >= 1) {

            $item = new order_items;
            $item->order_id = $order->id;
            $item->name = "600 Star Tokens";
            $item->price = 29;
            $item->quantity = $request->order_form_plan_a_qty;
            $item->subtotal = $request->order_form_plan_a_qty * 29;

            $grandTotal += ($request->order_form_plan_a_qty * 29);

            $item->save();
        }

        if ($request->order_form_plan_b_qty >= 1) {

            $item = new order_items;
            $item->order_id = $order->id;
            $item->name = "1,500 Star Tokens";
            $item->price = 59;
            $item->quantity = $request->order_form_plan_b_qty;
            $item->subtotal = $request->order_form_plan_b_qty * 59;

            $grandTotal += ($request->order_form_plan_b_qty * 59);

            $item->save();
        }

        if ($request->order_form_plan_c_qty >= 1) {

            $item = new order_items;
            $item->order_id = $order->id;
            $item->name = "3,000 Star Tokens";
            $item->price = 109;
            $item->quantity = $request->order_form_plan_c_qty;
            $item->subtotal = $request->order_form_plan_c_qty * 109;

            $grandTotal += ($request->order_form_plan_c_qty * 109);

            $item->save();
        }

        # Update the TOTAL of the Order based on the computed $grandTotal
        order::findOrFail($order->id)->update([
            'total' => $grandTotal,
        ]);

        # Success toastr message
        $notification = array(
            'message' => 'Your order has been submitted successfully!',
            'alert-type' => 'success',
        );

        # Audit Log
        $log = new AuditLog;
        $log->user_id = Auth::user()->id;
        $log->action_type = 'INSERT';
        $log->charitable_organization_id = Auth::user()->charitable_organization_id;
        $log->table_name = 'Order, Order Items';
        $log->record_id = $order->code;
        $log->action = Auth::user()->role . ' created Pending Order.';
        $log->performed_at = Carbon::now();
        $log->save();

        # Send Notification to each user in their Charitable Organizations
        $users = User::where('charitable_organization_id', Auth::user()->charitable_organization_id)->where('status', 'Active')->get();
        foreach ($users as $user) {
            $notif = new Notification;
            $notif->code = Str::uuid()->toString();
            $notif->user_id = $user->id;
            $notif->category = 'Order';
            $notif->subject = 'Order Created';
            $notif->message = Auth::user()->role . ' ' . Auth::user()->info->first_name . ' ' . Auth::user()->info->last_name . ' has
                            created a Pending Order. Please wait for 1-2 working days for Caviom to verify your payment. Thank you.';
            $notif->icon = 'mdi mdi-cart-arrow-up';
            $notif->color = 'success';
            $notif->created_at = Carbon::now();
            $notif->save();
        }

        return redirect()->route('star.tokens.balance')->with($notification);
    }

    public function show($id)
    {
        $order = order::where('id', $id)->orWhere('code', $id)->firstOrFail();
        $orderitems = order_items::where('order_id', $order->id)->get();

        $total_price = DB::table('order_items')
            ->where('order_id', $order->id)
            ->sum('subtotal');

        # Users can only access their own charity's records
        if ($order->charitable_organization_id != Auth::user()->charitable_organization_id) {

            $notification = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {

            return view('charity.star-tokens.view', compact('order', 'orderitems', 'total_price'));
        }
    }
}
