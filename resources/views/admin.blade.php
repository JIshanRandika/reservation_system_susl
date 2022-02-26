@extends('layouts.app')


@section('content')
<div class="card p-3 mb-2 bg-secondary text-white">
<!-- Admin Page -->
<h5 class="card-header">Admin Page</h5>
<div class="card-body">
<a class="nav-link btn btn-info" href="/edit-records">View User Details</a></br>
<a class="nav-link btn btn-info" href="/guest-records">View Guest Details</a></br>
<a class="nav-link btn btn-info" href="/viewadminagribooking">View Agri Farm Kabana Booking Details</a></br>
<a class="nav-link btn btn-info" href="/viewadminafdbooking">View Agri Farm Dinning Room Booking Details</a></br>
<a class="nav-link btn btn-info" href="/viewadminnestbooking">View NEST Booking Details</a></br>
<a class="nav-link btn btn-info" href="/viewadminhrbooking">View Holiday Resort Booking Details</a></br>
<a class="nav-link btn btn-info" href="/viewadminavubooking">View Audio Visual Unit Booking Details</a></br>
<a class="nav-link btn btn-info" href="/view-msg">View Comments</a></br>

 </div>
</div>



@endsection