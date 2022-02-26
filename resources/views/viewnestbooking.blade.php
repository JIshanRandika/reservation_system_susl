@extends('layouts.app')


@section('content')
<div class="card  ">
<!-- View Nest booking details from coordinator side -->
<h5 class="card-header bg-secondary text-white">Nest Booking Details</h5>
<div class="card-body ">


   <div class="mb-3">

    
    {!! Form::open(['url' => 'viewnestbooking',  'method' => 'GET',  'id' => 'booking_form']) !!}


    <div class="form-group">
    {{Form::label('CheckInDate', 'Start Date') }}
    <input type="date" class="form-control" name="CheckInDate" value="{{request()->query('CheckInDate') != null ? request()->query('CheckInDate') : date('yyyy/mm/dd')}}">

    </div>


    </br>

    <div class="form-group">
        {{Form::label('CheckOutDate', 'End Date') }}
        <input type="date" class="form-control" name="CheckOutDate" value="{{request()->query('CheckOutDate') != null ? request()->query('CheckOutDate') : date('yyyy/mm/dd')}}">
    
        </div>
    
    
        </br>
        <div class="center">
    {{Form::submit('Submit', ['class'=>'btn btn-primary', 'v-on:click'=>'formSubmit'])}}
    </div>
    {!! Form::close() !!}
    </div>
   
    <div class="btn-group" style="width:100%">
    <a class="nav-link btn btn-outline-primary " href="/download-pdf?CheckInDate={{request()->CheckInDate}}&CheckOutDate={{request()->CheckOutDate}}">Generate Deatils</a></br>
    <a class="nav-link btn btn-outline-primary " href="/download-monthpdf?CheckInDate={{request()->CheckInDate}}">Generate Monthly Details </a></br>
    <a class="nav-link btn btn-outline-primary " href="/download-yearpdf?CheckInDate={{request()->CheckInDate}}">Generate Year Details </a></br>
    </div>
</div>
<div class="table-responsive">
    <table border = "1" class="table table-striped">
    <tr>
        <td>Booking Id </td>
        <td>Create Date </td>
        <td>Guest Name</td>
        {{-- <td>Room Type </td> --}}
        <td>Check In Date</td>
        <td>Check Out Date</td>
        <!-- <td>Number Of Adults</td>
        <td>Number Of Children</td> -->
        <!-- <td>Number Of Units</td> -->
        <!-- <td>Guest Tye</td>
        <td>Description</td> -->
        {{-- <td>Request VC Approval</td> --}}
        <td>Status</td>
        <td>Option</td>
        
        
        
        
         
    </tr>
    @foreach ($nestbookings as $nestbooking)
    <tr>
        <td>{{ $nestbooking->BookingId  }}</td>
        <td>{{ $nestbooking->created_at  }}</td>
        <td>{{ $nestbooking->GuestName  }}</td>
        {{-- <td>{{ $nestbooking->Type    }}</td> --}}
        <td>{{ $nestbooking->CheckInDate }}</td>
        <td>{{ $nestbooking->CheckOutDate }}</td>
        <!-- <td>{{ $nestbooking->NoOfAdults }}</td>
        <td>{{ $nestbooking->NoOfChildren  }}</td> -->
        <!-- <td>{{ $nestbooking->NoOfUnits }}</td> -->
        <!-- <td>{{ $nestbooking->BookingType }}</td>
        <td>{{ $nestbooking->Description }}</td> -->
        {{-- @if($nestbooking->VCApproval == 0)
        <td>Not Request</td>
        @else
        <td>Requested</td>
        @endif --}}
        .
        <td>{{ $nestbooking->Status }}</td>
       
        <td>
        <a class="nav-link btn btn-outline-primary " href = 'shownest/{{ $nestbooking->BookingId }}'>View</a></br>
        <a class="nav-link btn btn-outline-primary " href = 'showrecnest/{{ $nestbooking->BookingId }}'>Recommendation</a></br>
        <a class="nav-link btn btn-outline-primary " href = 'showvcnest/{{ $nestbooking->BookingId }}'>VC Approval</a></br>
        <!-- <a href = 'nestregapprove/{{ $nestbooking->BookingId }}'>Registrar Approval</a></br> -->

            <a class="nav-link btn btn-outline-primary " href = 'nestconfirm/request-payment/{{ $nestbooking->BookingId }}'>Request Payment</a></br>
            <a class="nav-link btn btn-outline-primary " href = 'nestconfirm/{{ $nestbooking->BookingId }}'>Confirm</a></br>
        <a class="nav-link btn btn-outline-primary " href = 'nestnotconfirm/{{ $nestbooking->BookingId }}'>Reject</a></br>
        

        </td>
       
       
    </tr>
    @endforeach
    </table>
    {{ $nestbookings->links() }}

</div>
 </div>
</div>


@endsection