<!DOCTYPE html>
<html>
<head>
  <title>Backup Beneficiary Data as PDF</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>


<style>
  
  .tableinformation {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 75%;
  
    margin-left: auto;
    margin-right: auto;
    border-style: none;
  
    
  }
  .tableinformation td
  {
    border:none;
     outline:none;
  }
  .tableinformation :nth-child(odd) {
    width: 40%;
    }
  
  
  td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }
  
  
    .organization {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 75%;
  
    margin-left: auto;
    margin-right: auto;
    margin-top: 50px ;
    margin-bottom: 50px;
  
    
  } 
  .organization td
  {
    border:none;
     outline:none;
  }
  .family
  {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 75%;
    margin-left: auto;
    margin-right: auto;
    margin-top: 50px ;
    margin-bottom: 50px;
  }
  .family th
  {
    text-align: center;
  }
  .family td
  {
    text-align: center;
  }
  
  .tableinformation2 {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 75%;
  
    margin-left: auto;
    margin-right: auto;
  
    
  }
  
  .tableinformation2 td ,th
  {
    border:none;
     outline:none;
  }
  
  .prepareandnoted
  {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 75%;
    margin-left: auto;
    margin-right: auto;
    margin-top: 50px ;
    margin-bottom: 50px;
  }
  .prepareandnoted td
  {
    text-align: center  ;
    border:none;
     outline:none;
  }
  
  .page-break {
      page-break-after: always;
  }
  </style>
<body>


  

<table class="organization" >
<tr>
 
  {{-- <td style="width:30%"><img src="{{ ($beneficiary->charitableOrganization->profile_photo)?url('upload/charitable_org/profile_photo/'.$beneficiary->charitableOrganization->profile_photo):url('upload/charitable_org/profile_photo/no_avatar.png') }}" alt="Charity Organization Profile Photo" width="100px" height="100px"></td> --}}
  <td style="text-align: center;  font-size: 150%;">{{$beneficiary->charitableOrganization->name}}</td>
</tr>
</table>

<table class="organization">
  <tr>
    <td > Date: <span style="text-decoration:underline;">{{$mytime->isoFormat('MMMM d, YYYY')}}</span>
      <br> 
      <span>Time: </span><span style="text-decoration:underline;">{{$mytime->format('g:i A');}}</span>
    </td>

  
    {{-- <td style="width:30%"><img src="  {{ ($beneficiary->profile_photo)?url('upload/charitable_org/beneficiary_photos/'. $beneficiary->profile_photo):url('upload/avatar_img/no_avatar.png') }}" alt="beneficiaries photo" width="150px" height="150px"></td> --}}

  </tr>
</table>

<table class="tableinformation">
  <tr>
    <th colspan="2">I.  Identifying Information</th>
  
  </tr>
  <tr>
    <td>Full name</td>
    <td>{{$beneficiary->last_name. ', '.$beneficiary->first_name.' '. $beneficiary->middle_name}}</td>
  
  </tr>
  <tr>
    <td>Nickname :</td>
    <td>{{$beneficiary->nick_name}}</td>
  
  </tr>
  <tr>
    <td>Date of Birth :</td>
    <td>{{Carbon\Carbon::parse($beneficiary->brith_date)->isoFormat('MMMM d, YYYY')}}</td>
  </tr>
  <tr>
    <td>Age During interview :</td>
    <td>{{ Carbon\Carbon::parse($beneficiary->birth_date)->diff(Carbon\Carbon::parse($beneficiary->interviewed_at))->y }}
    </td>

  </tr>
  <tr>
    <td>Place of Birth :</td>
    <td>{{$beneficiary->birth_place}}</td>

  </tr>
  <tr>
    <td>Religion :</td>
    <td>{{$beneficiary->religion}}</td>

  </tr>
  <tr>
    <td>Present Address :</td>
    <td>{{$beneficiary->presentAddress->region. ' '.$beneficiary->presentAddress->province
    .' '.$beneficiary->presentAddress->city.' '.$beneficiary->presentAddress->barangay
    .' '.$beneficiary->presentAddress->postal_code}}
    </td>
  </tr>

  <tr>
    <td>Permanent Address :</td>
    <td>{{$beneficiary->permanentAddress->region. ' '.$beneficiary->permanentAddress->province
        .' '.$beneficiary->permanentAddress->city.' '.$beneficiary->permanentAddress->barangay
        .' '.$beneficiary->permanentAddress->postal_code}}
        </td>
  </tr>

  <tr>
    <td>Provincal Address :</td>
    <td>{{$beneficiary->provincialAddress->region. ' '.$beneficiary->provincialAddress->province
        .' '.$beneficiary->provincialAddress->city.' '.$beneficiary->provincialAddress->barangay
        .' '.$beneficiary->provincialAddress->postal_code}}
        </td>
  </tr>

  <tr>
    <td>Educational Attainment :</td>
    <td>{{$beneficiary->educational_attainment}}</td>
  </tr>

  <tr>
    <td>Last School Attended :</td>
    <td>{{$beneficiary->last_school_year_attended}}</td>
  </tr>

  <tr>
    <td>Contact No. :</td>
    <td>{{$beneficiary->contact_no}}</td>
  </tr>

  
