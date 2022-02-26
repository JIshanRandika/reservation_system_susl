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
use PDF;
use Carbon\Carbon;
use App\Mail\RequestRecommendMail;

class ViewAVUBookingController extends Controller
{
   

       public function viewavubooking(Request $request) { 
      
       //$avubookings = DB::select('select * from avubookings');


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
        
        // $avubookings = DB::table('avubookings')
        // ->join('users', 'avubookings.Recommendation_From', '=', 'users.id')
        // ->select('avubookings.*', 'users.name')
        // ->get();

        return view('viewavubooking',['avubookings'=>$avubookings]); 
       } 

       

       
       public function viewreportavubooking(Request $request) { 
      
        
 
        if($request->input('CheckInDate') != null){
         $avubookings =DB::table('avubookings')
         ->select('avubookings.*','users.name','audiovisualunits.Type')
         ->join('users','users.id','=','avubookings.Recommendation_From')
         ->join('audiovisualunits','audiovisualunits.AVUId','=','avubookings.AVUId')
         ->where('CheckInDate', $request->input('CheckInDate'))
         ->paginate(10);
     }
     
     else{
         $avubookings =DB::table('avubookings')
         ->select('avubookings.*','users.name','audiovisualunits.Type')
         ->join('users','users.id','=','avubookings.Recommendation_From')
         ->join('audiovisualunits','audiovisualunits.AVUId','=','avubookings.AVUId')
         ->paginate(10);
     }
         
         return view('viewreportavubooking',['avubookings'=>$avubookings]); 
        }

       public function downloadpdf(Request $request) { 
      
        if($request->input('CheckInDate') != null){
            $avubookings =DB::table('avubookings')
            ->select('avubookings.*','users.name','audiovisualunits.Type')
            ->join('users','users.id','=','avubookings.Recommendation_From')
            ->join('audiovisualunits','audiovisualunits.AVUId','=','avubookings.AVUId')
            ->where('CheckInDate', $request->input('CheckInDate'))
            ->get();
        }else{
            $avubookings =DB::table('avubookings')
            ->select('avubookings.*','users.name','audiovisualunits.Type')
            ->join('users','users.id','=','avubookings.Recommendation_From')
            ->join('audiovisualunits','audiovisualunits.AVUId','=','avubookings.AVUId')
            ->get();
        }

        view()->share('avubookings',$avubookings);
        $pdf = PDF::loadView('viewavubooking_pdf',compact($avubookings));
        
        return $pdf->download('details.pdf');
        
   
       } 

       public function downloadmonthpdf(Request $request) { 

     
     
            $avubookings =DB::table('avubookings')
            ->select('avubookings.*','users.name','audiovisualunits.Type')
            ->join('users','users.id','=','avubookings.Recommendation_From')
            ->join('audiovisualunits','audiovisualunits.AVUId','=','avubookings.AVUId')
            ->whereMonth('CheckInDate',Carbon::now()->month)
            ->get();
      
        
        view()->share('avubookings',$avubookings);
        $pdf = PDF::loadView('viewavubooking_pdf',compact($avubookings));
        
        return $pdf->download('details.pdf');
         
   
       } 


       public function downloadyearpdf(Request $request) { 

        $avubookings =DB::table('avubookings')
        ->select('avubookings.*','users.name','audiovisualunits.Type')
        ->join('users','users.id','=','avubookings.Recommendation_From')
        ->join('audiovisualunits','audiovisualunits.AVUId','=','avubookings.AVUId')
        ->whereYear('CheckInDate',Carbon::now()->year)
        ->get();
     
    
        view()->share('avubookings',$avubookings);
        $pdf = PDF::loadView('viewavubooking_pdf',compact($avubookings));
        
        return $pdf->download('details.pdf');
     

   } 


