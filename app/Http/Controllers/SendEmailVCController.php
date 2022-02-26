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
use App\Models\agrsbooking;
use PDF;
use Carbon\Carbon;
use App\Mail\RequestRecommendMail;

class SendEmailVCController extends Controller
{
  //view agri farm booking details from agri coordinator side
        public function viewagribooking(Request $request) { 
        
            if($request->input('CheckInDate') != null){
                $agrsbookings = agrsbooking::whereDate('CheckInDate', $request->input('CheckInDate'))->orderBy('BookingId', 'DESC')->paginate(10);
            }else{
                $agrsbookings = agrsbooking::orderBy('BookingId', 'DESC')->paginate(10);
            }
        

            return view('viewagribooking',['agrsbookings'=>$agrsbookings]); 
        } 
        
        
        //view agri booking details in guest side
        public function viewguestagribooking(Request $request) { 
                    
                    
            $GuestId = Auth::id();

            
            if($request->input('CheckInDate') != null){
                
                $agrsbookings = agrsbooking::where('GuestId', '=', [$GuestId])->whereDate('CheckInDate', $request->input('CheckInDate'))->paginate(10);
        
            }else{
                
                $agrsbookings = agrsbooking::where('GuestId', '=', [$GuestId])->orderBy('BookingId', 'DESC')->paginate(10);
        
            }

            return view('viewguestagribooking',['agrsbookings'=>$agrsbookings]); 
        }
    
    
        //load agri booking details in vc page
        public function viewvcagribooking(Request $request) { 

            if($request->input('CheckInDate') != null){
                $agrsbookings = agrsbooking::whereDate('CheckInDate', $request->input('CheckInDate'))->orderBy('BookingId', 'DESC')->paginate(10);
            }else{
                $agrsbookings = agrsbooking::orderBy('BookingId', 'DESC')->paginate(10);
            }
    
        
           
        
            return view('viewvcagribooking',['agrsbookings'=>$agrsbookings]); 
    
        }

        //view agri booking details in dean/hod side
        public function viewdeanhodagrisbooking(Request $request) { 
            
            
            $Recommendation_From = Auth::id();

            
            if($request->input('CheckInDate') != null){
                
                $agrsbookings = agrsbooking::where('Recommendation_From', '=', [$Recommendation_From])->whereDate('CheckInDate', $request->input('CheckInDate'))->paginate(10);
           
            }else{
                
                $agrsbookings = agrsbooking::where('Recommendation_From', '=', [$Recommendation_From])->orderBy('BookingId', 'DESC')->paginate(10);
           
            }
            
           
            
    
            return view('viewdeanhodagrisbooking',['agrsbookings'=>$agrsbookings]); 
            } 

