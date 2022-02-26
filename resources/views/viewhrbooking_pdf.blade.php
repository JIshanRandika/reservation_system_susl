
    <table  class="table table-striped">
    <tr>
        <td>Booking Id </td>
        <td>Create Date </td>
        <td>Guest Name</td>
        <td>Room Type </td>
        <td>Check In Date</td>
        <td>Check Out Date</td>
        <td>Number Of Units</td>
        <td>Status</td>
        
        
        
        
         
    </tr>
    @foreach ($hrbookings as $hrbooking)
    <tr>
        <td>{{ $hrbooking->BookingId  }}</td>
        <td>{{ $hrbooking->created_at  }}</td>
        <td>{{ $hrbooking->GuestName  }}</td>
        <td>{{ $hrbooking->Type   }}</td>
        <td>{{ $hrbooking->CheckInDate }}</td>
        <td>{{ $hrbooking->CheckOutDate }}</td>
        <td>{{ $hrbooking->NoOfUnits }}</td>
       
        <td>{{ $hrbooking->Status }}</td>
       
    
       
       
    </tr>
    @endforeach
    </table>