</table>


<table class="family">

   
        
    
    <tr>
      <th colspan="8" style="text-align: left;" >II. Family Composition</th>
    </tr>
    <tr>
        <td>Name</td>
        <td>Age</td>
        <td>Relationship</td>
        <td>Civil Status</td>
        <td>Education</td>
        <td>Occupation</td>
        <td>Income</td>
        <td>WhereAbout</td>
    </tr>
    @foreach ($beneficiary->families as $item)
   <tr>
      <td style="width: 20%">{{$item->last_name.', '.$item->first_name}}</td>
      <td>{{Carbon\Carbon::parse($item->birth_date)->age;}}</td>
      <td>{{$item->relationship}}</td>
      <td>{{$item->civil_status}}</td>
      <td>{{$item->education}}</td>
      <td>{{$item->occupation}}</td>
      <td>{{$item->income}}</td>
      <td> {{ ($item->where_abouts)? $item->where_abouts:'---' }}</td>
   </tr>
   @endforeach
  </table>


  <table class="tableinformation2">

    <tr>
      <th >III. Presented Problem  </th>  
    </tr>
    <tr>
      <td style=" padding-left: 10%;">
       {{$beneficiary->bg_info->problem_presented}}
      </td>
    </tr>


    <tr>
      <th>IV. Background Information</th>
    </tr>

    <tr>
      <th style=" padding-left: 8%;">
        A. The Client
      </th>
    </tr>
    <tr>
      <td style=" padding-left: 10%;">
        {{$beneficiary->bg_info->about_client}}
      </td>
    </tr style="margin-bottom:10px;">

    <tr>
      <th style=" padding-left: 8%;">
        B. The Family
      </th>
    </tr>
    <tr>
      <td style=" padding-left: 10%;">
        {{$beneficiary->bg_info->about_family}}
      </td>
    </tr>

    <tr>
      <th style=" padding-left: 8%;">
        C. The Environment
      </th>
    </tr>
    <tr>
      <td style=" padding-left: 10%;">
        {{$beneficiary->bg_info->about_community}}
      </td>
    </tr>


    <tr>
      <th>V. Assessment And Recommendation</th>
    </tr>
    <tr>
      <td>
        {{$beneficiary->bg_info->assessment}}
      </td>
    </tr>

  </table>

  <table class="prepareandnoted">
    <tr >
      <td>Prepared By</td>
      <td>Noted By</td>
    </tr>

    <tr>
      <td style="text-decoration: underline;">{{$beneficiary->prepared_by}}</td>
       <td style="text-decoration: underline;">{{$beneficiary->noted_by}}</td>
    </tr>
  </table>
    
  
</body>
</html>
