
    <table  class="table table-striped">
    <tr>
        <td>Id </td>
        <td>Create Date </td>
        <td>Guest  </td>
        <td>Service </td>
        <td>Check In Date</td>
        <td>StartTime</td>
        <td>EndTime</td>
        <td>Event Name</td>
        <td>Description</td>
        <td>Recommendation </td>
        <td>Status</td>
        
        
        
        
         
    </tr>
    @foreach ($avubookings as $avubooking)
    <tr>
        <td>{{ $avubooking->BookingId  }}</td>
        <td>{{ $avubooking->created_at  }}</td>
        <td>{{ $avubooking->GuestName  }}</td>
        <td>{{ $avubooking->Type   }}</td>
        <td>{{ $avubooking->CheckInDate }}</td>
        <td>{{ $avubooking->StartTime }}</td>
        <td>{{ $avubooking->EndTime }}</td>
        <td>{{ $avubooking->EventName  }}</td>
        <td>{{ $avubooking->Description }}</td>
        <td>{{ $avubooking->name}}</td>
        
        <td>{{ $avubooking->Status }}</td>
       
    </tr>
    @endforeach
    </table>