       public function viewSelectavubooking($BookingId) { 
      
        $avubookings = DB::select('select * from avubookings where BookingId = ?', [$BookingId]);
        
       

        return view('viewSelectavubooking',['avubookings'=>$avubookings]); 
       } 

       
       public function viewguestavubooking(Request $request) { 
        
        //$Recommendation_From = Auth::user()->roleNo;
        //$Recommendation_From = Auth::roleNo();
        $GuestId = Auth::id();

        if($request->input('CheckInDate') != null){
           

            $avubookings =DB::table('avubookings')
            ->select('avubookings.*','users.name','audiovisualunits.Type')
            ->join('users','users.id','=','avubookings.Recommendation_From')
            ->join('audiovisualunits','audiovisualunits.AVUId','=','avubookings.AVUId')
            ->where(['avubookings.GuestId' => $GuestId])
            ->where('CheckInDate', $request->input('CheckInDate'))
            ->orderBy('avubookings.BookingId', 'DESC')
            ->paginate(10);

        }else{
            $avubookings =DB::table('avubookings')
            ->select('avubookings.*','users.name','audiovisualunits.Type')
            ->join('users','users.id','=','avubookings.Recommendation_From')
            ->join('audiovisualunits','audiovisualunits.AVUId','=','avubookings.AVUId')
            ->where(['avubookings.GuestId' => $GuestId])
            ->orderBy('avubookings.BookingId','DESC')
            ->paginate(10);
        }
 
        
      

        //$avubookings = DB::select('select * from avubookings where Recommendation_From = ?', [$Recommendation_From]);
         
        
 
         return view('viewguestavubooking',['avubookings'=>$avubookings]); 
        } 

       public function viewdeanhodavubooking(Request $request) { 
        
        //$Recommendation_From = Auth::user()->roleNo;
        //$Recommendation_From = Auth::roleNo();
        $Recommendation_From = Auth::id();

        if($request->input('CheckInDate') != null){
           

            $avubookings =DB::table('avubookings')
            ->select('avubookings.*','users.name','audiovisualunits.Type')
            ->join('users','users.id','=','avubookings.Recommendation_From')
            ->join('audiovisualunits','audiovisualunits.AVUId','=','avubookings.AVUId')
            ->where(['avubookings.Recommendation_From' => $Recommendation_From])
            ->where('CheckInDate', $request->input('CheckInDate'))
            ->orderBy('avubookings.BookingId', 'DESC')
            ->paginate(10);

        }else{
            $avubookings =DB::table('avubookings')
            ->select('avubookings.*','users.name','audiovisualunits.Type')
            ->join('users','users.id','=','avubookings.Recommendation_From')
            ->join('audiovisualunits','audiovisualunits.AVUId','=','avubookings.AVUId')
            ->where(['avubookings.Recommendation_From' => $Recommendation_From])
            ->orderBy('avubookings.BookingId','DESC')
            ->paginate(10);
        }
 
        
      

        //$avubookings = DB::select('select * from avubookings where Recommendation_From = ?', [$Recommendation_From]);
         
        
 
         return view('viewdeanhodavubooking',['avubookings'=>$avubookings]); 
        } 

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


                public function recommend(Request $request,$BookingId) {

                        $data = $BookingId;
        
                    $Status = 'Recommended';
                    DB::update('update avubookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                    echo "Record updated successfully.";
                    echo 'Click Here to go back.';
        
                   
                    return back()->with('success', 'Updated Successfuly!');
                    }
        
                public function notrecommend(Request $request,$BookingId) {
                        $data = $BookingId;
                        $Status = 'Not Recommended';
                        DB::update('update avubookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                        echo "Record updated successfully.
                        ";
                        echo 'Click Here to go back.';
        
                        
                        return back()->with('success', 'Updated Successfuly!');
                        }

                        public function showavudean($id) {

                            $users =DB::table('avubookings')
                            ->select('avubookings.*','users.*','audiovisualunits.Type')
                            ->join('users','users.id','=','avubookings.GuestId')
                            ->join('audiovisualunits','audiovisualunits.AVUId','=','avubookings.AVUId')
                            ->where(['avubookings.BookingId' => $id])
                            ->get();
    
                               
                                return view('avudean_view',['users'=>$users]);
                        }

                        public function addheadcomment(Request $request,$BookingId) {
          
                            $HODComment = $request->input('HODComment');
                            DB::update('update avubookings set HODComment=? where BookingId = ?',[$HODComment,$BookingId]);
                            echo "Record updated successfully.
                            ";
                            echo 'Click Here to go back.';

                            return back()->with('success', 'Message Sent Successfuly!');
                            }

                            public function getRecommendation(Request $request,$BookingId) {
                                $data = $BookingId;
                                $Status = 'Send to Recommendation';
                                
                
                                DB::update('update avubookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                                echo "Record updated successfully.
                                ";
                                echo 'Click Here to go back.';
    
                                $email =DB::table('avubookings')
                                ->select('users.email')
                                ->join('users','users.id','=','avubookings.Recommendation_From')
                                ->where(['avubookings.BookingId' => $BookingId])
                                ->get();
    
                               
                                Mail::to($email)->send(new RequestRecommendMail($data));
                                return back()->with('success', 'Message Sent Successfuly!');
                                }
}
