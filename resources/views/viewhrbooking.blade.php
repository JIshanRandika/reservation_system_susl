@extends('layouts.app')


@section('content')
<div class="card  ">

<!-- View Holiday Resort booking details from coordinator side -->
<h5 class="card-header bg-secondary text-white">Holiday Resort Booking Details</h5>
<div class="card-body ">

   <div class="mb-3">

    {!! Form::open(['url' => 'viewhrbooking',  'method' => 'GET',  'id' => 'booking_form']) !!}


    <div class="form-group">
    {{Form::label('CheckInDate', 'Start Date') }}
        <input type="date" class="form-control" name="CheckInDate" value="{{ date('Y-m-d', strtotime( request()->query('CheckInDate') ) ) != null ?  date('Y-m-d', strtotime( request()->query('CheckInDate') ) ) : date('yyyy/mm/dd')}}">

    </div>

    <div class="form-group">
        {{Form::label('CheckOutDate', 'End Date') }}
        <input type="date" class="form-control" name="CheckOutDate" value="{{ date('Y-m-d', strtotime( request()->query('CheckOutDate') ) ) != null ?  date('Y-m-d', strtotime( request()->query('CheckOutDate') ) ) : date('yyyy/mm/dd')}}">

        </div>
    </br>
    {{Form::submit('Submit', ['class'=>'btn btn-primary', 'v-on:click'=>'formSubmit'])}}
    </div>
    {!! Form::close() !!}
    <div class="btn-group" style="width:100%">
    <a class="nav-link btn btn-outline-primary " href="/download-hrpdf?CheckInDate={{request()->CheckInDate}}&CheckOutDate={{request()->CheckOutDate}}">Generate Deatils</a></br>
    <a class="nav-link btn btn-outline-primary " href="/download-hrmonthpdf?CheckInDate={{request()->CheckInDate}}">Generate Monthly Details </a></br>
    <a class="nav-link btn btn-outline-primary " href="/download-hryearpdf?CheckInDate={{request()->CheckInDate}}">Generate Year Details </a></br>
</div>

    </div>

<div class="table-responsive">
    <table border = "1" class="table table-striped">
    <tr>
        <td>Booking Id </td>
        <td>Create Date</td>
        <td>Guest Name</td>
        <td>Room Type </td>
        <td>Check In Date</td>
        <td>Check Out Date</td>
        <td>Number Of Units</td>
        <td>Status</td>
        <td>Option</td>





    </tr>
    @foreach ($hrbookings as $hrbooking)
    <tr>
        <td>{{ $hrbooking->BookingId  }}</td>
        <td>{{ $hrbooking->created_at  }}</td>
        <td>{{ $hrbooking->GuestName  }}</td>
        <td>{{ $hrbooking->Type   }}</td>
        <td>{{ $hrbooking->CheckInDate }}</td>
        <td>{{ $hrbooking->CheckOutDate }}</td>
        <td>{{ $hrbooking->NoOfUnits }}</td>


        <td>{{ $hrbooking->Status }}</td>

        <td>
        <a class="nav-link btn btn-outline-primary " href = 'showhr/{{ $hrbooking->BookingId }}'>View</a></br>

         <a class="nav-link btn btn-outline-primary " href = 'showrechr/{{ $hrbooking->BookingId }}'>HOD Approval</a></br>
        <a class="nav-link btn btn-outline-primary " href = 'showvchr/{{ $hrbooking->BookingId }}'>VC Approval</a></br>
        <!-- <a href = 'hrregapprove/{{ $hrbooking->BookingId }}'>Registrar Approval </a></br> -->

                <a class="nav-link btn btn-outline-primary " href = 'hrconfirm/request-payment/{{ $hrbooking->BookingId }}'>Request Payment</a></br>
        <a class="nav-link btn btn-outline-primary " href = 'hrconfirm/{{ $hrbooking->BookingId }}'>Confirm</a></br>
        <a class="nav-link btn btn-outline-primary " href = 'hrnotconfirm/{{ $hrbooking->BookingId }}'>Reject</a></br>


        </td>


    </tr>
    @endforeach
    </table>

{{ $hrbookings->links() }}
</div>
 </div>
</div>


@endsection
