<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\audiovisualunit;
use App\Models\avubooking;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\avuemail;
use DB;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Input;

//to hanlde audio visual unit details
class AVUController extends Controller
{
    public function getavu(){
      
        $sessionData = [];

        // Check the availability session exist or not
        if(Session::has('CheckAvailabilityRequest')){
            $sessionData = (object)Session::get('CheckAvailabilityRequest');
            //dd(Session::all());
            if($sessionData->property !== "Audio Visual Unit"){
                Session::forget('CheckAvailabilityRequest');
                $sessionData=NULL;
            }
        }
        
        $avu = audiovisualunit::all();

        $avudetail = DB::select('select * from audiovisualunits');
        $avufill = [];
        foreach($avudetail as $n){
            $avufill[$n->AVUId] = $n->Type;
        }
        $Users = User::where('roleNo','>=', 11)->get();
        $select = [];
        foreach($Users as $User){
            $select[$User->id] = $User->name;
        }

        return view('avu', compact('select','avufill','avu','sessionData'));
       // return view('avu')->with('avu',$avu,$sessionData );
    }


  


//     public function dropDownShow()
// {
//     dd("working");
//         //$Users = User::all();
//         $Users = User::where('roleNo','>=', 11)->get();
//         $select = [];
//         foreach($Users as $User){
//             $select[$User->id] = $User->name;
//         }
//         return view('avu', compact('select'));
//        // return view('avu')->with('select', $select);
// }



    public function submit(Request $request){
        $Department= Auth::user()->Department;
        $hod=User::select('id')
        ->where('Department', '=', [$Department])
        ->where('Designation', '=', 'Head of The Department')
        ->get();

        $current = strtotime(date("Y-m-d"));
        $date    = strtotime($request->input('CheckInDate'));

        $datediff = $date - $current;
        $difference = floor($datediff/(60*60*24));

        if($difference == 0){
            $this->validate($request,[
                'EventName'=>'required',
                'CheckInDate'=>'required|date|after:yesterday',
                'StartTime'=>'required|after:CurrentTime',
                'EndTime'=>'required|after:StartTime',
                'Description'=>'required',
            ],
            [
                'EventName.required' => 'Please Fill the Event Name',
                'CheckInDate.after' => 'Please Enter a Valid Date',
                'StartTime.after' => 'Please Enter a Valid Start Time',
                'EndTime.after' => 'Please Enter a Valid End Time',
                'Description.required' => 'Please Add a Description',
            ]);
            }
        else{
                
                $this->validate($request,[
                    'EventName'=>'required',
                    'CheckInDate'=>'required|date|after:yesterday',
                    'StartTime'=>'required',
                    'EndTime'=>'required|after:StartTime',
                    'Description'=>'required',
                ],
                [
                    'EventName.required' => 'Please Fill the Event Name',
                    'CheckInDate.after' => 'Please Enter a Valid Date',
                    'StartTime.after' => 'Please Enter a Valid Start Time',
                    'EndTime.after' => 'Please Enter a Valid End Time',
                    'Description.required' => 'Please Add a Description',
                ]);
       }

        
        ;
        $avubooking = new avubooking;
        $avubooking-> EventName = $request->input('EventName');
        $avubooking-> CheckInDate = $request->input('CheckInDate');
        $avubooking-> StartTime = $request->input('StartTime');
        $avubooking-> EndTime = $request->input('EndTime');
        $avubooking-> Description = $request->input('Description');
        $avubooking-> Status = 'Request for Booking';
        $avubooking-> Recommendation_from = $hod[0]->id;
        $avubooking-> GuestId = Auth::user()->id;
        $avubooking-> GuestName = Auth::user()->name;
        $avubooking-> AVUId = $request->input('AVUId');
        //$avubooking-> AVUId = $request->input('AVUId');
        //$avubooking-> UserId = '1';

        $data = array(
            'id'      =>  Auth::user()->id,
            'name'      =>  Auth::user()->name,
            'CheckInDate'=>$request->input('CheckInDate'),
            'StartTime'=>$request->input('StartTime'),
            'EndTime'=>$request->input('EndTime'),
            'EventName'=>$request->input('EventName'),
            'Description'=>$request->input('Description')
        );

        //$Recommendation_From = $request->input('Recommendation_from');
        $email = DB::select('select email from users where id = 3');
        //$email = 'pmakwije@gmail.com';

        //$CheckInDate = avubooking::where(['CheckInDate' => $request->input('CheckInDate'), 'Status' => 'Conformed'])->get();
       $CheckInDate = avubooking::where('CheckInDate', '=', $request->input('CheckInDate'))->first();
        
        if ($CheckInDate === null) {
        
            
                $avubooking->save();
                Mail::to($email)->send(new avuemail($data));
                return back()->with('success', 'Request Sent Successfuly!');

                //return redirect('/')->with('success','Request Sent Successfuly !');
            
        }else{
            $CheckInDate = avubooking::whereTime('StartTime', '<', $request->input('StartTime'))->whereTime('EndTime', '>', $request->input('StartTime'))->where('CheckInDate', '=', $request->input('CheckInDate'))->where('Status', 'Confirmed')->get();
            $CheckInDate2 = avubooking::whereTime('StartTime', '>', $request->input('StartTime'))->whereTime('StartTime', '<', $request->input('EndTime'))->where('CheckInDate', '=', $request->input('CheckInDate'))->where('Status', 'Confirmed')->get();
           
            if(count($CheckInDate) > 0 || count($CheckInDate2) > 0){
               // dd("already booked");
                return redirect('/')->with('success','Sorry Allready Booked!');
            }else{
               // dd("available");
                $avubooking->save();
                Mail::to($email)->send(new avuemail($data));
                return back()->with('success', 'Request Sent Successfuly!');
            }
        }
        
            return redirect('/')->with('success','Sorry Allready Booked!');
        
    }
}