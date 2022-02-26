
@extends('layouts.app')


@section('content')
<div class="card p-3 mb-2 bg-secondary text-white">
    <h5 class="card-header">Details</h5>
    <div class="card-body">
     <div class="mb-4">
        <form action = "/showregnest/<?php echo $users[0]->BookingId; ?>" method = "post">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
        <table width="90%">
        <tr>
        <td width="30%">
        Booking Id
        
        </td>
        <td width="70%">
        <input  class="form-control" type = 'text' name = 'BookingId'
        value = '<?php echo$users[0]->BookingId; ?>'readonly="readonly"/> </td>
        </tr>
        <tr>

        <td>Guest Name</td>
        <td>
        <input class="form-control" type = 'text' name = 'GuestName'
        value = '<?php echo$users[0]->GuestName; ?>'readonly="readonly"/>
        </td>
        </tr>
        <td>Guest NIC</td>
        <td>
        <input class="form-control" type = 'text' name = 'NIC'
        value = '<?php echo$users[0]->NIC; ?>'readonly="readonly"/>
        </td>
        </tr>
        <td>Guest Phone Number</td>
        <td>
        <input class="form-control" type = 'text' name = 'ContactNo'
        value = '<?php echo$users[0]->ContactNo; ?>'readonly="readonly"/>
        </td>
        </tr>
        <td>Guest Address</td>
        <td>
        <input class="form-control" type = 'text' name = 'Address'
        value = '<?php echo$users[0]->Address; ?>'readonly="readonly"/>
        </td>
        </tr>
        <tr>
        <td>Room Type</td>
        <td>
        <input class="form-control" type = 'text' name = 'Type'
        value = '<?php echo$users[0]->Type; ?>'readonly="readonly"/>
        </td>
        </tr>
        <tr>
        <td>Check In Date</td>
        <td>
        <input class="form-control" type = 'text' name = 'CheckInDate'
        value = '<?php echo$users[0]->CheckInDate; ?>' readonly="readonly"/>
        </td>
        </tr>
        <tr>
        <td>Check Out Date</td>
        <td>
        <input class="form-control" type = 'text' name = 'CheckOutDate'
        value = '<?php echo$users[0]->CheckOutDate; ?>' readonly="readonly"/>
        </td>
        </tr>
        <tr>
        <td>Number Of Adults</td>
        <td>
        <input class="form-control" type = 'text' name = 'NoOfAdults'
        value = '<?php echo$users[0]->NoOfAdults; ?>' readonly="readonly"/>
        </td>
        </tr>
        <tr>
        <td>Number Of Children</td>
        <td>
        <input class="form-control" type = 'text' name = 'NoOfChildren'
        value = '<?php echo$users[0]->NoOfChildren; ?>' readonly="readonly"/>
        </td>
        </tr>
        <tr>
        <td>Number Of Units</td>
        <td>
        <input class="form-control" type = 'text' name = 'NoOfUnits'
        value = '<?php echo$users[0]->NoOfUnits; ?>' readonly="readonly"/>
        </td>
        </tr>
        <tr>
        <td>Guest Type</td>
        <td>
        <input class="form-control" type = 'text' name = 'BookingType'
        value = '<?php echo$users[0]->BookingType; ?>' readonly="readonly"/>
        </td>
        </tr>
        <tr>
        <td>Description</td>
        <td>
        <input class="form-control" type = 'textarea' name = 'Description'
        value = '<?php echo$users[0]->Description; ?>' readonly="readonly"/>
        </td>
        </tr>
       
        <tr>
        <td>Comment By HOD</td>
        <td>
        <input class="form-control" type = 'textarea' name = 'HODComment'
        value = '<?php echo$users[0]->HODComment; ?>' readonly="readonly"/>
        </td>
        </tr>
       

        <tr>
        <td>Comment By VC</td>
        <td>
        <input class="form-control" type = 'textarea' name = 'VCComment'
        value = '<?php echo$users[0]->	VCComment; ?>' readonly="readonly"/>
        </td>
        </tr>

        <td>Status</td>
        <td>
        <input class="form-control" type = 'text' name = 'Status'
        value = '<?php echo$users[0]->Status; ?>' readonly="readonly"/>
        </td>
        </tr>
        
        <tr>
        <td>Comment</td>
        <td>
        <input class="form-control" type = 'textarea' name = 'RegComment'
        value = '<?php echo$users[0]->	RegComment; ?>'/>
        </td>
        </tr>
        
        <tr>
        <td colspan = '2'>
        </br>
        <input  type = 'submit' value = "Save Comment" />
        </td>
        </tr>

        </table>
        </form>
        
    </div>
    </div>
</div>

@endsection