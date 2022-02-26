@extends('layouts.app')


@section('content')
<div class="card  ">
<!-- View Agri Farm Dinning booking details from vc side -->
<h5 class="card-header bg-secondary text-white">View Agri Farm Dinning Room Booking Details</h5>
<div class="card-body ">

        <div class="mb-3">

        {!! Form::open(['url' => 'viewvcagridbooking',  'method' => 'GET',  'id' => 'booking_form']) !!}


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
        <td>Guest Name </td>
        <td>Check In Date</td>
        <td>StartTime</td>
        <td>EndTime</td>
        <td>Guests</td>
        <td>Description</td>
        {{-- <td>Request VC Approval</td> --}}
        <td>Status</td>
        <td>Option</td>
        
        
        
        
         
    </tr>
    @foreach ($agridbookings as $agridbooking)
    <tr>
        <td>{{ $agridbooking->BookingId  }}</td>
        <td>{{ $agridbooking->created_at  }}</td>
        <td>{{ $agridbooking->GuestName  }}</td>
        <td>{{ $agridbooking->CheckInDate }}</td>
        <td>{{ $agridbooking->StartTime }}</td>
        <td>{{ $agridbooking->EndTime }}</td>
        <td>{{ $agridbooking->NoOfGuest  }}</td>
        <td>{{ $agridbooking->Description }}</td>
        {{-- @if($agridbooking->VCApproval == 0)
        <td>Not Request</td>
        @else
        <td>Requested</td>
        @endif --}}
        <td>{{ $agridbooking->Status }}</td>
       
       
       
        <td>
        <a class="nav-link btn btn-outline-primary" href = 'showafdvc/{{ $agridbooking->BookingId }}'>View</a></br>
        @if($agridbooking->Status == 'Request Vice Chancellor Approval')
        <a class="nav-link btn btn-outline-primary" href = 'afdapprove/{{ $agridbooking->BookingId }}'>Approve</a></br>
        <a class="nav-link btn btn-outline-primary" href = 'afdnotapprove/{{ $agridbooking->BookingId }}'>Reject</a>
        @else
        
        @endif
        </td>
      
       
    
       
       
    </tr>
    @endforeach
    </table>

{{ $agridbookings->links() }}
</div>
 </div>
</div>


@endsection