            public function viewreportagribooking(Request $request) { 

                if($request->input('CheckInDate') != null  && $request->input('CheckOutDate') != null){
                    $agrsbookings =DB::table('agrsbookings')
                    ->select('agrsbookings.*')
                    ->whereDate('CheckInDate', '>=', $request->input('CheckInDate'))
                    ->whereDate('CheckOutDate', '<=', $request->input('CheckOutDate'))
                    ->paginate(10);
                }

                else if($request->input('CheckInDate') != null  ){
                    $agrsbookings =DB::table('agrsbookings')
                    ->select('agrsbookings.*')
                    ->where('CheckInDate',  $request->input('CheckInDate'))
                    ->paginate(10);
                }
                else if( $request->input('CheckOutDate') != null){
                    $agrsbookings =DB::table('agrsbookings')
                    ->select('agrsbookings.*')
                    ->where('CheckOutDate',  $request->input('CheckOutDate'))
                    ->paginate(10);
                }
                else{
                    $agrsbookings =DB::table('agrsbookings')
                    ->select('agrsbookings.*')
                    ->paginate(10);
                  
                }
        
                // if($request->input('CheckInDate') != null && $request->input('CheckOutDate') != null){
                //     $agrsbookings = agrsbooking::whereDate('CheckInDate', '>=',  $request->input('CheckInDate'))
                //     ->whereDate('CheckOutDate', '<=',  $request->input('CheckOutDate'))
                //     ->get();
                // }
                // else if($request->input('CheckInDate') != null){
                //     $agrsbookings = agrsbooking::whereDate('CheckInDate', $request->input('CheckInDate'))->paginate(10);
                // }
                // else if($request->input('CheckOutDate') != null){
                //     $agrsbookings = agrsbooking::whereDate('CheckOutDate', $request->input('CheckOutDate'))->paginate(10);
                // }else{
                //     $agrsbookings = agrsbooking::orderBy('BookingId', 'DESC')->paginate(10);
                // }
            
    
                return view('viewreportagribooking',['agrsbookings'=>$agrsbookings]); 
            } 
            public function downloadpdf(Request $request) { 


                if($request->input('CheckInDate') != null  && $request->input('CheckOutDate') != null){
                    $agrsbookings =DB::table('agrsbookings')
                    ->select('agrsbookings.*')
                    ->whereDate('CheckInDate', '>=', $request->input('CheckInDate'))
                    ->whereDate('CheckOutDate', '<=', $request->input('CheckOutDate'))
                    ->paginate(10);
                }

                else if($request->input('CheckInDate') != null  ){
                    $agrsbookings =DB::table('agrsbookings')
                    ->select('agrsbookings.*')
                    ->where('CheckInDate',  $request->input('CheckInDate'))
                    ->paginate(10);
                }
                else if( $request->input('CheckOutDate') != null){
                    $agrsbookings =DB::table('agrsbookings')
                    ->select('agrsbookings.*')
                    ->where('CheckOutDate',  $request->input('CheckOutDate'))
                    ->paginate(10);
                }
                else{
                    $agrsbookings =DB::table('agrsbookings')
                    ->select('agrsbookings.*')
                    ->paginate(10);
                  
                }
      
                // if($request->input('CheckInDate') != null && $request->input('CheckOutDate') != null){
                //     $agrsbookings = agrsbooking::whereDate('CheckInDate', '>=',  $request->input('CheckInDate'))
                //     ->whereDate('CheckOutDate', '<=',  $request->input('CheckOutDate'))
                //     ->get();
                // }
                // else if($request->input('CheckInDate') != null){
                //     $agrsbookings = agrsbooking::whereDate('CheckInDate', $request->input('CheckInDate'))->grt();
                // }
                // else if($request->input('CheckOutDate') != null){
                //     $agrsbookings = agrsbooking::whereDate('CheckOutDate', $request->input('CheckOutDate'))->get();
                // }else{
                //     $agrsbookings = agrsbooking::get();
                // }

            
        
                view()->share('agrsbookings',$agrsbookings);
                $pdf = PDF::loadView('viewagribooking_pdf',compact($agrsbookings));
                
                return $pdf->download('details.pdf');
                
           
               } 
        
