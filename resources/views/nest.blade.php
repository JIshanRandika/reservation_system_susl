@extends('layouts.app')


@section('content')

<!-- nest booking page -->
<div class=" card border-primary ">
        <h1>NEST</h1>
<div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
    
</br>
   <p style="margin-left: 10px;">
   NEST is the main circuit bungalow of the Faculty of Applied Sciences, coordinating from the Assistant Registrar of the Faculty of 
   Applied Sciences. The guests to the NEST can be only the SUSL staff members or resource person to the university. It consist with 
   one master bedroom with attached bathroom (Accommodate to 2 adults and one child) and 2 bedrooms with shared bathroom and one 
   single room consist with two single beds. 
   </p>
   

   </div>
</br>

          <div class="card p-3 mb-2 bg-secondary text-white" id="nest_booking">
            <h5 class="card-header">Booking</h5>
            <div class="card-body">
            <div class="mb-3">



                        {!! Form::model($sessionData, array('route' => array('nest_submit'), 'method' => 'POST', 'id' =>'booking_form')) !!}

                        <div class="form-group ">
                            {!! Form::label('Room Type')!!}
                            {!! Form::select('NestId', $nestfill, null, ['class'=>'form-control', 'v-model' => 'room_type']) !!}
                        </div>

                     <div class="form-group">
                        {{Form::label('CheckInDate', 'Check In Date') }}
                        {{ Form::date('CheckInDate', !empty($sessionData) ? Input::old('CheckInDate') : new \DateTime() , ['class' => 'form-control']) }}

                        </div>
                        <div class="form-group">
                        {{Form::label('CheckOutDate', 'Check Out Date') }}
                        {{ Form::date('CheckOutDate', !empty($sessionData) ? Input::old('CheckOutDate') : new \DateTime(), ['class' => 'form-control']) }}
                        </div>


                        <div class="form-group">
                        {{Form::label('NoOfUnits', 'Number Of Units') }}
                        {{Form::text('NoOfUnits', '',['class'=>'form-control','placeholder'=>'Number Of Units', 'v-model' => 'no_of_units', 'v-on:change'=>'checkUnitsCount'])}}
                        </div>
                        
                        <div class="form-group">
                        {{Form::label('NoOfAdults', 'Number Of Adults') }}
                        {{Form::text('NoOfAdults', '',['class'=>'form-control','placeholder'=>'Number Of Adults', 'v-model' => 'no_of_adults'])}}
                        </div>
                        <div class="form-group">
                        {{Form::label('NoOfChildren', 'Number Of Children') }}
                        {{Form::text('NoOfChildren', '',['class'=>'form-control','placeholder'=>'Number Of Children', 'v-model' => 'no_of_children'])}}
                        </div>


                        <div class="form-group">
                        {{Form::label('BookingType', 'Booking for Resource Person') }}
                        {{Form::select('BookingType', ['Resource Person' => 'Yes', ' SUSL Staff' => 'No'], null, ['placeholder' => 'Please select ...','class'=>'form-control'])}}
                        
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
                        {{Form::button('Submit', ['class'=>'btn btn-primary', 'v-on:click'=>'formSubmit'])}}
                        </div>
                        {!! Form::close() !!}

                   
             </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.js"></script>

    <script>
        const holiday_resort = new Vue({
            el: '#nest_booking',
            data() {
                return {
                    
                    room_type: {{  !empty($sessionData) ? $sessionData->NestId : 'null' }},
                    no_of_units:{{ !empty($sessionData) ? $sessionData->NoOfUnits : 0 }},
                    no_of_adults: {{ !empty($sessionData) ? $sessionData->NoOfAdults : 0 }},
                    no_of_children:{{ !empty($sessionData) ? $sessionData->NoOfChildren : 0 }}             
                }
            },

            methods:{

                checkUnitsCount(){
            
                    if(this.room_type == 1 &&  this.no_of_units > 1){
                        this.no_of_units = 0;
                        alert('Sorry, You can not book more than 1 units.')
                    }
                    if(this.room_type == 2 &&  this.no_of_units > 4){
                        this.no_of_units = 0;
                        alert('Sorry, You can not book more than 4 units.')
                    }
                   
                },

                formSubmit(){
                    if(this.room_type == 1){
                        if(this.no_of_adults > 2*this.no_of_units || this.no_of_children > 2*this.no_of_units){
                            alert("Sorry, the maximum number of people that can be accommodated has been exceeded. Please check the number of units and number of guests");
                        }else{
                            $("#booking_form").submit();
                        }
                    }else if(this.room_type == 2){
                        if(this.no_of_adults > 1*this.no_of_units || this.no_of_children > 0){
                            alert("Sorry, the maximum number of people that can be accommodated has been exceeded. Please check the number of units and number of guests");
                        }else{
                            $("#booking_form").submit();
                        }
                    }

                    
                }
            }
        });

    </script>    
      
@endsection