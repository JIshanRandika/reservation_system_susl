
@extends('layouts.app')


@section('content')
<div class="card p-3 mb-2 bg-secondary text-white">
    <h5 class="card-header">Details</h5>
    <div class="card-body">
     <div class="mb-4">
        <form action = "/edit/<?php echo $users[0]->id; ?>" method = "post">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
        <table width="90%">
        <tr>
        <td width="30%">
        Name
        
        </td>
        <td width="70%">
        <input  class="form-control" type = 'text' name = 'name'
        value = '<?php echo$users[0]->name; ?>'/> </td>
        </tr>
        <tr>
        <td>Email</td>
        <td>
        <input class="form-control" type = 'text' name = 'email'
        value = '<?php echo$users[0]->email; ?>'/>
        </td>
        </tr>
        <tr>
        <td>NIC</td>
        <td>
        <input class="form-control" type = 'text' name = 'NIC'
        value = '<?php echo$users[0]->NIC; ?>'/>
        </td>
        </tr>
        <tr>
        <td>Passport Number</td>
        <td>
        <input class="form-control" type = 'text' name = 'PassportNo'
        value = '<?php echo$users[0]->PassportNo; ?>'/>
        </td>
        </tr>
        <tr>
        <td>Contact Number</td>
        <td>
        <input class="form-control" type = 'text' name = 'ContactNo'
        value = '<?php echo$users[0]->ContactNo; ?>'/>
        </td>
        </tr>
        <tr>
        <td>Address</td>
        <td>
        <input class="form-control" type = 'text' name = 'Address'
        value = '<?php echo$users[0]->Address; ?>'/>
        </td>
        </tr>
        <tr>
        <td>University</td>
        <td>
        <input class="form-control" type = 'text' name = 'University'
        value = '<?php echo$users[0]->University; ?>' readonly="readonly"/>
        </td>
        </tr>
        <tr>
        <td>Faculty </td>
        <td>
        <input class="form-control" type = 'text' name = 'FacultyOrCenter'
        value = '<?php echo$users[0]->FacultyOrCenter; ?>' readonly="readonly"/>
        </td>
        </tr>
        <tr>
        <td>Department</td>
        <td>
        <input class="form-control" type = 'text' name = 'Department'
        value = '<?php echo$users[0]->Department; ?>' readonly="readonly"/>
        </td>
        </tr>
        <tr>
        <td>UPF Number</td>
        <td>
        <input class="form-control" type = 'text' name = 'UPFNo'
        value = '<?php echo$users[0]->UPFNo; ?>'/>
        </td>
        </tr>
        <tr>
        <td>Designation</td>
        <td>
        <input class="form-control" type = 'text' name = 'Designation'
        value = '<?php echo$users[0]->Designation; ?>' readonly="readonly"/>
        </td>
        </tr>
        <td>Role Number</td>
        <td>
        <input class="form-control" type = 'number' name = 'roleNo'
        value = '<?php echo$users[0]->roleNo; ?>'/>
        </td>
        </tr>
        
        <tr>
        <td colspan = '2'>
        </br>
        <input  type = 'submit' value = "Update User Details" />
        </td>
        </tr>
        </table>
        </form>
        
    </div>
    </div>
</div>

@endsection