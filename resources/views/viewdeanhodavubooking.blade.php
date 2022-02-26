@extends('layouts.app')


@section('content')
<div class="card  ">
<!-- View Audio Visual Unit booking details from dean/hod side -->
<h5 class="card-header bg-secondary text-white">Audio Visual Unit Booking Details</h5>
<div class="card-body ">

   <div class="mb-3">

    {!! Form::open(['url' => 'viewdeanhodavubooking',  'method' => 'GET',  'id' => 'booking_form']) !!}


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
        <td>Audio Visual Unit  </td>
        <!-- <td>EventName</td> -->
        <td>Check In Date</td>
        <td>StartTime</td>
        <td>EndTime</td>
        <td>Event Name</td>
        <td>Description</td>
        <td>Status</td>
        <td>Confirm</td>
        
        
        
        
         
    </tr>
    @foreach ($avubookings as $avubooking)
    <tr>
        <td>{{ $avubooking->BookingId  }}</td>
        <td>{{ $avubooking->created_at  }}</td>
        <td>{{ $avubooking->GuestName }}</td>
        <td>{{ $avubooking->Type   }}</td>
        <!-- <td>{{ $avubooking->EventName }}</td> -->
        <td>{{ $avubooking->CheckInDate }}</td>
        <td>{{ $avubooking->StartTime }}</td>
        <td>{{ $avubooking->EndTime }}</td>
        <td>{{ $avubooking->EventName  }}</td>
        <td>{{ $avubooking->Description }}</td>
        <td>{{ $avubooking->Status }}</td>
       
        <td>
        <a class="nav-link btn btn-outline-primary" href = 'showavudean/{{ $avubooking->BookingId }}'>View</a></br>
        <a class="nav-link btn btn-outline-primary"href = 'avurecommend/{{ $avubooking->BookingId }}'>Recommend</a> </br>
        <a class="nav-link btn btn-outline-primary"  href = 'avunnotrecommend/{{ $avubooking->BookingId }}'>Reject</a>
        </td>
       
    </tr>
    @endforeach
    </table>

{{ $avubookings->links() }}

</div>
 </div>
</div>


@endsection