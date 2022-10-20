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
    <td > Date: <span style="text-decoration:underline;">{{$mytime->isoFormat('MMMM D, YYYY')}}</span>
      <br>
      <span>Time: </span><span style="text-decoration:underline;">{{$mytime->format('g:i A');}}</span>
    </td>


    {{-- <td style="width:30%"><img src="{{ url('upload/charitable_org/beneficiary_photos/blank.png) }}" alt="insert photo" width="150px" height="150px"></td> --}}

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
    <td>{{Carbon\Carbon::parse($beneficiary->brith_date)->isoFormat('MMMM D, YYYY')}}</td>
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
    <td></td>

  </tr>
  <tr>
    <td>Present Address :</td>
    <td>
    </td>
  </tr>

  <tr>
    <td>Permanent Address :</td>
    <td>

    </td>
  </tr>

  <tr>
    <td>Provincal Address :</td>
    <td>
    </td>
  </tr>

  <tr>
    <td>Educational Attainment :</td>
    <td></td>
  </tr>

  <tr>
    <td>Last School Attended :</td>
    <td></td>
  </tr>

  <tr>
    <td>Contact No. :</td>
    <td></td>
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
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
   </tr>
   @endforeach

   <tr >
      <td style="width: 20%;height: 60px" ></td>
      <td style="height: 20px"></td>
      <td style="height: 20px"></td>
      <td style="height: 20px"></td>
      <td style="height: 20px"></td>
      <td style="height: 20px"></td>
      <td style="height: 20px"></td>
      <td style="height: 20px"></td>
   </tr>

   <tr >
    <td style="width: 20%;height: 60px"></td>
    <td style="height: 20px"></td>
    <td style="height: 20px"> </td>
    <td style="height: 20px"> </td>
    <td style="height: 20px"></td>
    <td style="height: 20px"></td>
    <td style="height: 20px"></td>
    <td style="height: 20px"></td>
    </tr>

    <tr  >
      <td style="width: 20%;height: 60px"></td>
      <td style="height: 20px"></td>
      <td style="height: 20px"></td>
      <td style="height: 20px"></td>
      <td style="height: 20px"></td>
      <td style="height: 20px"></td>
      <td style="height: 20px"></td>
      <td style="height: 20px"></td>
    </tr>






  </table>


  <table class="tableinformation2">

    <tr>
      <th >III. Presented Problem  </th>
    </tr>
    <tr>
      <td style=" padding-left: 10%;">

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
      <td style=" padding-left: 10%;height:60px; ">

      </td>
    </tr style="margin-bottom:10px;">

    <tr>
      <th style=" padding-left: 8%;">
        B. The Family
      </th>
    </tr>
    <tr>
      <td style=" padding-left: 10%;height:60px;">

      </td>
    </tr>

    <tr>
      <th style=" padding-left: 8%;">
        C. The Environment
      </th>
    </tr>
    <tr>
      <td style=" padding-left: 10%; height:60px;">

      </td>
    </tr>


    <tr>
      <th>V. Assessment And Recommendation</th>
    </tr>
    <tr>
      <td style="height:60px">

      </td>
    </tr>

  </table>

  <table class="prepareandnoted">
    <tr >
      <td>Prepared By</td>
      <td>Noted By</td>
    </tr>

    <tr>
     <td>_______________</td>
     <td>_______________</td>
    </tr>
  </table>


</body>
</html>
