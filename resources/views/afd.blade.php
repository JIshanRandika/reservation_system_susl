@extends('layouts.app')


@section('content')


<!-- Agri Farm Dinning Room booking page -->
<div class=" card border-primary ">
        <h1>Dining Room</h1>
<div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
    
</br>
   <p style="margin-left: 10px;">
   Agri Farm Dining is a separate dining room which is located in the Agri Farm and coordinated by the Department of Agribusiness, 
   Sabaragamuwa University of Sri Lanka. Anyone in the university staff can book this wonderful place and have a grate dining 
   experience there.   
   </p>

   </div>
</br>

           <div class="card p-3 mb-2 bg-secondary text-white">
            <h5 class="card-header">Booking</h5>
            <div class="card-body">
            <div class="mb-3">

                        

                        {!! Form::model($sessionData, array('route' => array('afd_submit'), 'method' => 'POST', 'id' =>'booking_form')) !!}

                        

                        <div class="form-group">
                        {{Form::label('CheckInDate', 'Booking Date') }}
                        {{ Form::date('CheckInDate', !empty($sessionData) ? Input::old('CheckInDate') : new \DateTime() , ['class' => 'form-control']) }}

                       
                        </div>

                        <div class="form-group">
                        {{Form::label('StartTime', 'Start Time') }}
                        {{ Form::time('StartTime', !empty($sessionData) ? Input::old('StartTime') : \Carbon\Carbon::now(),['class'=>'form-control']) }}
                       
                       
                        </div>
                        <div class="form-group">
                        {{Form::label('EndTime', 'End Time') }}
                        {{ Form::time('EndTime', !empty($sessionData) ? Input::old('EndTime') : \Carbon\Carbon::now(),['class'=>'form-control']) }}
                       
                        </div>

                        <div hidden class="form-group">
                        {{Form::label('CurrentTime', 'Current Time') }}
                        {{ Form::time('CurrentTime', \Carbon\Carbon::now(),  ['class'=>'form-control']) }}
                        </div>

                         <div class="form-group">
                        {{Form::label('NoOfGuest', 'Number Of Guest') }}
                        {{Form::text('NoOfGuest', '',['class'=>'form-control','placeholder'=>'Number Of Guest'])}}
                        </div>
                         
                        <div class="form-group">
                        {{Form::label('Description', 'Description') }}
                        {{Form::textarea('Description', '',['class'=>'form-control','placeholder'=>'Description'])}}
                        </div>
                        <div class="form-group">

                          {{-- <div class="form-group ">
                            {!! Form::label('Dean/HOD')!!}
                            {!! Form::select('Recommendation_from', $select, null, ['class'=>'form-control']) !!}
                        </div> --}}
                        
                        <!-- <div class="form-group">
                        {{Form::label('VCApproval', 'Request VC Approval') }}
                        {{Form::select('VCApproval', [1 => 'Yes', 0 => 'No'], null, ['placeholder' => 'Please select ...','class'=>'form-control'])}}
                        
                        </div> -->

                        </br>
                        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
                        </div>
                        {!! Form::close() !!}

             </div>
        </div>
    </div>
@endsection



       
     