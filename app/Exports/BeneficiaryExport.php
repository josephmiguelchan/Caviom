<?php

namespace App\Exports;

use App\Models\Beneficiary;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BeneficiaryExport implements FromCollection , WithMapping, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $Beneficiaries = Beneficiary::where('charitable_organization_id', Auth::user()->charitable_organization_id)
        ->with('presentAddress')
        ->get();
        return  $Beneficiaries;
    }
    public function map($Beneficiaries): array
    {

        return [
            $Beneficiaries->id,
            $Beneficiaries->last_name,
            $Beneficiaries->first_name,
            $Beneficiaries->middle_name,
            $Beneficiaries->birth_place,
            $Beneficiaries->birth_date,
            $Beneficiaries->presentAddress->address_line_one,
            $Beneficiaries->presentAddress->address_line_two,
            $Beneficiaries->presentAddress->region,
            $Beneficiaries->presentAddress->province,
            $Beneficiaries->presentAddress->city,
            $Beneficiaries->presentAddress->postal_code,
            $Beneficiaries->presentAddress->barangay,
            $Beneficiaries->interviewed_at,
            $Beneficiaries->created_at,

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
            'Birth Place',
            'Birth Date',
            'Address 1',
            'Address 2',
            'Region',
            'Province',
            'City',
            'Postal Code',
            'Barangay',
            'Interviewd_at',
            'Record Created at',

        ];
    }
}
