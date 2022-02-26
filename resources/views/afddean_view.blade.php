
@extends('layouts.app')


@section('content')
<div class="card p-3 mb-2 bg-secondary text-white">
    <h5 class="card-header">Details</h5>
    <div class="card-body">
     <div class="mb-4">
        <form action = "/showafddean/<?php echo $users[0]->BookingId; ?>" method = "post">
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
        <td>Check In Date</td>
        <td>
        <input class="form-control" type = 'text' name = 'CheckInDate'
        value = '<?php echo$users[0]->CheckInDate; ?>' readonly="readonly"/>
        </td>
        </tr>
     
        <tr>
        <td>Number Of Guest</td>
        <td>
        <input class="form-control" type = 'text' name = 'NoOfGuest'
        value = '<?php echo$users[0]->NoOfGuest; ?>' readonly="readonly"/>
        </td>
        </tr>
        
        <tr>
        <td>Description</td>
        <td>
        <input class="form-control" type = 'textarea' name = 'Description'
        value = '<?php echo$users[0]->Description; ?>' readonly="readonly"/>
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
        <input class="form-control" type = 'textarea' name = 'HODComment'
        value = '<?php echo$users[0]->	HODComment; ?>'/>
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