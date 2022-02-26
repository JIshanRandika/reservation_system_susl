@extends('layouts.app')


@section('content')
<div class="card  ">
<!-- View Audio Visual Unit booking details from admin side -->
<h5 class="card-header bg-secondary text-white">Audio Visual Unit Booking Details</h5>
<div class="card-body ">

    <div class="mb-3">

    {!! Form::open(['url' => 'viewadminavubooking',  'method' => 'GET',  'id' => 'booking_form']) !!}


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
        <td>Guest  </td>
        <td>Audio Visual Unit Id </td>
        <!-- <td>EventName</td> -->
        <td>Check In Date</td>
        <td>StartTime</td>
        <td>EndTime</td>
        <td>Event Name</td>
        <td>Description</td>
        <td>Recommendation from</td>
        <!-- <td> IS Recommended </td> -->
        <td>Status</td>
        <!-- <td>Confirm</td> -->
        
        
        
        
         
    </tr>
    @foreach ($avubookings as $avubooking)
    <tr>
        <td>{{ $avubooking->BookingId  }}</td>
        <td>{{ $avubooking->created_at  }}</td>
        <td>{{ $avubooking->GuestName  }}</td>
        <td>{{ $avubooking->Type   }}</td>
        <!-- <td>{{ $avubooking->EventName }}</td> -->
        <td>{{ $avubooking->CheckInDate }}</td>
        <td>{{ $avubooking->StartTime }}</td>
        <td>{{ $avubooking->EndTime }}</td>
        <td>{{ $avubooking->EventName  }}</td>
        <td>{{ $avubooking->Description }}</td>
        <td>{{ $avubooking->name}}</td>
        
        <td>{{ $avubooking->Status }}</td>
       
        <!-- <td>
        <a href = 'avuadminconfirm/{{ $avubooking->BookingId }}'>Confirm</a>
        <a href = 'avuadminnotconfirm/{{ $avubooking->BookingId }}'>Reject</a>
        </td> -->
       
    </tr>
    @endforeach
    </table>
    {{ $avubookings->links() }}
</div>
 </div>
</div>


@endsection