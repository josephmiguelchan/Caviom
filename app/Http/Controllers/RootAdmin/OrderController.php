<?php

namespace App\Http\Controllers\RootAdmin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Notifier;
use App\Models\Admin\order;
use App\Models\Admin\order_items;
use App\Models\AuditLog;
use App\Models\CharitableOrganization;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Chart\Chart;

class OrderController extends Controller
{
    public function AllOrders()
    {
        # Retrieve All Featured Project

        $orders = order::orderBy('status','ASC')->get();

        return view('admin.main.orders.all',compact('orders'));
    }

    public function ViewOrder($code)
    {
        $order = order::where('code', $code)->firstOrFail();


        $stRemarks = Notifier::where('category', 'Star Token Order')->get();

        $orderitems = order_items::where('order_id', $order->id)->get();

        $total_price = DB::table('order_items')
        ->where('order_id', $order->id)
        ->sum('subtotal');

        return view('admin.main.orders.view', compact('order','stRemarks','orderitems','total_price'));

   
    }


    public function RejectOrder(Request $request ,$code)
    {

        # Retrieve Selcted Order Record
        $order = order::where('code', $code)->firstOrFail();

        # Update order Record
        $order->status = 'Rejected';

        # Set the remarks MESSAGE based on the value of star token  from Notifiers dropdown table.
         if ($request->remarks_subject == null) {
            $order->remarks_subject = null;
            $order->remarks_message = null;
        } else {
            $order->remarks_subject = $request->remarks_subject;
            $remarks_from_notifiers = Notifier::where('category', 'Star Token Order')->get();
            foreach ($remarks_from_notifiers as $notifier) {
                switch ($request->remarks_subject) {
                    case $notifier->subject:
                        $order->remarks_message = $notifier->message;
                        break;
                }
            }
        }

        $order->status_updated_at =Carbon::now();
        $order->save();


        # Create Audit Logs
        $log_in = new AuditLog();
        $log_in->user_id = Auth::user()->id;
        $log_in->action_type = 'UPDATE';
        $log_in->charitable_organization_id = $order->charitable_organization_id;
        $log_in->table_name = 'Order';
        $log_in->record_id = $order->code;
        $log_in->action = Auth::user()->role . ' has set the status as Rejected for Order:  
                                [ '.Str::upper(Str::limit($order->code,6, '')).' ] with Remarks [ '.$order->remarks_subject .' ]. ';
        $log_in->performed_at = Carbon::now();
        $log_in->save();

        # Send Notification to user

        $users = User::where('charitable_organization_id', $order->charitable_organization_id)
                        ->where('status', 'Active')
                        ->where('role','Charity Admin')
                        ->get();

        foreach ($users as $user) {    
            $notif = new Notification;
            $notif->code = Str::uuid()->toString();
            $notif->user_id = $user->id;
            $notif->category = 'Order';
            $notif->subject = 'Order Rejected';
            $notif->message = 'Sorry, your Order: '.Str::upper(Str::limit($order->code,6,'')).' has been decline by Caviom due to [
                ' .$order->remarks_subject. ' ]. '. $order->remarks_message .' If you wish to reorder, please try again or email us at support@caviom.org if you think there was a mistake';
            $notif->icon = 'mdi mdi-cart-off';
            $notif->color = 'danger';
            $notif->created_at = Carbon::now();
            $notif->save();
        }

        # Send Success toastr
        $toastr = array(
            'message' => 'The Star Token Order has been succesfully Rejected.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($toastr);


    }
    public function ApprovedOrder($code)
    {
        # Retrieve Selected Order Record
        $order = order::where('code', $code)->firstOrFail();

        # Retrieve the origin of the Order (Charitable Organization record)
        $charity = CharitableOrganization::findOrFail($order->charitable_organization_id);

        # Get the Star token balance for the Organization
        $current_bal = $charity->star_tokens;

        # Create a local variable to temporarily store the total balance/subscription to be credited
        $subscription = null;
        $star_tokens = 0;
        $featured_project_credits = 0;
        $subscription_expires_at = null;

        foreach($order->order_items as $item)
        {
            switch ($item->name) {
                case '600 Star Tokens':
                    $star_tokens += (600 * $item->quantity);
                    break;
                
                case '1,500 Star Tokens':
                    $star_tokens += (1500 * $item->quantity);
                    break;
                
                case '3,000 Star Tokens':
                    $star_tokens += (3000 * $item->quantity);
                    break;
                
                case 'Caviom Pro':
                    $subscription = 'Caviom Pro';
                    $featured_project_credits += 5;
                    $subscription_expires_at = Carbon::now()->addMonth();
                    break;
                
                case 'Caviom Premium':
                    $subscription = 'Caviom Premium';
                    $featured_project_credits += 50;
                    $subscription_expires_at = Carbon::now()->addMonths(12);
                    break;
                
                default:
                    # Send Error toastr
                    $toastr = array(
                        'message' => 'The Order has one or more item/s [ '. $item->name .'] that are invalid.',
                        'alert-type' => 'error'
                    );

                    return redirect()->back()->with($toastr);
                    break;
                }
        }

        # Update Charity Organization Subscription
        if ($subscription) {

            # Update only if the Charity has not yet subscribed to any Paid Subscription
            if ($charity->subscription != 'Free') {

                # Send Error toastr
                $toastr = array(
                    'message' => 'This Charity is already subscribed. Only one (1) subscription are allowed at a time.',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($toastr);
            }
            $charity->subscription = $subscription;
            $charity->subscribed_at = Carbon::now();
            $charity->subscription_expires_at = $subscription_expires_at;
            $charity->featured_project_credits += $featured_project_credits;
            $charity->save();
        }

        # Update Charity Organization Star Token Balance
        $charity->star_tokens = $current_bal + $star_tokens;
        $charity->save();
        

        # Update order status
        $order->status ='Confirmed';
        $order->status_updated_at = Carbon::now();
        $order->save();


        # Create Audit Logs
        $log_in = new AuditLog();
        $log_in->user_id = Auth::user()->id;
        $log_in->action_type = 'UPDATE';
        $log_in->charitable_organization_id = $order->charitable_organization_id;
        $log_in->table_name = 'Order';
        $log_in->record_id = $order->code;
        $log_in->action = Auth::user()->role . ' has set the status as CONFIRMED for Order:  
                                [ '.Str::upper(Str::limit($order->code,6, '')).' ] . ';
        $log_in->performed_at = Carbon::now();
        $log_in->save();

        
        
        # Send Notification to user        
        $users = User::where('charitable_organization_id', $order->charitable_organization_id)
            ->where('status', 'Active')
            ->where('role', 'Charity Admin')
            ->get();
        
        foreach ($users as $user) {
            $notif = new Notification;
            $notif->code = Str::uuid()->toString();
            $notif->user_id = $user->id;
            $notif->category = 'Order';
            $notif->subject = 'Confirmed Order';
            $notif->message = 'Sucess! We have confirmed acknowledgement on your Order: '.
                Str::upper(Str::limit($order->code,6, '')).'. Your Star Tokens balance and/or subscription has 
                now been updated. Thank you for supporting Caviom!';
            $notif->icon = 'mdi mdi-cart-check';
            $notif->color = 'success';
            $notif->created_at = Carbon::now();
            $notif->save();
        }
        
        # Send Success toastr
        $toastr = array(
            'message' => 'The selected Order has been succesfully confirmed.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($toastr);
    
    }
}
