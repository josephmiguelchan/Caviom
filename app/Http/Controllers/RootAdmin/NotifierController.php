<?php

namespace App\Http\Controllers\RootAdmin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Notifier;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class NotifierController extends Controller
{
    public function AllNotifier()
    {
        # Retrieve data for Notifier
        $notifier = Notifier::latest()->get();

        return view('admin.main.notifiers.all', compact('notifier'));
    }

    public function AddNotifier()
    {
        # Return Add Notifier Page
        return view('admin.main.notifiers.add');
    }

    public function StoreNotifier(Request $request)
    {
        # Validation Rules
        $request->validate([
            'category' => ['required'],
            'subject' => ['required', 'min:5', 'max:128'],
            'remarks' => ['required', 'min:5', 'max:518'],
        ]);

        # Insert to database
        $notifier = new Notifier;
        $notifier->category = $request->category;
        $notifier->subject = $request->subject;
        $notifier->message = $request->remarks;
        $notifier->created_at = Carbon::now();
        $notifier->save();

        # Create Audit Log
        $log_in = new AuditLog;
        $log_in->user_id = Auth::user()->id;
        $log_in->action_type = 'INSERT';
        $log_in->charitable_organization_id = null;
        $log_in->table_name = 'Notifier';
        $log_in->record_id = $notifier->id;
        $log_in->action = Auth::user()->role . ' created new notifier for [ ' . $notifier->category . ' ] with subject [ ' . $notifier->subject . ' ].';
        $log_in->performed_at = Carbon::now();
        $log_in->save();

        # Send Success toastr
        $toastr = array(
            'message' => 'Notifier has been added successfully.',
            'alert-type' => 'success'
        );

        return to_route('admin.notifiers')->with($toastr);
    }


    public function EditNotifier($id)
    {
        # Retrieve data Return the edit page for notifier
        $notifier = Notifier::findOrFail($id);

        return view('admin.main.notifiers.edit', compact('notifier'));
    }


    public function UpdateNotifier(Request $request, $id)
    {

        # Validation Rules
        $request->validate([
            'category' => ['required'],
            'subject' => ['required', 'min:5', 'max:128'],
            'remarks' => ['required', 'min:5', 'max:518'],
        ]);

        # Retrieve the record using ID
        $notifier = Notifier::findOrFail($id);

        # Update records in database
        $notifier->category = $request->category;
        $notifier->subject = $request->subject;
        $notifier->message = $request->remarks;
        $notifier->created_at = Carbon::now();
        $notifier->save();

        # Create Audit Log
        $log_in = new AuditLog;
        $log_in->user_id = Auth::user()->id;
        $log_in->action_type = 'UPDATE';
        $log_in->charitable_organization_id = null;
        $log_in->table_name = 'Notifier';
        $log_in->record_id = $notifier->id;
        $log_in->action = Auth::user()->role . ' updated the notifier with ID no .' . $notifier->id . 'to [ ' . $notifier->category . ' ] with subject [ ' . $notifier->subject . ' ].';
        $log_in->performed_at = Carbon::now();
        $log_in->save();

        $toastr = array(
            'message' => 'Notifier Updated Successfully',
            'alert-type' => 'success'
        );

        return to_route('admin.notifiers')->with($toastr);
    }

    public function DeleteNotifier($id)
    {
        # Delete the Selected Notifier
        Notifier::where('id', $id)->firstOrFail()->delete();

        # Create Audit Log
        $log_in = new AuditLog;
        $log_in->user_id = Auth::user()->id;
        $log_in->action_type = 'DELETE';
        $log_in->charitable_organization_id = null;
        $log_in->table_name = 'Notifier';
        $log_in->record_id = $id;
        $log_in->action = Auth::user()->role . ' deleted the notifier with ID no. ' . $id . ' permanently.';
        $log_in->performed_at = Carbon::now();
        $log_in->save();

        # Send Toastr Message to the view
        $toastr = array(
            'message' => 'Notifier has been removed successfully.',
            'alert-type' => 'success'
        );

        return to_route('admin.notifiers')->with($toastr);
    }

    public function ViewNotifier($id)
    {
        $notifier = Notifier::where('id', $id)->firstOrFail();

        return view('admin.main.notifiers.view', compact('notifier'));
    }
}
