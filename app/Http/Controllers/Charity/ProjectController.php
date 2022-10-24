<?php

namespace App\Http\Controllers\Charity;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Notification;
use App\Models\Project;
use App\Models\ProjectTask;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\ProjectFactory;

class ProjectController extends Controller
{
    public function AllProject()
    
    {
        # Retrieve Project
        $projects = Project::where('charitable_organization_id', Auth::user()->charitable_organization_id)
                                            ->orderBy('name', 'ASC')
                                            ->get();

        return view('charity.main.projects.all', compact('projects'));
    }

    public function ViewProject($code)
    {
        $project = Project::where('code', $code)->firstOrFail();
        $tasks = ProjectTask::where('project_id', $project->id)->orderBy('status', 'ASC')->latest()->get();

        $users = User::where('charitable_organization_id',Auth::user()->charitable_organization_id)->where('status','Active')->get();
        return view('charity.main.projects.view', compact('project','users','tasks'));
        
    }

    public function AddProject() // Charity admin only
    {
        // Max of 5 projects for Free subscriptioon

        If (Auth::user()->charity->projects->count() >= 5 and Auth::user()->charity->subscription == 'Free')
        {
            $toastr = array(
                'message' => 'Sorry, Your Organization has already reached the limit of five (5) Projects. Subscribe to Caviom Pro / Premium to unlock more projects.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($toastr);
        }
        else
        {
            return view('charity.main.projects.add');
        }


    }

    public function StoreProject(Request $request)
    {
        # Validation Rules
        $request->validate([
            'name' => 'required|unique:projects|min:5|max:255',
            'cover_photo' => 'nullable|mimes:jpg,png,jpeg|max:2048|file',
            'objective' => 'required|min:5',
        ], [
            //for custom message if need ， just delete it if no need custom message

        ]);


        # Store Data to database
        $project = new Project;
        $project->name = $request->name;
        $project->code =Str::uuid()->toString();
        $project->charitable_organization_id = Auth::user()->charitable_organization_id;

          # Insert Cover Photo to database
          if ($request->file('cover_photo')) {
            $file = $request->file('cover_photo');
            $filename = date('YmdHi') . '.' . $file->getClientOriginalExtension();

            // Image::make($file)->resize(200, null, function ($constraint) {
            //     $constraint->aspectRatio();
            // });
            $file->move(public_path('upload/charitable_org/project_photo/'), $filename);
            $project->cover_photo = $filename;
        }

        $project->objective = $request->objective;
        $project->created_at = Carbon::now();
        $project->save();

        # Create Audit Logs
        $log_in = new AuditLog();
        $log_in->user_id = Auth::user()->id;
        $log_in->action_type = 'INSERT';
        $log_in->charitable_organization_id = $project->charitable_organization_id;
        $log_in->table_name = 'Project';
        $log_in->record_id = $project->code;
        $log_in->action = Auth::user()->role.'[ '.Auth::user()->info->first_name.' '.Auth::user()->info->last_name.' ] 
                            created a new Project called [ '.$request->name.' ].';
        $log_in->performed_at = Carbon::now();
        $log_in->save();

        # Send notification to all user
        $users = User::where('charitable_organization_id', Auth::user()->charitable_organization_id)
        ->where('status', 'Active')
        ->get();

        foreach ($users as $user) {
        $notif = new Notification;
        $notif->code = Str::uuid()->toString();
        $notif->user_id = $user->id;
        $notif->category = 'Project';
        $notif->subject = 'New Project Created';
        $notif->message = Auth::user()->role.'[ '.Auth::user()->info->first_name.' '.Auth::user()->info->last_name.' ] 
                            created a new Project called [ '.$request->name.' ].';
        $notif->icon = 'mdi mdi-clipboard-check-multiple-outline';
        $notif->color = 'success';
        $notif->created_at = Carbon::now();
        $notif->save();
    }


        # send success toastr
        $toastr = array(
            'message' => 'Project Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('charity.projects.all')->with($toastr);
    }

    public function EditProject($code) // Charity admin only

    {

        if(Auth::user()->charity->subscription == 'Free' and Auth::user()->charity->projects->count() >5)
        {
            # send error  toastr
            $toastr = array(
                'message' => 'Sorry, you cannot edit projects if your Organization has already reached more than five (5) free projects.',
                'alert-type' => 'warning'
            );

            return redirect()->back()->with($toastr);
        }

        $project = Project::where('code', $code)->firstOrFail();

        return view('charity.main.projects.edit',compact('project'));



    }
    public function UpdateProject(Request $request,$code)
    {
         # Validation Rules
         $request->validate([
            'name' => 'required|min:5|max:255',
            'cover_photo' => 'nullable|mimes:jpg,png,jpeg|max:2048|file',
            'objective' => 'required|min:5',
        ], [
            //for custom message if need ， just delete it if no need custom message

        ]);

        $project = Project::where('code', $code)->firstOrFail();
        # Update Data to Database
        if($project->name)
        {
            Rule::unique('projects')->ignore($project);
            $project->name = $request->name;
        }
     
        $project->code =Str::uuid()->toString();
        $project->charitable_organization_id = Auth::user()->charitable_organization_id;

          # Insert Cover Photo to database
          if ($request->file('cover_photo')) {
            $file = $request->file('cover_photo');
            $filename = date('YmdHi') . '.' . $file->getClientOriginalExtension();

            // Image::make($file)->resize(200, null, function ($constraint) {
            //     $constraint->aspectRatio();
            // });
            $file->move(public_path('upload/charitable_org/project_photo/'), $filename);
            $project->cover_photo = $filename;
        }

        $project->objective = $request->objective;
        $project->updated_at = Carbon::now();
        $project->save();

        # Create Audit Logs
        $log_in = new AuditLog;
        $log_in->user_id = Auth::user()->id;
        $log_in->action_type = 'UPDATE';
        $log_in->charitable_organization_id = $project->charitable_organization_id;
        $log_in->table_name = 'Project';
        $log_in->record_id = $project->code;
        $log_in->action = Auth::user()->role.'[ '.Auth::user()->info->first_name.' '.Auth::user()->info->last_name.' ] 
                            updated the Project called [ '.$project->name.' ].';
        $log_in->performed_at = Carbon::now();
        $log_in->save();

        # Send notification to all user
        $users = User::where('charitable_organization_id', Auth::user()->charitable_organization_id)
        ->where('status', 'Active')
        ->get();

        foreach ($users as $user) {
            $notif = new Notification;
            $notif->code = Str::uuid()->toString();
            $notif->user_id = $user->id;
            $notif->category = 'Project';
            $notif->subject = 'Project Updated';
            $notif->message = Auth::user()->role.'[ '.Auth::user()->info->first_name.' '.Auth::user()->info->last_name.' ] 
                                updated the Project called [ '.$project->name.' ].';
            $notif->icon = 'mdi mdi-clipboard-check-multiple-outline';
            $notif->color = 'warning';
            $notif->created_at = Carbon::now();
            $notif->save();
        }


        
        # Send success toastr
        $toastr = array(
            'message' => 'Selected Project has been updated successfully.',
            'alert-type' => 'success'
        );
        
        return redirect()->route('charity.projects.all')->with($toastr);

    
    }

    public function DeleteProject($code) // Charity admin Only
    {


        $project = Project::where('code', $code)->firstOrFail();

        // # Delete old coverphoto of payment photo if exists
        $oldImg = $project->cover_photo;
        if ($oldImg) unlink(public_path('upload/charitable_org/project_photo/') . $oldImg);

        $project->delete();

      
        # Create Audit Logs
        $log_in = new AuditLog;
        $log_in->user_id = Auth::user()->id;
        $log_in->action_type = 'UPDATE';
        $log_in->charitable_organization_id = $project->charitable_organization_id;
        $log_in->table_name = 'Project, Project Task';
        $log_in->record_id = $project->code;
        $log_in->action = Auth::user()->role.'[ '.Auth::user()->info->first_name.' '.Auth::user()->info->last_name.' ] 
                            deleted the  Project  [ '.$project->name.' ] including all of its task';
        $log_in->performed_at = Carbon::now();
        $log_in->save();


        # Send notification to all user
        $users = User::where('charitable_organization_id', Auth::user()->charitable_organization_id)
        ->where('status', 'Active')
        ->get();

        foreach ($users as $user) {
            $notif = new Notification;
            $notif->code = Str::uuid()->toString();
            $notif->user_id = $user->id;
            $notif->category = 'Project';
            $notif->subject = 'Project Deleted';
            $notif->message = Auth::user()->role.'[ '.Auth::user()->info->first_name.' '.Auth::user()->info->last_name.' ] 
                                has deleted the entire Project: [ '.$project->name.' ]. All task Associated to this project are automatically deleted';
            $notif->icon = 'mdi mdi-clipboard-alert-outline';
            $notif->color = 'danger';
            $notif->created_at = Carbon::now();
            $notif->save();
        }

          # Send success toastr
          $toastr = array(
            'message' => 'Selected Project has been removed successfully.',
            'alert-type' => 'success'
        );

        

        return redirect()->route('charity.projects.all')->with($toastr);

    }

    // public function Alltask($code)
    // {

    //     $project = Project::where('code', $code)->firstOrFail();

    //     # Retrieve Project task
    //     $task = ProjectTask::where('charitable_organization_id', Auth::user()->charitable_organization_id)
    //     ->where('project_id',$project->id)
    //     ->orderBy('title', 'ASC')
    //     ->get();

    //     return view('charity.main.projects.tasks.all', compact('task'));
    // }

    public function ViewTask($code)
    {

        $task = ProjectTask::where('code', $code)->firstOrFail();

        return view('charity.main.projects.tasks.view',compact('task'));

        // Save button will only appear if you are the task creator and task assigned to 
        // delete is only for task creator and charity admin

    }
    public function StoreTask(Request $request, $code)  //Both Charity admin and associate can do
    {
        # Validation Rules
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5|max:255',
            'note' => 'nullable|max:280',
            'deadline' => 'required|after_or_equal:' . Carbon::now(),
            'assigned_to' => 'required'
        ], [
            // For custom message if need ， just delete it if no need custom message
            'deadline.after_or_equal' => 'Deadline must be in the future.'
        ]);

        if ($validator->fails()) {
            $toastr = array(
                'message' => $validator->errors()->first() . ' Please try again.',
                'alert-type' => 'error'
            );

            return redirect()->back()->withInput()->withErrors($validator->errors())->with($toastr);
        }

        $project = Project::where('code', $code)->firstOrFail();

        if($project->project_task->count()>=100)
        {
            # Send success toastr
            $toastr = array(
                'message' => 'Sorry, you have already reached the limit of (100) tasks for this project.',
                'alert-type' => 'warning'
        );

             return redirect()->back()->with($toastr);
        }

        $task = new ProjectTask;
        $task->code = Str::uuid()->toString();
        $task->project_id = $project->id;
        $task->assigned_by = Auth::user()->id;
        $task->assigned_to = $request->assigned_to;
        $task->title = $request->title;
        $task->note = $request->note;
        $task->deadline = $request->deadline;
        $task->created_at = Carbon::now();
        $task->save();


        #  Send notification to task assigned to 
        $notif = new Notification;
        $notif->code = Str::uuid()->toString();
        $notif->user_id = $task->assigned_to;
        $notif->category = 'Project Task';
        $notif->subject = 'New Task Assignment';
        $notif->message = Auth::user()->role.' [ '.Auth::user()->info->first_name.' '.Auth::user()->info->last_name.' ] 
                            assigned: [ '.$task->AssignedTo->info->first_name.' '.$task->AssignedTo->info->last_name.' ] to a new task [ '.$task->title.' ] in Project [ ' .$task->project->name. ' ]. Please navigate to projects tab to view your task.';
        $notif->icon = 'mdi mdi-clipboard-account-outline';
        $notif->color = 'info';
        $notif->created_at = Carbon::now();
        $notif->save();

        # Create Audit Logs
        $log_in = new AuditLog;
        $log_in->user_id = Auth::user()->id;
        $log_in->action_type = 'INSERT';
        $log_in->charitable_organization_id = Auth::user()->charitable_organization_id;
        $log_in->table_name = 'Project Task';
        $log_in->record_id = $task->code;
        $log_in->action = $task->AssignedBy->info->first_name.' '.$task->AssignedBy->info->last_name.' assigned '.$task->AssignedTo->info->first_name. ' '.$task->AssignedTo->info->last_name.' to a new Task [ '.$task->title.' ] in Project: '.$task->project->name . '.';
        $log_in->performed_at = Carbon::now();
        $log_in->save();

        
        # Send success toastr
        $toastr = array(
            'message' => 'A new task has been added successfully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($toastr);


    }
    public function UpdateTask(Request $request,$code )
    {
        # Validation Rules
        $validator = Validator::make($request->all(), [
            'note' => 'required|max:280',
            'task_status' => ['required', Rule::in('Pending', 'In-Progress', 'Completed')],
        ], [
            // Custom error message
        ]);

        if ($validator->fails()) {
            $toastr = array(
                'message' => $validator->errors()->first() . ' Please try again.',
                'alert-type' => 'error'
            );

            return redirect()->back()->withInput()->withErrors($validator->errors())->with($toastr);
        }

        # Only task assignee is allowed to update this task.
        $task = ProjectTask::where('code', $code)->firstOrFail();
        if ($task->assigned_to != Auth::id()) {
            $toastr = array(
                'message' => 'Only Task Assignee can update this task.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($toastr);
        }

        $task->note = $request->note;
        $task->status = $request->task_status;  
        $task->updated_at = Carbon::now();
        $task->save();

            
        # Send success toastr
        $toastr = array(
            'message' => 'Selected Task Updated successfully.',
            'alert-type' => 'success'
        );

    
        return redirect()->back()->with($toastr);
    }

    public function DeleteTask($code) 
    {
        # Retrieve task record
        $task = ProjectTask::where('code', $code)->firstOrFail();
         
        # Send notification to task assigned to if the task is not yet finished
        if($task->status != 'Completed'){
            $notif = new Notification;
            $notif->code = Str::uuid()->toString();
            $notif->user_id = $task->assigned_to;
            $notif->category = 'Project Task';
            $notif->subject = 'Task Deleted';
            $notif->message = Auth::user()->role.' [ '.Auth::user()->info->first_name.' '.Auth::user()->info->last_name.' ] 
                                deleted the Task: [ '.$task->title.' ].  You are being notified because this task was previously assigned to you.';
            $notif->icon = 'mdi mdi-clipboard-alert-outline';
            $notif->color = 'danger';
            $notif->created_at = Carbon::now();
            $notif->save();

        }
 
        # Create Audit Logs
        $log_in = new AuditLog;
        $log_in->user_id = Auth::user()->id;
        $log_in->action_type = 'DELETE';
        $log_in->charitable_organization_id = Auth::user()->charitable_organization_id;
        $log_in->table_name = 'Project Task';
        $log_in->record_id = $task->code;
        $log_in->action = Auth::user()->role.'[ '.Auth::user()->info->first_name.' '.Auth::user()->info->last_name.' ] 
                            deleted the task [ '.$task->title.' ] in Project ['.$task->project->name .' ].' ;
        $log_in->performed_at = Carbon::now();
        $log_in->save();



        $task->delete();
        $toastr = array(
            'message' => 'Selected Task has been removed successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('charity.projects.view', $task->project->code)->with($toastr);
    }

}
