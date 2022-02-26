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



class AdminDBookingController extends Controller
{
      //view agri farm dinning room booking details
       public function viewadminafdbooking(Request $request) { 


        if($request->input('CheckInDate') != null){
            $agridbookings =DB::table('agridbookings')
            ->select('agridbookings.*','users.name')
            ->join('users','users.id','=','agridbookings.Recommendation_From')
            ->where('CheckInDate', $request->input('CheckInDate'))
            ->orderBy('BookingId', 'DESC')
            ->paginate(10);
        }else{
            $agridbookings =DB::table('agridbookings')
            ->select('agridbookings.*','users.name')
            ->join('users','users.id','=','agridbookings.Recommendation_From')
            ->orderBy('BookingId', 'DESC')
            ->paginate(10);
        }
      
       

    
       
        return view('viewadminafdbooking',['agridbookings'=>$agridbookings]); 
   
       } 
     
       
//confirm booking
       public function confirm(Request $request,$BookingId) {

        $data = $BookingId;

        //$GuestId = DB::select('select GuestId from agridbookings where BookingId = ?', [$data]);
        $GuestId = DB::table('agridbookings')->where('BookingId', [$BookingId])->value('GuestId');
        $email = DB::table('users')->where('id', [$GuestId])->value('email');
        //$email = DB::select('select email from users where id = ?', [$GuestId]);

        $Status = 'Confirmed';
        DB::update('update agridbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
        echo "Record updated successfully.";
        echo 'Click Here to go back.';

        Mail::to($email)->send(new ConfirmMail($data));
        return back()->with('success', 'Message Sent Successfuly!');
        }


//reject booking
        public function reject(Request $request,$BookingId) {
            $data = $BookingId;
            $Status = 'Rejected';
            $GuestId = DB::table('agridbookings')->where('BookingId', [$BookingId])->value('GuestId');
            $email = DB::table('users')->where('id', [$GuestId])->value('email');

            DB::update('update agridbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
            echo "Record updated successfully.
            ";
            echo 'Click Here to go back.';

            Mail::to($email)->send(new RejectMail($data));
            return back()->with('success', 'Message Sent Successfuly!');
            }
         
//show selected details
                public function show($id) {

                    $users =DB::table('agridbookings')
                    ->select('agridbookings.*','users.*')
                    ->join('users','users.id','=','agridbookings.GuestId')
                    ->where(['agridbookings.BookingId' => $id])
                    ->get();


                           // $users = DB::select('select * from agridbookings where BookingId = ?',[$id]);
                         return view('afd_adminview',['users'=>$users]);
                }

                        
//request vc approval
                    public function vcapprove(Request $request,$BookingId) {
                                $data = $BookingId;
                                $Status = 'Request Vice Chancellor Approval';
                                
                
                                DB::update('update agridbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                                echo "Record updated successfully.
                                ";
                                echo 'Click Here to go back.';
                
                                $email = DB::select('select email from users where roleNo = 2');
                
                                Mail::to($email)->send(new SendMail($data));
                                return back()->with('success', 'Message Sent Successfuly!');
                                }
                            
                            

}
