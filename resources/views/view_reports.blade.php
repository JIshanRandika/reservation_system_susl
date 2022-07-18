@extends('layouts.app')


@section('content')
<div class="card p-3 mb-2 bg-secondary text-white">
<!-- Report Page -->
<h5 class="card-header">Report Page</h5>
<div class="card-body">
    <a class="nav-link btn btn-info" href="/viewreportagribooking">View Agri Farm Booking Reports</a></br>
    <a class="nav-link btn btn-info" href="/viewreportagridbooking">View Agri Farm Dinning Room Booking Reports</a></br>
    <a class="nav-link btn btn-info" href="/viewreportnestbooking">View NEST Booking Reports</a></br>
    <a class="nav-link btn btn-info" href="/viewreporthrbooking">View Holiday Resort Booking Reports</a></br>
    <a class="nav-link btn btn-info" href="/viewreportavubooking">View Audio Visual Unit Booking Reports</a></br>
    <a class="nav-link btn btn-info" href="https://www.sab.ac.lk/codl/payment/report.php?event=cmVzZXJ2YXRpb24jS2FiYW5h">View Agri Farm Booking Payments</a></br>
    <a class="nav-link btn btn-info" href=" https://www.sab.ac.lk/codl/payment/report.php?event=cmVzZXJ2YXRpb24jQWdyaSBGYXJtIERpbmluZyBSb29t">View Agri Farm Dinning Room Booking Payments</a></br>
    <a class="nav-link btn btn-info" href="https://www.sab.ac.lk/codl/payment/report.php?event=cmVzZXJ2YXRpb24jTmVzdA%3D%3D">View NEST Booking Payments</a></br>
    <a class="nav-link btn btn-info" href="https://www.sab.ac.lk/codl/payment/report.php?event=cmVzZXJ2YXRpb24jSG9saWRheSBSZXNvcnQ%3D">View Holiday Resort Booking Payments</a></br>
    
     </div>
    
</div>



@endsection