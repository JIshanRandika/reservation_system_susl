<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\holidayresort;
use App\Models\hrbooking;
use App\Models\nest;
use App\Models\nestbooking;
use App\Models\agrifarmstay;
use App\Models\agrsbooking;
use App\Models\agrifarmdining;
use App\Models\agridbooking;
use App\Models\audiovisualunit;
use App\Models\avubooking;
use Auth;
use DB;

use App\Models\User;

class PagesController extends Controller
{
    public function getHome(){

        $hr = holidayresort::all();
        $hrdetail = DB::select('select * from holidayresorts');
        $hrfill = [];
        foreach($hrdetail as $n){
            $hrfill[$n->HolodayResortId] = $n->Type;
        }

        $nest = nest::all();
        $nestdetail = DB::select('select * from nests');
        $nestfill = [];
        foreach($nestdetail as $n){
            $nestfill[$n->NestId] = $n->Type;
        }
       // return view('home');
        return view('home', compact('hrfill','hr','nestfill','nest'));
    }

    

    public function checkavailable(Request $request){

        Session::put('CheckAvailabilityRequest', $request->input());

        if($request->input('property') == 'Holiday Resort'){
               
            
            $this->validate($request,[
                'CheckInDate'=>'required|date|after:yesterday',
                'CheckOutDate'=>'required|date|after:CheckInDate',
                'NoOfAdults'=>'required|numeric|min:1',
                'NoOfChildren'=>'required|numeric|min:0',
                'NoOfUnits'=>'required|numeric|min:1',
                'HolodayResortId'=>'required',
            ],
            [
                'CheckInDate.after' => 'Please Enter a Valid Date',
                'CheckOutDate.after' => 'Please Enter a Valid Date',
                'NoOfAdults.required' => 'Please Enter The Number of Adults',
                'NoOfChildren.required' => 'Please Enter The Number of Children',
                'NoOfUnits.required' => 'Please Enter The Number of Units',
            ]);
    
            
    
            if($request->input('HolodayResortId') == 1){
    
                $CheckInDate = hrbooking::whereDate('CheckInDate', '<=', $request->input('CheckInDate'))->whereDate('CheckOutDate', '>=', $request->input('CheckInDate'))->where('HolodayResortId', '1')->where('Status', 'Confirmed')->get();
                $CheckInDate2 = hrbooking::whereDate('CheckInDate', '>=', $request->input('CheckInDate'))->whereDate('CheckInDate', '<=', $request->input('CheckOutDate'))->where('HolodayResortId', '1')->where('Status', 'Confirmed')->get();
            
    
                $check_cndition1 = $CheckInDate->sum('NoOfUnits') + $request->input('NoOfUnits');
                $check_cndition2 = $CheckInDate2->sum('NoOfUnits') + $request->input('NoOfUnits');
                $check_cndition3 = ($CheckInDate->sum('NoOfUnits') + $CheckInDate2->sum('NoOfUnits')) + $request->input('NoOfUnits');
                
                if( $check_cndition1 > 7 || $check_cndition2 > 7 || $check_cndition3 > 7){
                     return redirect()->back()->with(session()->flash('alert-danger', 'Sorry already booked!'));
                 }else{

                    if (Auth::check()) {
                       return redirect('/hr')->with(session()->flash('alert-success', 'Available'));
                     
                        
                    }
                    return redirect('/login')->with(session()->flash('alert-success', 'Available.Please loggin to the system for booking.'));
                   
                    
                }

        }

            if($request->input('HolodayResortId') == 2){
        
                $CheckInDate = hrbooking::whereDate('CheckInDate', '<=', $request->input('CheckInDate'))->whereDate('CheckOutDate', '>=', $request->input('CheckInDate'))->where('HolodayResortId', '2')->where('Status', 'Confirmed')->get();
                $CheckInDate2 = hrbooking::whereDate('CheckInDate', '>=', $request->input('CheckInDate'))->whereDate('CheckInDate', '<=', $request->input('CheckOutDate'))->where('HolodayResortId', '2')->where('Status', 'Confirmed')->get();
            

                $check_cndition1 = $CheckInDate->sum('NoOfUnits') + $request->input('NoOfUnits');
                $check_cndition2 = $CheckInDate2->sum('NoOfUnits') + $request->input('NoOfUnits');
                $check_cndition3 = ($CheckInDate->sum('NoOfUnits') + $CheckInDate2->sum('NoOfUnits')) + $request->input('NoOfUnits');
                
                if( $check_cndition1 > 28 || $check_cndition2 > 28 || $check_cndition3 >28){
                    return redirect()->back()->with(session()->flash('alert-danger', 'Sorry already booked!'));
                }else{
                
                    if (Auth::check()) {
                        return redirect('/hr')->with(session()->flash('alert-success', 'Available'));
                    }
                   
                    return redirect('/login')->with(session()->flash('alert-success', 'Available.Please loggin to the system for booking.'));
                    
                }

        }
    }



    if($request->input('property') == 'NEST'){           
            
        $this->validate($request,[
            'CheckInDate'=>'required|date|after:yesterday',
            'CheckOutDate'=>'required|date|after:CheckInDate',
            'NoOfAdults'=>'required|numeric|min:1',
            'NoOfChildren'=>'required|numeric|min:0',
            'NoOfUnits'=>'required|numeric|min:1',
            'NestId'=>'required',
        ],
        [
            'CheckInDate.after' => 'Please Enter a Valid Date',
            'CheckOutDate.after' => 'Please Enter a Valid Date',
            'NoOfAdults.required' => 'Please Enter The Number of Adults',
            'NoOfChildren.required' => 'Please Enter The Number of Children',
            'NoOfUnits.required' => 'Please Enter The Number of Units',
        ]);

        

        if($request->input('NestId') == 1){

            $CheckInDate = nestbooking::whereDate('CheckInDate', '<=', $request->input('CheckInDate'))->whereDate('CheckOutDate', '>=', $request->input('CheckInDate'))->where('Status', 'Confirmed')->get();
            $CheckInDate2 = nestbooking::whereDate('CheckInDate', '>=', $request->input('CheckInDate'))->whereDate('CheckInDate', '<=', $request->input('CheckOutDate'))->where('Status', 'Confirmed')->get();
        

            $check_cndition1 = $CheckInDate->sum('NoOfUnits') + $request->input('NoOfUnits');
            $check_cndition2 = $CheckInDate2->sum('NoOfUnits') + $request->input('NoOfUnits');
            $check_cndition3 = ($CheckInDate->sum('NoOfUnits') + $CheckInDate2->sum('NoOfUnits')) + $request->input('NoOfUnits');
            
            if( $check_cndition1 > 1 || $check_cndition2 > 1 || $check_cndition3 > 1){
                 return redirect()->back()->with(session()->flash('alert-danger', 'Sorry already booked!'));
             }else{
            
                if (Auth::check()) {
                    return redirect('/nest')->with(session()->flash('alert-success', 'Available'));
                }
               
                return redirect('/login')->with(session()->flash('alert-success', 'Available.Please loggin to the system for booking.'));
                
             }

    }

        if($request->input('NestId') == 2){
    
            $CheckInDate = nestbooking::whereDate('CheckInDate', '<=', $request->input('CheckInDate'))->whereDate('CheckOutDate', '>=', $request->input('CheckInDate'))->where('Status', 'Confirmed')->get();
            $CheckInDate2 = nestbooking::whereDate('CheckInDate', '>=', $request->input('CheckInDate'))->whereDate('CheckInDate', '<=', $request->input('CheckOutDate'))->where('Status', 'Confirmed')->get();
        

            $check_cndition1 = $CheckInDate->sum('NoOfUnits') + $request->input('NoOfUnits');
            $check_cndition2 = $CheckInDate2->sum('NoOfUnits') + $request->input('NoOfUnits');
            $check_cndition3 = ($CheckInDate->sum('NoOfUnits') + $CheckInDate2->sum('NoOfUnits')) + $request->input('NoOfUnits');
            
            if( $check_cndition1 > 4 || $check_cndition2 > 4 || $check_cndition3 >4){
                return redirect()->back()->with(session()->flash('alert-danger', 'Sorry already booked!'));
            }else{
            
                if (Auth::check()) {
                    return redirect('/nest')->with(session()->flash('alert-success', 'Available'));
                }
               
                return redirect('/login')->with(session()->flash('alert-success', 'Available.Please loggin to the system for booking.'));
                
            }

    }
}


if($request->input('property') == 'Agri Farm Kabana'){
               
            
    $this->validate($request,[
        'CheckInDate'=>'required|date|after:yesterday',
        'CheckOutDate'=>'required|date|after:CheckInDate',
        'NoOfAdults'=>'required|numeric|min:1',
        'NoOfChildren'=>'required|numeric|min:0',
        'NoOfUnits'=>'required|numeric|min:1',
    ],
    [
        'CheckInDate.after' => 'Please Enter a Valid Date',
        'CheckOutDate.after' => 'Please Enter a Valid Date',
        'NoOfAdults.required' => 'Please Enter The Number of Adults',
        'NoOfChildren.required' => 'Please Enter The Number of Children',
        'NoOfUnits.required' => 'Please Enter The Number of Units',
    ]);

    

   

        $CheckInDate = agrsbooking::whereDate('CheckInDate', '<=', $request->input('CheckInDate'))->whereDate('CheckOutDate', '>=', $request->input('CheckInDate'))->where('Status', 'Confirmed')->get();
        $CheckInDate2 = agrsbooking::whereDate('CheckInDate', '>=', $request->input('CheckInDate'))->whereDate('CheckInDate', '<=', $request->input('CheckOutDate'))->where('Status', 'Confirmed')->get();
    

        $check_cndition1 = $CheckInDate->sum('NoOfUnits') + $request->input('NoOfUnits');
        $check_cndition2 = $CheckInDate2->sum('NoOfUnits') + $request->input('NoOfUnits');
        $check_cndition3 = ($CheckInDate->sum('NoOfUnits') + $CheckInDate2->sum('NoOfUnits')) + $request->input('NoOfUnits');
        
        if( $check_cndition1 > 3 || $check_cndition2 > 3 || $check_cndition3 > 3){
             return redirect()->back()->with(session()->flash('alert-danger', 'Sorry already booked!'));
         }else{
        
            if (Auth::check()) {
                return redirect('/af')->with(session()->flash('alert-success', 'Available'));
            }
           
            return redirect('/login')->with(session()->flash('alert-success', 'Available.Please loggin to the system for booking.'));
            
         }



 
}




if($request->input('property') == 'Agri Farm Dining Room'){
               
    $current = strtotime(date("Y-m-d"));
    $date    = strtotime($request->input('CheckInDate'));

    $datediff = $date - $current;
    $difference = floor($datediff/(60*60*24));

    if($difference == 0){
    $this->validate($request,[
        
        'CheckInDate'=>'required|date|after:yesterday',
        'StartTime'=>'required|after:CurrentTime',
        //'StartTime'=>'required|after:CurrentTime',
        'EndTime'=>'required|after:StartTime',
    ],
    [
        'CheckInDate.after' => 'Please Enter a Valid Date',
        'StartTime.after' => 'Please Enter a Valid Start Time',
        'EndTime.after' => 'Please Enter a Valid End Time',
    ]);
    
    }
    else{
            
        $this->validate($request,[
            
            'CheckInDate'=>'required|date|after:yesterday',
            'StartTime'=>'required',
            //'StartTime'=>'required|after:CurrentTime',
            'EndTime'=>'required|after:StartTime',
        ],
        [
            'CheckInDate.after' => 'Please Enter a Valid Date',
            'StartTime.after' => 'Please Enter a Valid Start Time',
            'EndTime.after' => 'Please Enter a Valid End Time',
        ]);
    }
                                    
   $CheckInDate = agridbooking::where('CheckInDate', '=', $request->input('CheckInDate'))->first();
    
    if ($CheckInDate === null) {
    
        if (Auth::check()) {
            return redirect('/afd')->with(session()->flash('alert-success', 'Available'));
        }
       
        return redirect('/login')->with(session()->flash('alert-success', 'Available.Please loggin to the system for booking.'));
        ;
        
        
    }else{
        $CheckInDate = agridbooking::whereTime('StartTime', '<', $request->input('StartTime'))->whereTime('EndTime', '>', $request->input('StartTime'))->where('CheckInDate', '=', $request->input('CheckInDate'))->where('Status', 'Confirmed')->get();
        $CheckInDate2 = agridbooking::whereTime('StartTime', '>', $request->input('StartTime'))->whereTime('StartTime', '<', $request->input('EndTime'))->where('CheckInDate', '=', $request->input('CheckInDate'))->where('Status', 'Confirmed')->get();
       
        if(count($CheckInDate) > 0 || count($CheckInDate2) > 0){
          
            return redirect()->back()->with(session()->flash('alert-danger', 'Sorry already booked!'));

        }else{
            if (Auth::check()) {
                return redirect('/afd')->with(session()->flash('alert-success', 'Available'));
            }
           
            return redirect('/login')->with(session()->flash('alert-success', 'Available.Please loggin to the system for booking.'));
            ;
         }
        }
    
 
    }


    if($request->input('property') == 'Audio Visual Unit'){
             
        $current = strtotime(date("Y-m-d"));
        $date    = strtotime($request->input('CheckInDate'));
    
        $datediff = $date - $current;
        $difference = floor($datediff/(60*60*24));
    
        if($difference == 0){   
            $this->validate($request,[
                
                'CheckInDate'=>'required|date|after:yesterday',
                'StartTime'=>'required|after:CurrentTime',
                'EndTime'=>'required|after:StartTime',
            ],
            [
                'CheckInDate.after' => 'Please Enter a Valid Date',
                'StartTime.after' => 'Please Enter a Valid Start Time',
                'EndTime.after' => 'Please Enter a Valid End Time',
            ]);
        }
        else{
                
            $this->validate($request,[
                
                'CheckInDate'=>'required|date|after:yesterday',
                'StartTime'=>'required',
                'EndTime'=>'required|after:StartTime',
            ],
            [
                'CheckInDate.after' => 'Please Enter a Valid Date',
                'StartTime.after' => 'Please Enter a Valid Start Time',
                'EndTime.after' => 'Please Enter a Valid End Time',
            ]);
       }

    
                                    
       $CheckInDate = avubooking::where('CheckInDate', '=', $request->input('CheckInDate'))->first();
        
        if ($CheckInDate === null) {
        
            if (Auth::check()) {
                return redirect('/avu')->with(session()->flash('alert-success', 'Available'));
            }
           
            return redirect('/login')->with(session()->flash('alert-success', 'Available.Please loggin to the system for booking.'));
            ;
            
            
        }else{
            $CheckInDate = avubooking::whereTime('StartTime', '<', $request->input('StartTime'))->whereTime('EndTime', '>', $request->input('StartTime'))->where('CheckInDate', '=', $request->input('CheckInDate'))->where('Status', 'Confirmed')->get();
            $CheckInDate2 = avubooking::whereTime('StartTime', '>', $request->input('StartTime'))->whereTime('StartTime', '<', $request->input('EndTime'))->where('CheckInDate', '=', $request->input('CheckInDate'))->where('Status', 'Confirmed')->get();
           
            if(count($CheckInDate) > 0 || count($CheckInDate2) > 0){
              
                return redirect()->back()->with(session()->flash('alert-danger', 'Sorry already booked!'));
    
            }else{
                if (Auth::check()) {
                    return redirect('/avu')->with(session()->flash('alert-success', 'Available'));
                }
               
                return redirect('/login')->with(session()->flash('alert-success', 'Available.Please loggin to the system for booking.'));
                
             }
            }
        
     
        }


        //dd($request->input());
    }

    public function getagrifarm(){
        return view('af');
    }

    public function getnest(){
        return view('nest');
    }

    public function gethr(){
        return view('hr');
    }

    public function getavu(){
        return view('avu');
    }

    public function getContact(){
        return view('contact');
    }

    public function admin(Request $req){
        return view('admin');
    }
    public function vc(Request $req){
        return view('vc');
       // return view('vc')->withMessage("Super Admin");
    }

    public function avucoordinator(Request $req){
        return view('avucoordinator');
    }
    
    public function nestcoordinator(Request $req){
        return view('nestcoordinator');
    }

    public function dean_hod(Request $req){
        return view('dean_hod');
    }
   
    public function agricoordinator(Request $req){
        return view('agricoordinator');
    }

    public function hrcoordinator(Request $req){
        return view('hrcoordinator');
    }
    
    public function nestreg(Request $req){
        return view('nestreg');
    }

    public function hrreg(Request $req){
        return view('hrreg');
    }

    public function view_reports(Request $req){
        return view('view_reports');
    }

    public function guestbooking(Request $req){
        return view('guestbooking');
    }
}
