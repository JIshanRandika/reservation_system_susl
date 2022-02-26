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

class AdminHrBookingController extends Controller
{
    //view booking details
    public function viewadminhrbooking(Request $request) { 

        if($request->input('CheckInDate') != null){
            $hrbookings =DB::table('hrbookings')
            ->select('hrbookings.*','holidayresorts.Type')
            ->join('holidayresorts','holidayresorts.HolodayResortId','=','hrbookings.HolodayResortId')
            ->where('CheckInDate', $request->input('CheckInDate'))
            ->orderBy('BookingId', 'DESC')
            ->paginate(10);
        }else{
            $hrbookings =DB::table('hrbookings')
            ->select('hrbookings.*','holidayresorts.Type')
            ->join('holidayresorts','holidayresorts.HolodayResortId','=','hrbookings.HolodayResortId')
            ->orderBy('BookingId', 'DESC')
            ->paginate(10);
          
        }
      
        
       
        return view('viewadminhrbooking',['hrbookings'=>$hrbookings]); 
        
       } 

      

       //confirm details
        public function confirm(Request $request,$BookingId) {

            $data = $BookingId;

            //$GuestId = DB::select('select GuestId from avubookings where BookingId = ?', [$data]);
            $GuestId = DB::table('hrbookings')->where('BookingId', [$BookingId])->value('GuestId');
            $email = DB::table('users')->where('id', [$GuestId])->value('email');
            

            $Status = 'Confirmed';
            DB::update('update hrbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
            echo "Record updated successfully.";
            echo 'Click Here to go back.';

            Mail::to($email)->send(new ConfirmMail($data));
            return back()->with('success', 'Message Sent Successfuly!');
            }


//reject booking
            public function reject(Request $request,$BookingId) {
                $data = $BookingId;
                $Status = 'Rejected';
                $GuestId = DB::table('hrbookings')->where('BookingId', [$BookingId])->value('GuestId');
                $email = DB::table('users')->where('id', [$GuestId])->value('email');

                DB::update('update hrbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                echo "Record updated successfully.
                ";
                echo 'Click Here to go back.';

                Mail::to($email)->send(new RejectMail($data));
                return back()->with('success', 'Message Sent Successfuly!');
                }

               
        //show selected details
                    public function showhr($id) {

                        $users =DB::table('hrbookings')
                        ->select('hrbookings.*','users.*','holidayresorts.Type')
                        ->join('users','users.id','=','hrbookings.GuestId')
                        ->join('holidayresorts','holidayresorts.HolodayResortId','=','hrbookings.HolodayResortId')
                        ->where(['hrbookings.BookingId' => $id])
                        ->get();
                        //$users = DB::select('select * from hrbookings where BookingId = ?',[$id]);
                        return view('hr_adminview',['users'=>$users]);
                        }

            //request vc aproval
                        public function vcapprove(Request $request,$BookingId) {
                            $data = $BookingId;
                            $Status = 'Request Vice Chancellor Approval';
                            
                          
                            DB::update('update hrbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                            echo "Record updated successfully.
                            ";
                            echo 'Click Here to go back.';
            
                            $email = DB::select('select email from users where roleNo = 2');
                
                            Mail::to($email)->send(new SendMail($data));
                            return back()->with('success', 'Message Sent Successfuly!');
                            }



}
