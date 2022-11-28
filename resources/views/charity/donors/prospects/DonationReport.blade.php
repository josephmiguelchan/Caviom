<!DOCTYPE html>
<html>
<head>
  <title>Organization Donation Report</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>

<style>
  body{
    font-family: Helvetica, Arial, sans-serif;
  }
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
      <td style="width:30%"><img src="{{ (Auth::user()->charity->profile_photo)?url('upload/charitable_org/profile_photo/'.Auth::user()->charity->profile_photo):url('upload/charitable_org/profile_photo/no_avatar.png') }}" alt="Charity Organization Profile Photo" width="100px" height="100px"></td>
    </tr>
  </table>

  <h1>{{Auth::user()->charity->name}}</h1>
  <p style="text-align: center">{{ Carbon\Carbon::parse($date_start)->isoFormat('ll') . ' to ' .  Carbon\Carbon::parse($date_end)->isoFormat('ll') }}</p>
  <table>


    <tr>
      <th>#</th>
      <th>Amount</th>
      <th>Method</th>
      <th>Action</th>
      <th>Running Balance</th>
      <th>Payment Datetime</th>
      <th>Datetime Added</th>
    </tr>
    @if ($trail->count() == 0)
      <tr>
        <td colspan="7" style="text-align: center">No data recorded.</td>
      </tr>
    @endif
    @foreach ($trail as $key => $item)
    <tr {!! ($item->amount <0) ? 'style="color: red"' : ''!!}>
      <td>{{$key+1}}</td>
      <td>P {{number_format($item->amount,2)}}</td>
      <td>{{$item->mode_of_payment}}</td>
      <td>{{$item->action}}</td>
      <td>P {{number_format($item->running_balance,2)}}</td>
      <td>{{Carbon\Carbon::parse($item->paid_at)->isoFormat('lll')}}</td>
      <td>{{Carbon\Carbon::parse($item->created_at)->isoFormat('lll')}}</td>
    </tr>
    @endforeach
  </table>

  <h3>Cash Inflow </h3>
  <h3>As of [{{Carbon\Carbon::now()->isoFormat('LL')}}]</h3>

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
      <td>P {{number_format($donations[$key], 2)}}</td>
      <td>P {{number_format($deductions[$key], 2)}}</td>
      <td>P {{number_format($subtotal[$key], 2)}}</td>
    </tr>
    @endforeach

    @if ($cashinflow == null)
    <tr>
      <td style="text-align:center" colspan="5"><strong>No records found.</strong></td>
    </tr>
    @else
    <tr>
      <td style="text-align:end"><strong>TOTAL</strong></td>
      <td colspan="3"></td>
      <td>P {{number_format(array_sum($subtotal), 2)}}</td>
    </tr>
    @endif
  </table>

  <br>
  <h5>Downloaded by: {{Auth::user()->info->last_name.', ' .Auth::user()->info->first_name }} | {{'@'.Auth::user()->username}}</h5>
  <h5>Date and time: {{Carbon\Carbon::parse($mytime)->isoFormat('LL (h:mm A)')}}</h5>




</body>
</html>