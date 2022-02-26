@extends('layouts.app')


@section('content')
<div class="card  ">
<!-- View Audio Visual Unit booking details from coordinator side -->
<h5 class="card-header bg-secondary text-white">Audio Visual Unit Booking Details</h5>
<div class="card-body ">

   <div class="mb-3">

    {!! Form::open(['url' => 'viewavubooking',  'method' => 'GET',  'id' => 'booking_form']) !!}


    <div class="form-group">
    {{Form::label('CheckInDate', 'Date') }}
    <input type="date" class="form-control" name="CheckInDate" value="{{request()->query('CheckInDate') != null ? request()->query('CheckInDate') : date('yyyy/mm/dd')}}">

    </div>


    </br>
    {{Form::submit('Submit', ['class'=>'btn btn-primary', 'v-on:click'=>'formSubmit'])}}
    </div>
    {!! Form::close() !!}
    <div class="btn-group" style="width:100%">
    <a class="nav-link btn btn-outline-primary " href="/download-avupdf?CheckInDate={{request()->CheckInDate}}">Generate Deatils</a></br>
    <a class="nav-link btn btn-outline-primary " href="/download-avumonthpdf?CheckInDate={{request()->CheckInDate}}">Generate Monthly Details </a></br>
    <a class="nav-link btn btn-outline-primary " href="/download-avuyearpdf?CheckInDate={{request()->CheckInDate}}">Generate Year Details </a></br>
</div>

    </div>

<div class="table-responsive">
    <table border = "1" class="table table-striped">
    <tr>
        <td>Id </td>
        <td>Create Date </td>
        <td>Guest  </td>
        <td>Service </td>
        <!-- <td>EventName</td> -->
        <td>Check In Date</td>
        <td>StartTime</td>
        <td>EndTime</td>
        <td>Event Name</td>
        <td>Description</td>
        {{-- <td>Recommendation </td> --}}
        <!-- <td> IS Recommended </td> -->
        <td>Status</td>
        <td>Confirm</td>
        
        
        
        
         
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
        {{-- <td>{{ $avubooking->name}}</td> --}}
        
        <td>{{ $avubooking->Status }}</td>
       
        <td>
        
       
        <a class="nav-link btn btn-outline-primary" href = 'showrecavu/{{ $avubooking->BookingId }}'>HOD Approval</a></br>
        <a class="nav-link btn btn-outline-primary" href = 'avuconfirm/{{ $avubooking->BookingId }}'>Confirm</a></br>
        <a class="nav-link btn btn-outline-primary" href = 'avunotconfirm/{{ $avubooking->BookingId }}'>Reject</a>
        </td>
       
    </tr>
    @endforeach
    </table>

{{ $avubookings->links() }}
</div>
 </div>
</div>


@endsection