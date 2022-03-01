@extends('layouts.app')


@section('content')
<div class="card p-3 mb-2 ">
<!-- View Agri Farm booking details from admin side -->
<h5 class="card-header bg-secondary text-white">Agri Farm Kabana Booking Details</h5>
<div class="card-body ">



            <div class="mb-3">

                    {!! Form::open(['url' => 'viewadminagribooking',  'method' => 'GET',  'id' => 'booking_form']) !!}


                    <div class="form-group">
                    {{Form::label('CheckInDate', 'Check In Date') }}
                        <input type="date" class="form-control" name="CheckInDate" value="{{ date('Y-m-d', strtotime( request()->query('CheckInDate') ) ) != null ?  date('Y-m-d', strtotime( request()->query('CheckInDate') ) ) : date('yyyy/mm/dd')}}">

                    </div>


                    </br>
                    {{Form::submit('Submit', ['class'=>'btn btn-primary', 'v-on:click'=>'formSubmit'])}}
                    </div>
                    {!! Form::close() !!}

             </div>


    <table border = "1" class="table table-striped">
    <tr>
        <td>Booking Id </td>
        <td>Create Date </td>
        <td>Guest Name </td>
        <td>Check In Date</td>
        <td>Check Out Date</td>
        <td>Number Of Unit</td>
        <!-- <td>Request VC Approval</td> -->
        <td>Status</td>
        <td>Option</td>

    </tr>
    @foreach ($agrsbookings as $agrsbooking)
    <tr>
        <td>{{ $agrsbooking->BookingId  }}</td>
        <td>{{ $agrsbooking->GuestName  }}</td>
        <td>{{ $agrsbooking->GuestName  }}</td>
        <td>{{ $agrsbooking->CheckInDate }}</td>
        <td>{{ $agrsbooking->CheckOutDate }}</td>
        <td>{{ $agrsbooking->NoOfUnits }}</td>
        <!-- @if($agrsbooking->VCApproval == 0)
        <td>Not Request</td>
        @else
        <td>Requested</td>
        @endif -->

        <td>{{ $agrsbooking->Status }}</td>

        <td>
        <a href = 'showadminaf/{{ $agrsbooking->BookingId }}'>View</a></br>
        <!-- <a href = 'afadminconfirm/{{ $agrsbooking->BookingId }}'>Confirm</a></br>
        <a href = 'afadminnotconfirm/{{ $agrsbooking->BookingId }}'>Reject</a>
        -->
        </td>
    </tr>
    @endforeach
    </table>

    {{ $agrsbookings->links() }}


 </div>
</div>


@endsection
