@extends('layouts.app')


@section('content')
<div class="card p-3 mb-2 bg-secondary text-white" >
<h1>Contact Us</h1>
<!-- contact page -->
{!! Form::open(['url' => 'contact/submit']) !!}

  <div class="form-group">
    {{Form::label('type', 'Type ') }}
    {{Form::select('type', ['Review' => 'Review', 'Comment' => 'Comment','Feedback' => 'Feedback'], null, ['class'=>'form-control'])}}
  </div>
   <div class="form-group">
   {{Form::label('name', 'Name') }}
   {{Form::text('name', '',['class'=>'form-control','placeholder'=>'Enter name'])}}
   </div>
   <div class="form-group">
   {{Form::label('email', 'E-Mail Address') }}
   {{Form::text('email', '',['class'=>'form-control','placeholder'=>'Enter email'])}}
   </div>
   <div class="form-group">
   {{Form::label('message', 'Message') }}
   {{Form::textarea('message', '',['class'=>'form-control','placeholder'=>'Enter message'])}}
   </div>
   <div class="form-group">
   
   {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
   </div>
{!! Form::close() !!}
  </div>
@endsection