<?php

namespace App\Exports;


use App\Models\Volunteer;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Volunteers implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $Volunteer = Volunteer::where('charitable_organization_id', Auth::user()->charitable_organization_id)
                        ->with('Address')
                        ->get();
        return  $Volunteer;
    }

     public function map($Volunteer): array
    {

        return [
        
            $Volunteer->id,
            $Volunteer->last_name,
            $Volunteer->first_name,
            $Volunteer->middle_name,
            $Volunteer->email_address,
            $Volunteer->cel_no,
            $Volunteer->tel_no,
            $Volunteer->Address->address_line_one,
            $Volunteer->Address->address_line_two,
            $Volunteer->Address->region,
            $Volunteer->Address->province,
            $Volunteer->Address->city,
            $Volunteer->Address->postal_code,
            $Volunteer->Address->barangay,
            $Volunteer->category,
            $Volunteer->label,
            $Volunteer->created_at,
        ];
    }
    
    public function headings(): array
    {
        // Exported Excel Headers, in order, which you should match them base on
        // manipulated data in above
        return [
            'Id',
            'Last name',
            'First name',
            'Middle name',
            'Email Address',
            'Cellphone No.',
            'Telephone No.',
            'Address 1',
            'Address 2.',
            'Region',
            'Province',
            'City',
            'Postal Code',
            'Barangay',
            'Category',
            'Label',
            'Created_at',

        ];
    }
}
