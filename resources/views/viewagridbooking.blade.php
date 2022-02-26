@extends('layouts.app')


@section('content')
<div class="card  ">
<!-- View Agri Farm Dinning Room booking details from coordinator side -->
<h5 class="card-header bg-secondary text-white">View Agri Farm Dinning Room Booking Details</h5>
<div class="card-body ">

   <div class="mb-3">

    {!! Form::open(['url' => 'viewagridbooking',  'method' => 'GET',  'id' => 'booking_form']) !!}


    <div class="form-group">
    {{Form::label('CheckInDate', 'Date') }}
    <input type="date" class="form-control" name="CheckInDate" value="{{request()->query('CheckInDate') != null ? request()->query('CheckInDate') : date('yyyy/mm/dd')}}">

    </div>


    </br>
    {{Form::submit('Submit', ['class'=>'btn btn-primary', 'v-on:click'=>'formSubmit'])}}
    </div>
    {!! Form::close() !!}
    <div class="btn-group" style="width:100%">
    <a class="nav-link btn btn-outline-primary " href="/download-agridpdf?CheckInDate={{request()->CheckInDate}}">Generate Deatils</a></br>
    <a class="nav-link btn btn-outline-primary " href="/download-agridmonthpdf?CheckInDate={{request()->CheckInDate}}">Generate Monthly Details </a></br>
    <a class="nav-link btn btn-outline-primary " href="/download-agridyearpdf?CheckInDate={{request()->CheckInDate}}">Generate Year Details </a></br>
</div>
    </div>

<div class="table-responsive">
    <table border = "1" class="table table-striped">
    <tr>
        <td>Booking Id </td>
        <td>Create Date </td>
        <td>Guest Name </td>
        <td>Check In Date</td>
        <td>StartTime</td>
        <td>EndTime</td>
        <!-- <td>Description</td> -->
        {{-- <td>Recommendation from</td> --}}
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
        <!-- <td>{{ $agridbooking->Description }}</td> -->
        {{-- <td>{{ $agridbooking->name }}</td> --}}
        
        <td>{{ $agridbooking->Status }}</td>
       
        <td>
        <a class="nav-link btn btn-outline-primary" href = 'show/{{ $agridbooking->BookingId }}'>View</a></br>
        <a class="nav-link btn btn-outline-primary" href = 'showrecagrid/{{ $agridbooking->BookingId }}'>HOD Approval</a></br>
        <a class="nav-link btn btn-outline-primary" href = 'showvcagrid/{{ $agridbooking->BookingId }}'>VC Approval</a></br>
        <a class="nav-link btn btn-outline-primary" href = 'afdconfirm/request-payment/{{ $agridbooking->BookingId }}'>Request Payment</a></br>
        <a class="nav-link btn btn-outline-primary" href = 'afdconfirm/{{ $agridbooking->BookingId }}'>Confirm</a></br>
        <a class="nav-link btn btn-outline-primary" href = 'afdnotconfirm/{{ $agridbooking->BookingId }}'>Reject</a>
        </td>
       
    </tr>
    @endforeach
    </table>
    {{ $agridbookings->links() }}
</div>
 </div>
</div>


@endsection