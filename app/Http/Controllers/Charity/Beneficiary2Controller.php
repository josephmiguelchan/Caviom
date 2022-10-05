<?php

namespace App\Http\Controllers\Charity;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Models\BeneficiaryFamilyInfo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Beneficiary2Controller extends Controller
{
    public function createPart2($id)
    {
        # Retrieve the beneficiary record with family info using foreign key
        $beneficiary = Beneficiary::where('id', $id)->orWhere('code', $id)->firstorFail();

        if (!$beneficiary->charitable_organization_id == Auth::user()->charitable_organization_id) {

            $notification = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        } else {

            $familyInfo = BeneficiaryFamilyInfo::where('beneficiary_id', $beneficiary->id)->get();
            return view('charity.main.beneficiaries.add-part2',compact('beneficiary','familyInfo'));

        }
    }

    public function editPart2($id)
    {
        # Retrieve the beneficiary record with family info using foreign key
        $beneficiary = Beneficiary::where('id', $id)->orWhere('code', $id)->firstorFail();

        if (!$beneficiary->charitable_organization_id == Auth::user()->charitable_organization_id) {

            $notification = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        } else {

            $familyInfo = BeneficiaryFamilyInfo::where('beneficiary_id', $beneficiary->id)->get();
            return view('charity.main.beneficiaries.edit-part2',compact('beneficiary','familyInfo'));

        }
    }

