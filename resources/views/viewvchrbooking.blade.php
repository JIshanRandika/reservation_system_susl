@extends('layouts.app')


@section('content')
<div class="card">
<!-- View Holiday Resort booking details from vc side -->
<h5 class="card-header bg-secondary text-white">Holiday Resort Booking Details</h5>
<div class="card-body ">

        <div class="mb-3">

    {!! Form::open(['url' => 'viewvchrbooking',  'method' => 'GET',  'id' => 'booking_form']) !!}


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
        <td>Id </td>
        <td>Create Date </td>
        <td>Guest Name </td>
        <td>Room Type </td>
        <td>Check In Date</td>
        <td>Check Out Date</td>
        <td>Units</td>
        {{-- <td>Request VC Approval</td> --}}
        <td>Status</td>
        <td>Option</td>
        
     
         
    </tr>
    @foreach ($hrbookings as $hrbooking)
    <tr>
        <td>{{ $hrbooking->BookingId  }}</td>
        <td>{{ $hrbooking->created_at  }}</td>
        <td>{{ $hrbooking->GuestName  }}</td>
        <td>{{ $hrbooking->Type }}</td>
        <td>{{ $hrbooking->CheckInDate }}</td>
        <td>{{ $hrbooking->CheckOutDate }}</td>
        <td>{{ $hrbooking->NoOfUnits }}</td>
        {{-- @if($hrbooking->VCApproval == 0)
        <td>Not Request</td>
        @else
        <td>Requested</td>
        @endif --}}
        
        <td>{{ $hrbooking->Status }}</td>
       

       
        <td>
        <a class="nav-link btn btn-outline-primary" href = 'showhrvc/{{ $hrbooking->BookingId }}'>View</a></br>
        @if($hrbooking->Status == 'Request Vice Chancellor Approval')
        <a class="nav-link btn btn-outline-primary" href = 'hrapprove/{{ $hrbooking->BookingId }}'>Approve</a></br>
        <a class="nav-link btn btn-outline-primary" href = 'hrnotapprove/{{ $hrbooking->BookingId }}'>Reject</a>
        @else
        
        @endif
        </td>
      
        
       
       
    </tr>
    @endforeach
    </table>

{{ $hrbookings->links() }}

</div>
 </div>
</div>


@endsection