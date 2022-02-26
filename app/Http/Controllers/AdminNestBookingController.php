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

class AdminNestBookingController extends Controller
{
    //view nest bookings
        public function viewadminnestbooking(Request $request) { 
      
            if($request->input('CheckInDate') != null){
                $nestbookings =DB::table('nestbookings')
                ->select('nestbookings.*','nests.Type')
                ->join('nests','nests.NestId','=','nestbookings.NestId')
                ->where('CheckInDate', $request->input('CheckInDate'))
                ->orderBy('BookingId', 'DESC')
                ->paginate(10);
                    
            }else{
                $nestbookings =DB::table('nestbookings')
                ->select('nestbookings.*','nests.Type')
                ->join('nests','nests.NestId','=','nestbookings.NestId')
                ->orderBy('BookingId', 'DESC')
                ->paginate(10);
                    
            }


        return view('viewadminnestbooking',['nestbookings'=>$nestbookings]); 
   
       } 

       //confirm booking
       public function confirm(Request $request,$BookingId) {

        $data = $BookingId;

        //$GuestId = DB::select('select GuestId from avubookings where BookingId = ?', [$data]);
        $GuestId = DB::table('nestbookings')->where('BookingId', [$BookingId])->value('GuestId');
        $email = DB::table('users')->where('id', [$GuestId])->value('email');

        $Status = 'Confirmed';
        DB::update('update nestbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
        echo "Record updated successfully.";
        echo 'Click Here to go back.';

        Mail::to($email)->send(new ConfirmMail($data));
        return back()->with('success', 'Message Sent Successfuly!');
        }

        //reject booking
    public function reject(Request $request,$BookingId) {
            $data = $BookingId;
            $Status = 'Rejected';
            $GuestId = DB::table('nestbookings')->where('BookingId', [$BookingId])->value('GuestId');
            $email = DB::table('users')->where('id', [$GuestId])->value('email');

            DB::update('update nestbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
            echo "Record updated successfully.
            ";
            echo 'Click Here to go back.';

            Mail::to($email)->send(new RejectMail($data));
            return back()->with('success', 'Message Sent Successfuly!');
            }



        //show nest booking details
                    public function shownest($id) {

                        $users =DB::table('nestbookings')
                            ->select('nestbookings.*','users.*','nests.Type')
                            ->join('users','users.id','=','nestbookings.GuestId')
                            ->join('nests','nests.NestId','=','nestbookings.NestId')
                            ->where(['nestbookings.BookingId' => $id])
                            ->get();

                       // $users = DB::select('select * from nestbookings where BookingId = ?',[$id]);
                        return view('nest_adminview',['users'=>$users]);
                        }

                    
        //request vc approval
                        public function vcapprove(Request $request,$BookingId) {
                            $data = $BookingId;
                            $Status = 'Request Vice Chancellor Approval';
                            
            
                            DB::update('update nestbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                            echo "Record updated successfully.
                            ";
                            echo 'Click Here to go back.';
            
                            $email = DB::select('select email from users where roleNo = 2');
                
                            Mail::to($email)->send(new SendMail($data));
                            return back()->with('success', 'Message Sent Successfuly!');
                            }
                        
                        

}
