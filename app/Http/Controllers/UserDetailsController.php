<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserDetailsController extends Controller
{
    public function index(){
        $users = DB::select('select * from users where roleNo != 0');
        return view('user_edit_view',['users'=>$users]);
        }

        public function guestonly(){
            $users = DB::select('select * from users where roleNo < 1');
            return view('guest_edit_view',['users'=>$users]);
            }

        public function guestshowonly(){
            $users = DB::select('select * from users where roleNo < 1');
            return view('guest_show_view',['users'=>$users]);
        }

        public function show($id) {
        $users = DB::select('select * from users where id = ?',[$id]);
        return view('user_update',['users'=>$users]);
        }
        public function edit(Request $request,$id) {
        $name = $request->input('name');
        $email = $request->input('email');
        $NIC = $request->input('NIC');
        $PassportNo = $request->input('PassportNo');
        $ContactNo = $request->input('ContactNo');
        $Address = $request->input('Address');
        $University = $request->input('University');
        $FacultyOrCenter = $request->input('FacultyOrCenter');
        $Department = $request->input('Department');
        $UPFNo = $request->input('UPFNo');
        $Designation = $request->input('Designation');
        $roleNo = $request->input('roleNo');
        DB::update('update users set name = ?,email=?,NIC=?,PassportNo=?,ContactNo=?,Address=?,University=?,FacultyOrCenter=?,Department=?,UPFNo=?,Designation=?,roleNo=? where id = ?',[$name,$email,$NIC,$PassportNo,$ContactNo,$Address,$University,$FacultyOrCenter,$Department,$UPFNo,$Designation,$roleNo,$id]);
        echo "Record updated successfully.
        ";
        echo 'Click Here to go back.';
        }

        public function showguest($id) {
            $users = DB::select('select * from users where id = ?',[$id]);
            return view('guest_update',['users'=>$users]);
            }
        public function editguest(Request $request,$id) {
          
            $roleNo = $request->input('roleNo');
            DB::update('update users set roleNo=? where id = ?',[$roleNo,$id]);
            echo "Record updated successfully.
            ";
            echo 'Click Here to go back.';
            }
        public function destroy($id) {
            DB::delete('delete from users where id = ?',[$id]);
            echo "Record deleted successfully.
            ";
            echo 'Click Here to go back.';
            }


            public function showmsg(){
                $msgs = DB::select('select * from messages');
                return view('msg_edit_view',['msgs'=>$msgs]);
                }
}
