@extends('layouts.app')


@section('content')
<div class="card  ">
<!-- View Nest booking details from coordinator side -->
<h5 class="card-header bg-secondary text-white">Nest Booking Details</h5>
<div class="card-body ">


   <div class="mb-3">

    {!! Form::open(['url' => 'viewreportnestbooking',  'method' => 'GET',  'id' => 'booking_form']) !!}


    <div class="form-group">
    {{Form::label('CheckInDate', 'Start Date') }}
    <input type="date" class="form-control" name="CheckInDate" value="{{request()->query('CheckInDate') != null ? request()->query('CheckInDate') : date('yyyy/mm/dd')}}">

    </div>
    <div class="form-group">
            {{Form::label('CheckOutDate', 'End Date') }}
            <input type="date" class="form-control" name="CheckOutDate" value="{{request()->query('CheckOutDate') != null ? request()->query('CheckOutDate') : date('yyyy/mm/dd')}}">
        
            </div>

    </br>
    {{Form::submit('Submit', ['class'=>'btn btn-primary', 'v-on:click'=>'formSubmit'])}}
    </div>
    {!! Form::close() !!}
    <div class="btn-group" style="width:100%">
            <a class="nav-link btn btn-info " href="/download-pdf?CheckInDate={{request()->CheckInDate}}&CheckOutDate={{request()->CheckOutDate}}">Generate Deatils</a></br>
    {{-- <a class="nav-link btn btn-info " href="/download-pdf?CheckInDate={{request()->CheckInDate}&CheckOutDate={{request()->CheckOutDate}}}">Export Deatils</a></br> --}}
    <a class="nav-link btn btn-info " href="/download-monthpdf?CheckInDate={{request()->CheckInDate}}">Generate Monthly details </a></br>
    <a class="nav-link btn btn-info " href="/download-yearpdf?CheckInDate={{request()->CheckInDate}}">Generate Year details </a></br>
    </div>
</div>
 </div>
</div>


@endsection