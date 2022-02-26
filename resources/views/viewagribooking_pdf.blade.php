

    <table border = "1" class="table table-striped">
    <tr>
        <td>Booking Id </td>
        <td>Create Date </td>
        <td>Guest Name </td>
        <td>Check In Date</td>
        <td>Check Out Date</td>
        <td>Number Of Unit</td>
        <td>Status</td>
        
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
       
        
    </tr>
    @endforeach
    </table>

 