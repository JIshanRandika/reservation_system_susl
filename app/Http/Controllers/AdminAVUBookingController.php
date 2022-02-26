<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Mail;
use App\Mail\RejectMail;
use App\Mail\ConfirmMail;
use Auth;
use App\Mail\SendMail;

class AdminAVUBookingController extends Controller
{
    //view avu bookings
    public function viewadminavubooking(Request $request) { 
      
        if($request->input('CheckInDate') != null){
            $avubookings =DB::table('avubookings')
            ->select('avubookings.*','users.name','audiovisualunits.Type')
            ->join('users','users.id','=','avubookings.Recommendation_From')
            ->join('audiovisualunits','audiovisualunits.AVUId','=','avubookings.AVUId')
            ->where('CheckInDate', $request->input('CheckInDate'))
            ->orderBy('BookingId', 'DESC')
            ->paginate(10);
        }else{
            $avubookings =DB::table('avubookings')
            ->select('avubookings.*','users.name','audiovisualunits.Type')
            ->join('users','users.id','=','avubookings.Recommendation_From')
            ->join('audiovisualunits','audiovisualunits.AVUId','=','avubookings.AVUId')
            ->orderBy('BookingId', 'DESC')
            ->paginate(10);
        }
 
 
       
      
 
         return view('viewadminavubooking',['avubookings'=>$avubookings]); 
        } 
 
    
 //comfirm details
         public function edit(Request $request,$BookingId) {
 
             $data = $BookingId;
 
             //$GuestId = DB::select('select GuestId from avubookings where BookingId = ?', [$data]);
             $GuestId = DB::table('avubookings')->where('BookingId', [$BookingId])->value('GuestId');
             $email = DB::table('users')->where('id', [$GuestId])->value('email');
             //$email = DB::select('select email from users where id = ?', [$GuestId]);
 
             $Status = 'Confirmed';
             DB::update('update avubookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
             echo "Record updated successfully.";
             echo 'Click Here to go back.';
 
             Mail::to($email)->send(new ConfirmMail($data));
             return back()->with('success', 'Message Sent Successfuly!');
             }
 
        //reject bookings
         public function reject(Request $request,$BookingId) {
                 $data = $BookingId;
                 $Status = 'Rejected';
                 $GuestId = DB::table('avubookings')->where('BookingId', [$BookingId])->value('GuestId');
                 $email = DB::table('users')->where('id', [$GuestId])->value('email');
 
                 DB::update('update avubookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                 echo "Record updated successfully.
                 ";
                 echo 'Click Here to go back.';
 
                 Mail::to($email)->send(new RejectMail($data));
                 return back()->with('success', 'Message Sent Successfuly!');
                 }
 
 
             
 }
 