               public function downloadmonthpdf(Request $request) { 
        
             
                $agrsbookings = agrsbooking::whereMonth('CheckInDate',Carbon::now()->month)->get();
                
                view()->share('agrsbookings',$agrsbookings);
                $pdf = PDF::loadView('viewagribooking_pdf',compact($agrsbookings));
                
                return $pdf->download('details.pdf');
                 
           
               } 
        
        
               public function downloadyearpdf(Request $request) { 
        
             
                $agrsbookings = agrsbooking::whereYear('CheckInDate',Carbon::now()->year)->get();
            
                view()->share('agrsbookings',$agrsbookings);
                $pdf = PDF::loadView('viewagribooking_pdf',compact($agrsbookings));
                
                return $pdf->download('details.pdf');
             
        
           } 
        

//confirm booking
            public function confirm(Request $request,$BookingId) {

                $data = $BookingId;

                //$GuestId = DB::select('select GuestId from avubookings where BookingId = ?', [$data]);
                $GuestId = DB::table('agrsbookings')->where('BookingId', [$BookingId])->value('GuestId');
                $email = DB::table('users')->where('id', [$GuestId])->value('email');
                //$email = DB::select('select email from users where id = ?', [$GuestId]);

                $Status = 'Confirmed';
                DB::update('update agrsbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                echo "Record updated successfully.";
                echo 'Click Here to go back.';

                Mail::to($email)->send(new ConfirmMail($data));
                return back()->with('success', 'Message Sent Successfuly!');
                }


        //reject booking
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

                    //recomend the request by hod/dean
                    public function recommend(Request $request,$BookingId) {

                        $data = $BookingId;
        
                    $Status = 'Recommended';
                    DB::update('update agrsbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                    echo "Record updated successfully.";
                    echo 'Click Here to go back.';
        
                
                    return back()->with('success', 'Updated Successfuly!');
                    }

                    //reject the request by dean/hod
                    public function notrecommend(Request $request,$BookingId) {
                        $data = $BookingId;
                        $Status = 'Not Recommended';
                        DB::update('update agrsbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                        echo "Record updated successfully.
                        ";
                        echo 'Click Here to go back.';
        
                        
                        return back()->with('success', 'Updated Successfuly!');
                        }

                        //approve the booking by vc side
                        public function afsapprove(Request $request,$BookingId) {

                            $data = $BookingId;
            
                        $Status = 'Approved By Vice Chancellor';
                        DB::update('update agrsbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                        echo "Record updated successfully.";
                        echo 'Click Here to go back.';
            
                    
                        return back()->with('success', 'Updated Successfuly!');
                        }


                        //reject the request by vc
                        public function afsnotapprove(Request $request,$BookingId) {
                            $data = $BookingId;
                            $Status = 'Not Approved';
                            DB::update('update agrsbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                            echo "Record updated successfully.
                            ";
                            echo 'Click Here to go back.';
            
                            
                            return back()->with('success', 'Updated Successfuly!');
                            }
                            public function addvccomment(Request $request,$BookingId) {
          
                                $VCComment = $request->input('VCComment');
                                DB::update('update agrsbookings set VCComment=? where BookingId = ?',[$VCComment,$BookingId]);
                                echo "Record updated successfully.
                                ";
                                echo 'Click Here to go back.';

                                return back()->with('success', 'Message Sent Successfuly!');
                                }

                        //show selected booking details in vc side    
                        public function showafsvc($id) {

                            $users =DB::table('agrsbookings')
                                    ->select('agrsbookings.*','users.*')
                                    ->join('users','users.id','=','agrsbookings.GuestId')
                                    ->where(['agrsbookings.BookingId' => $id])
                                    ->get();

                                
                                return view('afsvc_view',['users'=>$users]);
                                }

                        public function showaf($id) {

                            $users =DB::table('agrsbookings')
                                    ->select('agrsbookings.*','users.*')
                                    ->join('users','users.id','=','agrsbookings.GuestId')
                                    ->where(['agrsbookings.BookingId' => $id])
                                    ->get();

                            //$users = DB::select('select * from agrsbookings where BookingId = ?',[$id]);
                            return view('af_view',['users'=>$users]);
                            }

                            //request vc approve
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
                                public function showafdean($id) {

                                    $users =DB::table('agrsbookings')
                                    ->select('agrsbookings.*','users.*')
                                    ->join('users','users.id','=','agrsbookings.GuestId')
                                    ->where(['agrsbookings.BookingId' => $id])
                                    ->get();
            
                                       
                                        return view('afsdean_view',['users'=>$users]);
                                }
        
                                public function addheadcomment(Request $request,$BookingId) {
                  
                                    $HODComment = $request->input('HODComment');
                                    DB::update('update agrsbookings set HODComment=? where BookingId = ?',[$HODComment,$BookingId]);
                                    echo "Record updated successfully.
                                    ";
                                    echo 'Click Here to go back.';
        
                                    return back()->with('success', 'Message Sent Successfuly!');
                                    }


                                    public function getRecommendation(Request $request,$BookingId) {
                                        $data = $BookingId;
                                        $Status = 'Send to Recommendation';
                                        
                        
                                        DB::update('update agrsbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                                        echo "Record updated successfully.
                                        ";
                                        echo 'Click Here to go back.';
            
                                        $email =DB::table('agrsbookings')
                                        ->select('users.email')
                                        ->join('users','users.id','=','agrsbookings.Recommendation_From')
                                        ->where(['agrsbookings.BookingId' => $BookingId])
                                        ->get();
            
                                       
                                        Mail::to($email)->send(new RequestRecommendMail($data));
                                        return back()->with('success', 'Message Sent Successfuly!');
                                        }


    public function requestPayment($id){
        $status='Payment Requested';
        $state =DB::update('update agrsbookings set Status = ? where BookingId = ?',[$status,$id]);
        if($state!=1) return redirect()->back()->with('success', 'Somthing went wrong');
        return redirect()->back()->with('success', 'Payment requested invitation send successfully!');
    }
            
}
