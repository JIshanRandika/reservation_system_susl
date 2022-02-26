@extends('layouts.app')


@section('content')
<div class="card p-3 mb-2  text-white">
<h5 class="card-header bg-secondary">Comments</h5>
<div class="card-body  ">

<table class="table table-striped">
<tr>


<td>Name</td>
<td>Type</td>
<td>Email</td>
<td>Comment</td>

</tr>
@foreach ($msgs as $msg)

<tr>

<td>{{ $msg->name }}</td>
<td>{{ $msg->type }}</td>
<td>{{ $msg->email }}</td>
<td>{{ $msg->message }}</td>

</tr>
@endforeach
</table>

</div>
</div>



@endsection
