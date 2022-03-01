@extends('layouts.app')


@section('content')
    <div class="card p-3 mb-2 ">
        <!-- View Agri Farm  booking details from coordinator side -->
        <h5 class="card-header bg-secondary text-white">Agri Farm Kabana Booking Details</h5>
        <div class="card-body ">

            <div class="mb-3">

                {!! Form::open(['url' => 'viewagribooking',  'method' => 'GET',  'id' => 'booking_form']) !!}


                <div class="form-group">
                    {{Form::label('CheckInDate', 'Start Date') }}
{{--                    <input type="date" class="form-control" name="CheckInDate"--}}
{{--                           value="{{request()->query('CheckInDate') != null ? request()->query('CheckInDate') : date('yyyy/mm/dd')}}">--}}
                    <input type="date" class="form-control" name="CheckInDate" value="{{ date('Y-m-d', strtotime( request()->query('CheckInDate') ) ) != null ?  date('Y-m-d', strtotime( request()->query('CheckInDate') ) ) : date('yyyy/mm/dd')}}">

                </div>

                <div class="form-group">
                    {{Form::label('CheckOutDate', 'End Date') }}
{{--                    <input type="date" class="form-control" name="CheckOutDate"--}}
{{--                           value="{{request()->query('CheckOutDate') != null ? request()->query('CheckOutDate') : date('yyyy/mm/dd')}}">--}}
                    <input type="date" class="form-control" name="CheckOutDate" value="{{ date('Y-m-d', strtotime( request()->query('CheckOutDate') ) ) != null ?  date('Y-m-d', strtotime( request()->query('CheckOutDate') ) ) : date('yyyy/mm/dd')}}">

                </div>

                </br>
                {{Form::submit('Submit', ['class'=>'btn btn-primary', 'v-on:click'=>'formSubmit'])}}
            </div>
            {!! Form::close() !!}
            <div class="btn-group" style="width:100%">
                <a class="nav-link btn btn-outline-primary "
                   href="/download-agrispdf?CheckInDate={{request()->CheckInDate}}&CheckOutDate={{request()->CheckOutDate}}">Generate
                    Deatils</a></br>
                <a class="nav-link btn btn-outline-primary "
                   href="/download-agrismonthpdf?CheckInDate={{request()->CheckInDate}}">Generate Monthly
                    Details </a></br>
                <a class="nav-link btn btn-outline-primary "
                   href="/download-agriyearpdf?CheckInDate={{request()->CheckInDate}}">Generate Year Details </a></br>
            </div>


        </div>

        <table border="1" class="table table-striped">
            <tr>
                <td>Booking Id</td>
                <td>Create Date</td>
                <td>Guest Name</td>
                <td>Check In Date</td>
                <td>Check Out Date</td>
                <td>Number Of Unit</td>
                <td>Status</td>
                <td>Option</td>

            </tr>
            @foreach ($agrsbookings as $agrsbooking)
                <tr>
                    <td>{{ $agrsbooking->BookingId  }}</td>
                    <td>{{ $agrsbooking->created_at  }}</td>
                    <td>{{ $agrsbooking->GuestName  }}</td>
                    <td>{{ $agrsbooking->CheckInDate }}</td>
                    <td>{{ $agrsbooking->CheckOutDate }}</td>
                    <td>{{ $agrsbooking->NoOfUnits }}</td>

                    <td>{{ $agrsbooking->Status }}</td>

                    <td>
                        <a class="nav-link btn btn-outline-primary"
                           href='showaf/{{ $agrsbooking->BookingId }}'>View</a></br>
                        <a class="nav-link btn btn-outline-primary" href='showrecagri/{{ $agrsbooking->BookingId }}'>HOD
                            Approval</a></br>
                        <a class="nav-link btn btn-outline-primary" href='showvcagri/{{ $agrsbooking->BookingId }}'>VC
                            Approval</a></br>

                            <a class="nav-link btn btn-outline-primary"
                               href='afconfirm/request-payment/{{ $agrsbooking->BookingId }}'>Request Payment</a>
                        </br>


                        <a class="nav-link btn btn-outline-primary" href='afconfirm/{{ $agrsbooking->BookingId }}'>Confirm</a></br>
                        <a class="nav-link btn btn-outline-primary" href='afnotconfirm/{{ $agrsbooking->BookingId }}'>Reject</a>

                    </td>
                </tr>
            @endforeach
        </table>

        {{ $agrsbookings->links() }}

    </div>
    </div>


@endsection
