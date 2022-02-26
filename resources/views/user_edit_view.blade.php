@extends('layouts.app')


@section('content')
<div class="card p-3 mb-2  text-white">
<h5 class="card-header bg-secondary">User Details</h5>
<div class="card-body  ">

<table class="table table-striped">
<tr>
<td>ID</td>
<td>Name</td>
<td>Email</td>
<td>NIC</td>
<td>PassportNo</td>
<td>ContactNo</td>
<td>Address</td>
<td>roleNo</td>

<td>Option</td>

</tr>
@foreach ($users as $user)
@if( $user->name != 'None')
<tr>
<td>{{ $user->id }}</td>
<td>{{ $user->name }}</td>
<td>{{ $user->email }}</td>
<td>{{ $user->NIC }}</td>
<td>{{ $user->PassportNo }}</td>
<td>{{ $user->ContactNo }}</td>
<td>{{ $user->Address }}</td>
<td>{{ $user->roleNo }}</td>
<td>
<a href = 'edit/{{ $user->id }}'>View</a>
</br>
<a href = 'delete/{{ $user->id }}'>Delete</a>
</td>
</tr>
@endif
@endforeach
</table>

</div>
</div>



@endsection