    public function storePart2(Request $request, $id)
    {
        # Retrieve the beneficiary record with family info using foreign key
        $beneficiary = Beneficiary::where('id', $id)->orWhere('code', $id)->firstorFail();

        if (!$beneficiary->charitable_organization_id == Auth::user()->charitable_organization_id) {

            $notification = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        } else {

            # Validation of New Beneficiary
            $request->validate([
                'fam_first_name' => ['required', 'string', 'min:1', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                'fam_last_name' => ['required', 'string', 'min:1', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                'fam_middle_name' => ['nullable', 'string', 'min:1', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                'fam_birth_date' => ['required', 'before:'.now()->toDateString(), 'after:'.now()->subYears(100)],
                'fam_relationship' => ['required', 'string', 'min:1', 'max:64','regex:/^[a-zA-Z ñ,-.\']*$/'],
                'fam_civil_status' => ['nullable', 'string', 'min:1', 'max:64'],
                'fam_education' => ['nullable', 'string', 'min:1', 'max:64'],
                'fam_occupation' => ['nullable', 'string', 'min:1', 'max:64'],
                'fam_income' => ['nullable', 'string', 'min:1', 'max:64'],
                'fam_where_abouts' => ['nullable', 'string', 'min:1', 'max:64'],
            ],[
                'fam_first_name.required' => 'First name is required',
                'fam_first_name.string' => 'First name must consist of letters only',
                'fam_first_name.max' => 'First name seems too long',
                'fam_first_name.regex' => 'First name format is invalid',

                'fam_middle_name.string' => 'Middle name must consist of letters only',
                'fam_middle_name.max' => 'Middle name seems too long',
                'fam_middle_name.regex' => 'Middle name format is invalid',

                'fam_last_name.required' => 'Last name is required',
                'fam_last_name.string' => 'Last name must consist of letters only',
                'fam_last_name.max' => 'Last name seems too long',
                'fam_last_name.regex' => 'Last name format is invalid',

                'fam_birth_date.before' => 'Birth date must be realistic',

                'fam_relationship.required' => 'Relationship is required',
                'fam_relationship.regex' => 'Relationship format is invalid',
                'fam_relationship.string' => 'Relationship format is invalid',
            ]);

            # Creating New Beneficiary Record Part 2 - Family Economic Background
            $familyInfo = new BeneficiaryFamilyInfo;
            $familyInfo->first_name = $request->fam_first_name;
            $familyInfo->last_name = $request->fam_last_name;
            $familyInfo->middle_name = $request->fam_middle_name;
            $familyInfo->birth_date = $request->fam_birth_date;
            $familyInfo->relationship = $request->fam_relationship;
            $familyInfo->civil_status = $request->fam_civil_status;
            $familyInfo->education = $request->fam_education;
            $familyInfo->occupation = $request->fam_occupation;
            $familyInfo->income = $request->fam_income;
            $familyInfo->where_abouts = $request->fam_where_abouts;
            $familyInfo->beneficiary_id = $beneficiary->id;
            $familyInfo->save();

            $successMsg = array(
                'message' => 'A new family info has been added to this beneficiary successfully!',
                'alert-type' => 'success'
            );

            # Create Audit Logs
            //TO DO --- Not sure if this will work.
//            $uuid = Str::uuid()->toString();
//
//            $log = new AuditLog;
//            $log->user_id = Auth::user()->id;
//            $log->action_type = 'ADD';
//            $log->charitable_organization_id = Auth::user()->charitable_organization_id;
//            $log->table_name = 'Beneficiary Family Info';
//            $log->record_id = $uuid;
//            $log->action = 'Charity User Added Family Info [' . $request->last_name . ', '. $request->first_name . ' ' . $request->middle_name . ']';
//            $log->performed_at = Carbon::now();
//            $log->save();

            if($request->form_type == "redirectToViewAfterAdd"){
                return redirect()->route('charity.beneficiaries2.createPart2', $beneficiary->code)->with($successMsg);
            }elseif ($request->form_type == "redirectToViewAfterEdit"){
                return redirect()->route('charity.beneficiaries2.editPart2', $beneficiary->code)->with($successMsg);
            }else{
                return redirect()->back()->with($successMsg);
            }

        }

    }

    public function updatePart2(Request $request)
    {
        # Retrieve the beneficiary record with family info using foreign key (another approach)
        $beneficiary = Beneficiary::where('id', $request->beneficiary_code)
            ->orWhere('code', $request->beneficiary_code)->firstorFail();
        $familyInfoId = $request->id;

        # This is working!
//        return $request->edit_fam_first_name;

        if (!$beneficiary->charitable_organization_id == Auth::user()->charitable_organization_id) {

            $notification = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        } else {

            # Validation of Edit Beneficiary
            $request->validate([
                'edit_fam_first_name' => ['required', 'string', 'min:1', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                'edit_fam_last_name' => ['required', 'string', 'min:1', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                'edit_fam_middle_name' => ['nullable', 'string', 'min:1', 'max:64', 'regex:/^[a-zA-Z ñ,-.\']*$/'],
                'edit_fam_birth_date' => ['required', 'before:'.now()->toDateString(), 'after:'.now()->subYears(100)],
                'edit_fam_relationship' => ['required', 'string', 'min:1', 'max:64','regex:/^[a-zA-Z ñ,-.\']*$/'],
                'edit_fam_civil_status' => ['nullable', 'string', 'min:1', 'max:64'],
                'edit_fam_education' => ['nullable', 'string', 'min:1', 'max:64'],
                'edit_fam_occupation' => ['nullable', 'string', 'min:1', 'max:64'],
                'edit_fam_income' => ['nullable', 'string', 'min:1', 'max:64'],
                'edit_fam_where_abouts' => ['nullable', 'string', 'min:1', 'max:64'],
            ],[
                'edit_fam_first_name.required' => 'First name is required',
                'edit_fam_first_name.string' => 'First name must consist of letters only',
                'edit_fam_first_name.max' => 'First name seems too long',
                'edit_fam_first_name.regex' => 'First name format is invalid',

                'edit_fam_middle_name.string' => 'Middle name must consist of letters only',
                'edit_fam_middle_name.max' => 'Middle name seems too long',
                'edit_fam_middle_name.regex' => 'Middle name format is invalid',

                'edit_fam_last_name.required' => 'Last name is required',
                'edit_fam_last_name.string' => 'Last name must consist of letters only',
                'edit_fam_last_name.max' => 'Last name seems too long',
                'edit_fam_last_name.regex' => 'Last name format is invalid',

                'edit_fam_birth_date.before' => 'Birth date must be realistic',

                'edit_fam_relationship.required' => 'Relationship is required',
                'edit_fam_relationship.regex' => 'Relationship format is invalid',
                'edit_fam_relationship.string' => 'Relationship format is invalid',
            ]);

            # Begin updating the family info of the retrieved beneficiary.
           BeneficiaryFamilyInfo::findOrFail($familyInfoId)->update([
                'first_name' => $request->edit_fam_first_name,
                'middle_name' => $request->edit_fam_middle_name,
                'last_name' => $request->edit_fam_last_name,
                'birth_date' => $request->edit_fam_birth_date,
                'relationship' => $request->edit_fam_relationship,
                'civil_status' => $request->edit_fam_civil_status,
                'education' => $request->edit_fam_education,
                'occupation' => $request->edit_fam_occupation,
                'income' => $request->edit_fam_income,
                'where_abouts' => $request->edit_fam_where_abouts,
            ]);

            $successMsg = array(
                'message' => 'A new family info has been edited successfully!',
                'alert-type' => 'success'
            );

            # Create Audit Logs
            //TO DO --- Not sure if this will work.
//            $uuid = Str::uuid()->toString();
//
//            $log = new AuditLog;
//            $log->user_id = Auth::user()->id;
//            $log->action_type = 'UPDATE';
//            $log->charitable_organization_id = Auth::user()->charitable_organization_id;
//            $log->table_name = 'Beneficiary Family Info';
//            $log->record_id = $uuid;
//            $log->action = 'Charity User updated [' . $request->last_name . ', '. $request->first_name . ' ' . $request->middle_name . ']';
//            $log->performed_at = Carbon::now();
//            $log->save();

            if($request->form_type == "redirectToViewAfterAdd"){
                return redirect()->route('charity.beneficiaries2.createPart2', $beneficiary->code)->with($successMsg);
            }elseif ($request->form_type == "redirectToViewAfterEdit"){
                return redirect()->route('charity.beneficiaries2.editPart2', $beneficiary->code)->with($successMsg);
            }else{
                return redirect()->back()->with($successMsg);
            }
        }

    }

    public function destroyPart2(Request $request)
    {
        # Retrieve the beneficiary record with family info using foreign key (another approach)
        $beneficiary = Beneficiary::where('id', $request->beneficiary_code)
            ->orWhere('code', $request->beneficiary_code)->firstorFail();

        if (!$beneficiary->charitable_organization_id == Auth::user()->charitable_organization_id) {

            $notification = array(
                'message' => 'Users can only access their own charity records.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        } else {

            # Deleting the family info of the retrieved beneficiary.
            $beneficiaryFamilyInfo = BeneficiaryFamilyInfo::where('id', $request->id)->firstorFail();
            $beneficiaryFamilyInfo->delete();

            $successMsg = array(
                'message' => 'A new family info has been deleted successfully!',
                'alert-type' => 'success'
            );

            # Create Audit Logs
            //TO DO --- Not sure if this will work.
//            $uuid = Str::uuid()->toString();
//
//            $log = new AuditLog;
//            $log->user_id = Auth::user()->id;
//            $log->action_type = 'DELETE';
//            $log->charitable_organization_id = Auth::user()->charitable_organization_id;
//            $log->table_name = 'Beneficiary Family Info';
//            $log->record_id = $uuid;
//            $log->action = 'Charity User deleted family info [' . $request->last_name . ', '. $request->first_name . ' ' . $request->middle_name . ']';
//            $log->performed_at = Carbon::now();
//            $log->save();

            if($request->form_type == "redirectToViewAfterAdd"){
                return redirect()->route('charity.beneficiaries2.createPart2', $beneficiary->code);
            }elseif ($request->form_type == "redirectToViewAfterEdit"){
                return redirect()->route('charity.beneficiaries2.editPart2', $beneficiary->code);
            }else{
                return redirect()->back();
            }

        }
    }
}
