@extends('layouts.app')


@section('content')


<div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
    
<!-- Audio Visual Unit booking page -->
<div class=" card border-primary ">
    <h1>Audio Visual Unit</h1>
</br>
   <p style="margin-left: 10px;">
   Department of Agribusiness Management provides facilities through the Audio-Visual Unit. The unit support the faculty,
    by means of producing audio video materials to supplement the regular teaching and learning activities through a skillful 
    technical staff with free of charge. Apart from preparing teaching material for undergraduate studies, the unit covers the
     social events of the university.
   </p>

   </div>
</br>
           <div class="card p-3 mb-2 bg-secondary text-white">
            <h5 class="card-header">Booking</h5>
            <div class="card-body">
            <div class="mb-3">

                        
                        {!! Form::model($sessionData, array('route' => array('avu_submit'), 'method' => 'POST', 'id' =>'booking_form')) !!}
                        
                        <div class="form-group">
                        {{Form::label('AVUId', 'Booking Type') }}
                        {{Form::select('AVUId', [1 => 'Photography', 2 => 'Videography', 3 => 'Photography and Videography'], null, ['class'=>'form-control','placeholder' => 'Please select ...'])}}
                        
                        </div>

                        <div class="form-group">
                        {{Form::label('CheckInDate', 'Check In Date') }}
                        {{ Form::date('CheckInDate', !empty($sessionData) ? Input::old('CheckInDate') : new \DateTime() , ['class' => 'form-control']) }}

                        </div>
                        

                        <div class="form-group">
                        {{Form::label('StartTime', 'Start Time') }}
                        {{ Form::time('StartTime', !empty($sessionData) ? Input::old('StartTime') : \Carbon\Carbon::now(),['class'=>'form-control']) }}
                       
                        </div>
                        <div class="form-group">
                        {{Form::label('EndTime', 'End Time') }}
                        {{ Form::time('EndTime', !empty($sessionData) ? Input::old('EndTime') :  \Carbon\Carbon::now(),['class'=>'form-control']) }}
                        </div>

                        <div hidden class="form-group">
                        {{Form::label('CurrentTime', 'Current Time') }}
                        {{ Form::time('CurrentTime', \Carbon\Carbon::now(),  ['class'=>'form-control']) }}
                        </div>

                         <div class="form-group">
                        {{Form::label('EventName', 'Event Name') }}
                        {{Form::text('EventName', '',['class'=>'form-control','placeholder'=>'Event Name'])}}
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
                        
                     
                        </br>
                        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
                        </div>
                        {!! Form::close() !!}

             </div>
        </div>
    </div>
@endsection


