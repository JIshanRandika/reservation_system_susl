@extends('layouts.app')


@section('content')
<div class="card  ">
<!-- View Nest booking details from coordinator side -->
<h5 class="card-header bg-secondary text-white">Nest Booking Details</h5>
<div class="card-body ">


   <div class="mb-3">

    {!! Form::open(['url' => 'viewregnestbooking',  'method' => 'GET',  'id' => 'booking_form']) !!}


    <div class="form-group">
    {{Form::label('CheckInDate', 'Check In Date') }}
    <input type="date" class="form-control" name="CheckInDate" value="{{request()->query('CheckInDate') != null ? request()->query('CheckInDate') : date('yyyy/mm/dd')}}">

    </div>


    </br>
    {{Form::submit('Submit', ['class'=>'btn btn-primary', 'v-on:click'=>'formSubmit'])}}
    </div>
    {!! Form::close() !!}

    </div>
<div class="table-responsive">
    <table  class="table table-striped">
    <tr>
        <td>Booking Id </td>
        <td>Create Date </td>
        <td>Guest Name</td>
        <td>Room Type </td>
        <td>Check In Date</td>
        <td>Check Out Date</td>
        <!-- <td>Number Of Adults</td>
        <td>Number Of Children</td> -->
        <!-- <td>Number Of Units</td> -->
        <!-- <td>Guest Tye</td>
        <td>Description</td> -->
        <td>Request VC Approval</td>
        <td>Status</td>
        <td>Option</td>
        
        
        
        
         
    </tr>
    @foreach ($nestbookings as $nestbooking)
    <tr>
        <td>{{ $nestbooking->BookingId  }}</td>
        <td>{{ $nestbooking->created_at  }}</td>
        <td>{{ $nestbooking->GuestName  }}</td>
        <td>{{ $nestbooking->Type    }}</td>
        <td>{{ $nestbooking->CheckInDate }}</td>
        <td>{{ $nestbooking->CheckOutDate }}</td>
        <!-- <td>{{ $nestbooking->NoOfAdults }}</td>
        <td>{{ $nestbooking->NoOfChildren  }}</td> -->
        <!-- <td>{{ $nestbooking->NoOfUnits }}</td> -->
        <!-- <td>{{ $nestbooking->BookingType }}</td>
        <td>{{ $nestbooking->Description }}</td> -->
        @if($nestbooking->VCApproval == 0)
        <td>Not Request</td>
        @else
        <td>Requested</td>
        @endif
        
        <td>{{ $nestbooking->Status }}</td>
       
        <td>
        <a href = 'showregnest/{{ $nestbooking->BookingId }}'>View</a></br>
        <!-- <a href = 'nestregconfirm/{{ $nestbooking->BookingId }}'>Approve</a></br>
        <a href = 'nestregnotconfirm/{{ $nestbooking->BookingId }}'>Reject</a>
        -->
        </td>
       
       
    </tr>
    @endforeach
    </table>
    {{ $nestbookings->links() }}

</div>
 </div>
</div>


@endsection