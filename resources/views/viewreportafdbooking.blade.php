@extends('layouts.app')


@section('content')
<div class="card  ">
<!-- View Agri Farm Dinning Room booking details from coordinator side -->
<h5 class="card-header bg-secondary text-white">View Agri Farm Dinning Room Booking Details</h5>
<div class="card-body ">

   <div class="mb-3">

    {!! Form::open(['url' => 'viewreportagridbooking',  'method' => 'GET',  'id' => 'booking_form']) !!}


    <div class="form-group">
    {{Form::label('CheckInDate', 'Date') }}
    <input type="date" class="form-control" name="CheckInDate" value="{{request()->query('CheckInDate') != null ? request()->query('CheckInDate') : date('yyyy/mm/dd')}}">

    </div>


    </br>
    {{Form::submit('Submit', ['class'=>'btn btn-primary', 'v-on:click'=>'formSubmit'])}}
    </div>
    {!! Form::close() !!}
    <div class="btn-group" style="width:100%">
    <a class="nav-link btn btn-info " href="/download-agridpdf?CheckInDate={{request()->CheckInDate}}">Generate Deatils</a></br>
    <a class="nav-link btn btn-info " href="/download-agridmonthpdf?CheckInDate={{request()->CheckInDate}}">Generate Monthly details </a></br>
    <a class="nav-link btn btn-info " href="/download-agridyearpdf?CheckInDate={{request()->CheckInDate}}">Generate Year details </a></br>
    
    </div>
</div>

 </div>
</div>


@endsection