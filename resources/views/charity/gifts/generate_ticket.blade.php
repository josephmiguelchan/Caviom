<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,
            initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href=
    "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity=
    "sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
            crossorigin="anonymous">

        <link rel="stylesheet" href=
    "https://use.fontawesome.com/releases/v5.4.1/css/all.css"
            integrity=
    "sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz"
             crossorigin="anonymous">

        <title>
           Events Ticket
        </title>
    </head>
    <style>
        h6
        {
           color: #96a0a5;
        }
        h3
        {
            color: #b7af92;
        }
        p{
            caret-color: white;
        }
        span{
          color:#b7af92 ;
        }


    </style>


    <body>

        <div class="container mt-5 ms-5 " >



            <div class="row">


                <div class="col-lg-8 mb-4">
                    @php ($i=1)

                     @foreach ($tickets as $key=> $ticket)
                    <div class="card" >

                        <div class="card-body"  style="background-color: #48617d;">

                            <div class="col-12">
                                <div class="row" >
                                    <div class="col-md-12" >
                                        <h6 class="card-title">Event : <span>{{ $ticket->GiftGiving->name }}</span>    <span style="margin-left: 5%;position:fixed;">Ticket No: {{ $ticket->ticket_no }}</span>   </h6>
                                        <h6 class="card-title ">Name: <span>{{ $ticket->name }}</span><span class="mt-5"><span style="margin-left: 5%;position:fixed;">Batch No. {{ $ticket->GiftGiving->batch_no}}</span> </h6>
                                        <h6 class="card-title ">Date &Time: <span>{{ $ticket->GiftGiving->start_at }}</span></h6>
                                        <h6 class="card-title ">Venue: <span> {{ $ticket->GiftGiving->venue }}</span></h6>

                                    </div>

                                    {{-- <div class="col-6 text-center mt-3" style=" border-left-style: dashed; border-color: #b7af92;">
                                            <span >Ticket No. {{ $ticket->ticket_no }}</span>

                                            <span class="mt-5">Batch No: {{ $ticket->GiftGiving->batch_no}} </span>
                                    </div> --}}
                                </div>
                            </div>
                        </div>

                        <!--Set limitation of printing only 5 ticket per page-->
                        @if ($i % 5 === 0)
                        <div style="page-break-after: always;"></div>
                        @endif
                    </div>
                    @php ($i++)
                @endforeach

                </div>



            </div>

        </div>



        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous">
         </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
                integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                crossorigin="anonymous">
        </script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                crossorigin="anonymous">
        </script>
    </body>
</html>