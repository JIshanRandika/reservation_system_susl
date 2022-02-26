@extends('layouts.app')


@section('content')

<!-- Agri Farm booking page -->
<div class=" card border-primary ">
        <h1>Kabanas</h1>
<div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
    
</br>
   <p style="margin-left: 10px;">
   Agrifac Farm Stay is nested in the Belihuloya Ranges,Sabaragamuwa Province, Sri Lanka. It is managed by the Department of 
   Agribusiness Management of the Sabaragamuwa University of Sri Lanka. Agrifac Farm Stay is a perfect stopover on 
   the Colombo-Badulla Highway and a charming and peaceful holiday destination for much needed "gateway-from-it-all"
    restful break. An unforgettable, warm, and friendly farm style Bed & Breakfast experience awaits you in this romantic 
    and pleasant atmosphere. Here there are three (3) kabanas to stay and each kabana is facilitate to stay 2 adults and 2 children. 
   </p>
    <p style="margin-left: 10px;">Payments as follows</p>

    <table class="table">
  <thead class="table-primary">
         <tr>
            <td>Customer Type</td>
        
            <td>Monday – Thursday (LRK)</td>
            <td>Friday – Sunday (LRK)</td>
         </tr>
         
         
        
</thead>
<tbody>
        <tr>
        <td>Local Visitors</td>
       
        <td>3550.00 </td>
        <td>4050.00  </td>
         </tr>
        
    <tr>
    <td>University Staff</td>
       
            <td>3050.00</td>
            <td>3550.00</td>
         </tr>
         <tr>
         <td>Resource Persons</td>
       
            <td>Free of charge with Vice Chancellor Approval</td>
            <td>Free of charge with Vice Chancellor Approval</td>
         </tr>

          <tr>
    <td>Foreigners</td>
       
            <td>4800.00</td>
            <td>5800.00</td>
         </tr>
         
 </tbody>
      </table>

   </div>
</br>

      <div class="card p-3 mb-2 bg-secondary text-white" id="af_booking">
            <h5 class="card-header">Booking</h5>
            <div class="card-body">
            <div class="mb-3">

                        
                    {!! Form::model($sessionData, array('route' => array('af_submit'), 'method' => 'POST', 'id' =>'booking_form')) !!}

                    
                    <div class="form-group">
                    {{Form::label('BookingType', 'Booking for ') }}
                    {{Form::select('BookingType', ['Resource Person' => 'Resource Person', 'SUSL Staff' => 'SUSL Staff','Local Visitor' => 'Local Visitor', ' Foreigners' => 'Foreigners'], null, ['v-model' => 'booking_type','class'=>'form-control'])}}

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
                    {{Form::label('Description', 'Description') }}
                    {{Form::textarea('Description', '',['class'=>'form-control','placeholder'=>'Description'])}}
                    </div>
                    <div class="form-group">

 
                    {{-- <div class="form-group" v-if="booking_type === `Resource Person` || booking_type === `SUSL Staff`">
                    {!! Form::label('Dean/HOD')!!}
                    {!! Form::select('Recommendation_from', $select, null, ['class'=>'form-control', 'placeholder' => 'Please select ...']) !!}
                    </div> --}}

                    <!-- <div class="form-group" v-if="booking_type === `Resource Person` || booking_type === `SUSL Staff`">
                    {{Form::label('VCApproval', 'Request VC Approval') }}
                    {{Form::select('VCApproval', [1 => 'Yes', 0 => 'No'], null, ['placeholder' => 'Please select ...'])}}

                    </div> -->
                               

                  

                    </br>
                    {{Form::submit('Submit', ['class'=>'btn btn-primary', 'v-on:click'=>'formSubmit'])}}
                    </div>
                    {!! Form::close() !!}

             </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.js"></script>

    <script>
        const holiday_resort = new Vue({
            el: '#af_booking',
            data() {
                return {
                    booking_type:null,
                    room_type:null,
                    no_of_units:{{ !empty($sessionData) ? $sessionData->NoOfUnits : 0 }},
                    no_of_adults: {{ !empty($sessionData) ? $sessionData->NoOfAdults : 0 }},
                    no_of_children:{{ !empty($sessionData) ? $sessionData->NoOfChildren : 0 }}      

                         
                }
            },

            methods:{

                checkUnitsCount(){
            
                    if(  this.no_of_units > 3){
                        this.no_of_units = 0;
                        alert('Sorry, You can not book more than 3 units.')
                    }
                  
                   
                },

                formSubmit(){
                    
                        if(this.no_of_adults > 2*this.no_of_units || this.no_of_children > 2*this.no_of_units){
                            alert("Sorry, the maximum number of people that can be accommodated has been exceeded.  Please check the number of units and number of guests");
                        }else{
                            $("#booking_form").submit();
                        }
                   
                    
                }
            }
        });

    </script>    
      
@endsection


