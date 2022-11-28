<?php

namespace App\Exports;

use App\Models\Benefactor;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Benefactors implements FromCollection , WithMapping, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $Benefactors = Benefactor::where('charitable_organization_id', Auth::user()->charitable_organization_id)
        ->with('Address')
        ->get();
        return  $Benefactors;
    }


    public function map($Benefactors): array
    {
        return [
            $Benefactors->id,
            $Benefactors->last_name,
            $Benefactors->first_name,
            $Benefactors->middle_name,
            $Benefactors->email_address,
            $Benefactors->cel_no,
            $Benefactors->tel_no,
            $Benefactors->Address->address_line_one,
            $Benefactors->Address->address_line_two,
            $Benefactors->Address->region,
            $Benefactors->Address->province,
            $Benefactors->Address->city,
            $Benefactors->Address->postal_code,
            $Benefactors->Address->barangay,
            $Benefactors->category,
            $Benefactors->label,
            $Benefactors->created_at,
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
