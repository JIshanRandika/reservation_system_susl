@extends('layouts.app')


@section('content')
<div class="card  ">
<!-- View Holiday Resort booking details from coordinator side -->
<h5 class="card-header bg-secondary text-white">Holiday Resort Booking Details</h5>
<div class="card-body ">

   <div class="mb-3">

    {!! Form::open(['url' => 'viewreghrbooking',  'method' => 'GET',  'id' => 'booking_form']) !!}


    <div class="form-group">
    {{Form::label('CheckInDate', 'Check In Date') }}
{{--    <input type="date" class="form-control" name="CheckInDate" value="{{request()->query('CheckInDate') != null ? request()->query('CheckInDate') : date('yyyy/mm/dd')}}">--}}
        <input type="date" class="form-control" name="CheckInDate" value="{{ date('Y-m-d', strtotime( request()->query('CheckInDate') ) ) != null ?  date('Y-m-d', strtotime( request()->query('CheckInDate') ) ) : date('yyyy/mm/dd')}}">

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
        <td>Create Data</td>
        <td>Guest Name</td>
        <td>Room Type </td>
        <td>Check In Date</td>
        <td>Check Out Date</td>
        <!-- <td>Number Of Units</td> -->
        <td>Request VC Approval</td>
        <td>Normal / Free</td>
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
        <!-- <td>{{ $hrbooking->NoOfUnits }}</td> -->
        @if($hrbooking->VCApproval == 0)
        <td>Not Request</td>
        @else
        <td>Requested</td>
        @endif
        <td>{{ $hrbooking->NormalOrFree }}</td>
        <td>{{ $hrbooking->Status }}</td>

        <td>
        <a class="nav-link btn btn-outline-primary " href = 'showreghr/{{ $hrbooking->BookingId }}'>View</a></br>
            @if($hrbooking->Status == 'Request Registrar Approval')
         <a class="nav-link btn btn-outline-primary " href = 'hrregconfirm/{{ $hrbooking->BookingId }}'>Approve</a></br>
        <a class="nav-link btn btn-outline-primary " href = 'hrregnotconfirm/{{ $hrbooking->BookingId }}'>Reject</a>
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
