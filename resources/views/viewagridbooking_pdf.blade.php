
    <table  class="table table-striped">
    <tr>
        <td>Booking Id </td>
        <td>Create Date </td>
        <td>Guest Name </td>
        <td>Check In Date</td>
        <td>StartTime</td>
        <td>EndTime</td>
        <td>No: Guest</td>
        <td>Description</td>
        <td>Recommendation from</td>
        <td>Status</td>
        
        
        
        
         
    </tr>
    @foreach ($agridbookings as $agridbooking)
    <tr>
        <td>{{ $agridbooking->BookingId  }}</td>
        <td>{{ $agridbooking->created_at  }}</td>
        <td>{{ $agridbooking->GuestName  }}</td>
        <td>{{ $agridbooking->CheckInDate }}</td>
        <td>{{ $agridbooking->StartTime }}</td>
        <td>{{ $agridbooking->EndTime }}</td>
        <td>{{ $agridbooking->NoOfGuest }}</td>
        <td>{{ $agridbooking->Description }}</td>
        <td>{{ $agridbooking->name }}</td>
       
        <td>{{ $agridbooking->Status }}</td>
     
       
    </tr>
    @endforeach
    </table>
 