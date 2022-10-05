<?php

namespace App\Exports;

use App\Models\Address;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;


use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;



class UsersExport implements FromCollection,  WithMapping, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // $IDsFromSameOrg = User::where('charitable_organization_id', Auth::user()->charitable_organization_id)->get()->id;

        $user = UserInfo::whereHas('user', function ($q) {
            $q->where('charitable_organization_id', Auth::user()->charitable_organization_id);
        })->with('address')->get();

        // $user = UserInfo::with('address')->get();


        return $user;
    }

    public function map($Userinfo): array
    {

        return [
            $Userinfo->id,
            $Userinfo->organizational_id_no,
            $Userinfo->user->email,
            $Userinfo->last_name,
            $Userinfo->first_name,
            $Userinfo->middle_name,
            $Userinfo->cel_no,
            $Userinfo->tel_no,
            $Userinfo->work_position,
            $Userinfo->address->address_line_one,
            $Userinfo->address->address_line_two,
            $Userinfo->address->province,
            $Userinfo->address->city,
            $Userinfo->address->postal_code,
            $Userinfo->address->barangay,
            $Userinfo->user->status,
        ];
    }

    public function headings(): array
    {
        // Exported Excel Headers, in order, which you should match them base on
        // manipulated data in above
        return [
            'id',
            'Organizational ID',
            'Email',
            'Last name',
            'First name',
            'Middle name',
            'Cellphone No.',
            'Tel No.',
            'Position in the organization',
            'Address 1',
            'Address 2.',
            'Province',
            'City',
            'Postal Code',
            'Barangay',
            'Status',

        ];
    }
}
