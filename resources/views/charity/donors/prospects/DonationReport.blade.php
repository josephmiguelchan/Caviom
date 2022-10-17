<!DOCTYPE html>
<html>
<head>
  <title>Organization Donation Report</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>

<style>
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 90%;
    margin-left: auto;
    margin-right: auto;
    font-size: 11px;
  }

  td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }

  tr:nth-child(odd) {
    background-color: #dbe2cf;
  }



  .orglogo
  {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 90%;
    margin-left: auto;
    margin-right: auto;
  }
  .orglogo td
  {
    text-align: center  ;
    border:none;
     outline:none;
  }
  h1{
    text-align: center;
  }
  h3
  {
    width: 90%;
    margin-left: auto;
    margin-right: auto;
    margin-top: 30px;
  }
  h5
  {
    width: 90%;
    margin-left: auto;
    margin-right: auto;
  }
</style>

<body>

  <table class="orglogo" >
    <tr style="background-color: white">

        {{-- <td style="width:30%"><img src="{{ (Auth::user()->charity->profile_photo)?url('upload/charitable_org/profile_photo/'.Auth::user()->charity->profile_photo):url('upload/charitable_org/profile_photo/no_avatar.png') }}" alt="Charity Organization Profile Photo" width="100px" height="100px"></td> --}}

    </tr>
  </table>

  <h1>{{Auth::user()->charity->name}}</h1>
  <table>


    <tr>
      <th>#</th>
      <th>Amount</th>
      <th>Method</th>
      <th>Action</th>
      <th>Running Balance</th>
      <th>Date and Time</th>
      </tr>
    @foreach ($trail as $key => $item)



    <tr {!! ($item->amount <0) ? 'style="color: red"' : ''!!}>
      <td>{{$key+1}}</td>
      <td>₱ {{number_format($item->amount,2)}}</td>
      <td>{{$item->mode_of_payment}}</td>
      <td>{{$item->action}}</td>
      <td>₱ {{number_format($item->running_balance,2)}}</td>
      <td>{{Carbon\Carbon::parse($item->created_at)->isoFormat('lll')}}</td>
    </tr>
    @endforeach
  </table>

  <h3>Cash Inflow </h3>
  <h3>As of [{{Carbon\Carbon::parse($mytime)->isoFormat('LL')}}]</h3>

<!--Cash Inflow-->
  <table>
    <tr>
      <th>#</th>
      <th>Method</th>
      <th>Donations</th>
      <th>Deductions</th>
      <th>Subtotal</th>
    </tr>

    @foreach ($cashinflow as $key => $method)
    <tr>
      <td>{{$key+1}}</td>
      <td>{{$method}}</td>
      <td>₱ {{number_format($donations[$key], 2)}}</td>
      <td>₱ {{number_format($deductions[$key], 2)}}</td>
      <td>₱ {{number_format($subtotal[$key], 2)}}</td>
    </tr>
    @endforeach

    <tr>
      <td style="text-align:end"><strong>TOTAL</strong></td>
      <td colspan="3"></td>
      <td>₱ {{array_sum($subtotal)}}</td>
    </tr>
  </table>

  <br>
  <h5>Downloaded by: {{Auth::user()->info->last_name.', ' .Auth::user()->info->first_name }} | {{'@'.Auth::user()->username}}</h5>
  <h5>Date and time: {{Carbon\Carbon::parse($mytime)->isoFormat('LL (h:mm A)')}}</h5>




</body>
</html>