<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,
            initial-scale=1, shrink-to-fit=no">
        <title>
           Events Ticket
        </title>
    </head>
    <style>
        * {
          box-sizing: border-box;
        }
        

        .column {
          float: left;
          width: 100%;
          padding: 5px;
        }
        
        
        table {
          border-collapse: collapse;
          border-spacing: 0;
          width: 100%;
          border: 1px solid #ddd;
          background-color: #f7f3ea;
          margin-bottom: 10px;
          font-family: arial, sans-serif;

        }
        
        th, td {
          padding: 10px;
          color: #62896d;
        
        }
        
        </style>

    <body>
        <div class="row">   
          
          <div class="column">
            @php ($i=1)
        
            @foreach ($tickets as $key=> $ticket)
            <table>
              <tr>
                <th style="padding-left: 30%;">{{ $ticket->GiftGiving->name }}</th>
                </tr>
              <tr>
                <tr>
                    <th style="padding-left: 30%;">{{ $ticket->GiftGiving->venue }}</th>
                </tr>
            
                <tr>   
                    <td>{{ $ticket->name }}</td>
                    <td> Ticket No. {{ $ticket->ticket_no }}</td>
               </tr>
              <tr>
                <td>{{ Carbon\Carbon::parse($ticket->GiftGiving->start_at)->isoFormat('LL (h:m A)') }}</td>
                <td>Batch no. {{ $ticket->GiftGiving->batch_no}}</td>
                 </tr>
            </table>
            @if ($i % 5 === 0)
            <div style="page-break-after: always;"></div>
            @endif
       
            @php ($i++)
            @endforeach
          </div>
           
        </div>

      
    </body>
</html>