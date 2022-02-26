<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\agrsbooking;

use Illuminate\Support\Facades\Mail;
use App\Mail\RejectMail;
use App\Mail\ConfirmMail;
use Auth;
use App\Mail\SendMail;

class AdminAgriSBookingController extends Controller
{
    //load agri farm booking details in admin page
    public function viewadminagribooking(Request $request) { 
      
        if($request->input('CheckInDate') != null){
            $agrsbookings = agrsbooking::whereDate('CheckInDate', $request->input('CheckInDate'))->orderBy('BookingId', 'DESC')->paginate(10);
        }else{
            $agrsbookings = agrsbooking::orderBy('BookingId', 'DESC')->paginate(10);
        }

        return view('viewadminagribooking',['agrsbookings'=>$agrsbookings]); 
       } 




        //confirm afri farm booking
        public function confirm(Request $request,$BookingId) {

            $data = $BookingId;

            
            $GuestId = DB::table('agrsbookings')->where('BookingId', [$BookingId])->value('GuestId');
            $email = DB::table('users')->where('id', [$GuestId])->value('email');
            

            $Status = 'Confirmed';
            DB::update('update agrsbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
            echo "Record updated successfully.";
            echo 'Click Here to go back.';

            Mail::to($email)->send(new ConfirmMail($data));
            return back()->with('success', 'Message Sent Successfuly!');
            }


            //reject agri farm booking
            public function reject(Request $request,$BookingId) {
                $data = $BookingId;
                $Status = 'Rejected';
                $GuestId = DB::table('agrsbookings')->where('BookingId', [$BookingId])->value('GuestId');
                $email = DB::table('users')->where('id', [$GuestId])->value('email');

                DB::update('update agrsbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                echo "Record updated successfully.
                ";
                echo 'Click Here to go back.';

                Mail::to($email)->send(new RejectMail($data));
                return back()->with('success', 'Message Sent Successfuly!');
                }

               

                //show selected agri farm details
                public function showaf($id) {

                            $users =DB::table('agrsbookings')
                            ->select('agrsbookings.*','users.*')
                            ->join('users','users.id','=','agrsbookings.GuestId')
                            ->where(['agrsbookings.BookingId' => $id])
                            ->get();
                        //$users = DB::select('select * from agrsbookings where BookingId = ?',[$id]);
                    return view('af_adminview',['users'=>$users]);
                }

                //request vc approval
                public function vcapprove(Request $request,$BookingId) {
                    $data = $BookingId;
                    $Status = 'Request Vice Chancellor Approval';
                    
    
                    DB::update('update agrsbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                    echo "Record updated successfully.
                    ";
                    echo 'Click Here to go back.';
    
                    $email = DB::select('select email from users where roleNo = 2');
                
                    Mail::to($email)->send(new SendMail($data));
                    return back()->with('success', 'Message Sent Successfuly!');
                    }

}