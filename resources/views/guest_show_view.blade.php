@extends('layouts.app')


@section('content')
<div class="card p-3 mb-2  text-white">
<h5 class="card-header bg-secondary">Guest Details</h5>
<div class="card-body  ">

<div class="table-responsive">
<table class="table table-striped">
<tr>
<td>ID</td>
<td>Name</td>
<td>Email</td>
<td>NIC</td>
<td>PassportNo</td>
<td>ContactNo</td>
<td>Address</td>

<td>University</td>
<td>FacultyOrCenter</td>
<td>Department</td>
<td>UPFNo</td>
<td>Designation</td>


</tr>
@foreach ($users as $user)
<tr>
<td>{{ $user->id }}</td>
<td>{{ $user->name }}</td>
<td>{{ $user->email }}</td>
<td>{{ $user->NIC }}</td>
<td>{{ $user->PassportNo }}</td>
<td>{{ $user->ContactNo }}</td>
<td>{{ $user->Address }}</td>

<td>{{ $user->University }}</td>
<td>{{ $user->FacultyOrCenter }}</td>
<td>{{ $user->Department }}</td>
<td>{{ $user->UPFNo }}</td>
<td>{{ $user->Designation }}</td>


</tr>
@endforeach
</table>
</div>
</div>
</div>



@endsection
