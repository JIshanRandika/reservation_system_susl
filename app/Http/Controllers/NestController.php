<?php

namespace App\Http\Controllers;

use App\Models\HoliydayResortPayment;
use App\Models\NestPayment;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\nest;
use App\Models\nestbooking;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\nestemail;
use DB;
use Session;
use Illuminate\Support\Facades\Input;

//to hanlde nest booking details
class NestController extends Controller
{
    public function getnest(){

        $sessionData = [];

        // Check the availability session exist or not
        if(Session::has('CheckAvailabilityRequest')){
            $sessionData = (object)Session::get('CheckAvailabilityRequest');
            //dd(Session::all());

            if($sessionData->property !== "NEST"){
                Session::forget('CheckAvailabilityRequest');
                $sessionData=NULL;
            }
        }

        $nest = nest::all();
        $nestdetail = DB::select('select * from nests');
        $nestfill = [];
        foreach($nestdetail as $n){
            $nestfill[$n->NestId] = $n->Type;
        }
        $Users = User::where('roleNo','>=', 11)->get();
        $select = [];
        foreach($Users as $User){
            $select[$User->id] = $User->name;
        }

        return view('nest', compact('select','nestfill','nest', 'sessionData'));

        //return view('nest')->with('nest',$nest);
    }






    public function submit(Request $request){


        $Department= Auth::user()->Department;
        $hod=User::select('id')
        ->where('Department', '=', [$Department])
        ->where('Designation', '=', 'Head of The Department')
        ->get();


//dd( $hod[0]->id,$Department);
        $this->validate($request,[
            'CheckInDate'=>'required|date|after:-1 days',
            'CheckOutDate'=>'required|date|after:CheckInDate',

//            'StartTime'=>'required',
//            'EndTime'=>'required',

            'NoOfAdults'=>'required|numeric|min:1',
            'NoOfUnits'=>'required|numeric|min:1',
            'NoOfChildren'=>'required|numeric|min:0',
            'Description'=>'required',
            'BookingType'=>'required',
            //'Recommendation_from'=>'required',

        ],
        [
            'BookingType.required' => 'Please Select Whom are You Booking For',
            'CheckInDate.after' => 'Please Enter a Valid Date',
            'CheckOutDate.after' => 'Please Enter a Valid Date',
            'NoOfAdults.required' => 'Please Enter The Number of Adults',
            'NoOfChildren.required' => 'Please Enter The Number of Children',
            'NoOfUnits.required' => 'Please Enter The Number of Units',
            'Description.required' => 'Please Add a Description',
           // 'Recommendation_from' => 'Please Select From Whom You Need to Get Recommendation',
        ]);

        // payment calculate
//        $startDate = Carbon::createFromFormat('Y-m-d',$request->CheckInDate);
//        $endDate = Carbon::createFromFormat('Y-m-d',$request->CheckOutDate);

//        $startDate = Carbon::parse($request->CheckInDate)->format('Y-m-d');
//        $endDate = Carbon::parse($request->CheckOutDate)->format('Y-m-d');

//        $startDate = Carbon::createFromFormat('Y-m-d',$request->CheckInDate->toDateString());
//        $endDate = Carbon::createFromFormat('Y-m-d',$request->CheckOutDate->toDateString());

//        $startDate = Carbon::parse('Y-m-d HH:mm:ss',$request->CheckInDate);
//        $endDate = Carbon::parse('Y-m-d HH:mm:ss',$request->CheckOutDate);


//        $dateRange = CarbonPeriod::create($startDate, $endDate);

//        $totalDayObj = ($request->CheckOutDate)->diffForHumans($request->CheckInDate);

//        $totalDayObj =$startDate->diff($endDate);
//        $startTime = Carbon::parse('2020-02-11 04:04:26');
//        $endTime = Carbon::parse('2020-02-11 04:36:56');
//
//        $totalDayObj = $endTime->diffForHumans($startTime);

//        $mystartdate =

//        $startDate = \DateTime::createFromFormat('Y-m-d',$request->CheckInDate);
//        $endDate = \DateTime::createFromFormat('Y-m-d',$request->CheckOutDate);
//
        $getstartdate = date('Y-m-d', strtotime( $request->CheckInDate ) );
        $getenddate = date('Y-m-d', strtotime( $request->CheckOutDate ) );

        $startDate = Carbon::createFromFormat('Y-m-d',$getstartdate);
        $endDate = Carbon::createFromFormat('Y-m-d',$getenddate);

        $totalDayObj =$startDate->diff($endDate);

        $totalDays = $totalDayObj->format('%a');

        $nestPayment = NestPayment::where('booking_type',$request->input('BookingType'))->first();
        $noOfUnits = $request->input('NoOfUnits');

        $totalPayments = 0;

        if($request->input('NestId') == 1){
            //Master bed room

//            $CheckInDate = nestbooking::whereDate('CheckInDate', '<=', $request->input('CheckInDate'))->whereDate('CheckOutDate', '>=', $request->input('CheckInDate'))->where('Status', 'Confirmed')->get();
            $CheckInDate = nestbooking::whereDate('CheckInDate', '<=', $request->input('CheckInDate'))
                ->whereDate('CheckOutDate', '>=', $request->input('CheckInDate'))
                ->where('Status', 'Confirmed')
                ->get();

            $CheckInDate2 = nestbooking::whereDate('CheckInDate', '>=', $request->input('CheckInDate'))
                ->whereDate('CheckInDate', '<=', $request->input('CheckOutDate'))
                ->where('Status', 'Confirmed')
                ->get();

//            $CheckInDate0 = nestbooking::where()


//            $CheckInDate = nestbooking::whereDateTime('StartDateTIme', '<=',  date_time_set($request->input('CheckInDate')+' '+$request->input('StartTime')))
//                ->where('EndDateTIme', '>=', date_time_set($request->input('CheckInDate')+' '+$request->input('StartTime')))
//                ->where('Status', 'Confirmed')
//                ->get();
//
//
//            $CheckInDate2 = nestbooking::whereDate('StartDateTIme', '>=', date_time_set($request->input('CheckInDate')+' '+$request->input('StartTime')))
//                ->where('StartDateTIme', '<=', date_time_set($request->input('CheckOutDate')+' '+$request->input('EndTime')))
//                ->where('Status', 'Request for Booking')
//                ->get();

//            $CheckInDate2 = nestbooking::whereDate('CheckInDate', '>=', $request->input('CheckInDate'))->whereDate('CheckInDate', '<=', $request->input('CheckOutDate'))->where('Status', 'Confirmed')->get();

            // dd($CheckInDate,$CheckInDate2);


           $check_cndition1 = $CheckInDate->sum('NoOfUnits') + $request->input('NoOfUnits');
           $check_cndition2 = $CheckInDate2->sum('NoOfUnits') + $request->input('NoOfUnits');
           $check_cndition3 = ($CheckInDate->sum('NoOfUnits') + $CheckInDate2->sum('NoOfUnits')) + $request->input('NoOfUnits');

           if( $check_cndition1 > 1 || $check_cndition2 > 1 || $check_cndition3 > 1){
              // dd("already booked");
                 return redirect('/')->with('success','Sorry Allready Booked!');
             }else{
              // dd("available");

               $totalPayments = $nestPayment->master * $totalDays * $noOfUnits;
              $nestbooking = new nestbooking;
//              $nestbooking-> CheckInDate = $request->input('CheckInDate');
//              $nestbooking-> CheckOutDate = $request->input('CheckOutDate');
//
//               $nestbooking-> StartTime = $request->input('StartTime');
//               $nestbooking-> EndTime = $request->input('EndTime');

               $nestbooking-> CheckInDate = $request->input('CheckInDate');
               $nestbooking-> CheckOutDate = $request->input('CheckOutDate');


              $nestbooking-> NoOfAdults = $request->input('NoOfAdults');
              $nestbooking-> NoOfChildren = $request->input('NoOfChildren');
              $nestbooking-> NoOfUnits = $request->input('NoOfUnits');
              $nestbooking-> Description = $request->input('Description');
              $nestbooking-> BookingType = $request->input('BookingType');
              $nestbooking-> Status = 'Request for Booking';
              //$nestbooking-> Recommendation_from = $request->input('Recommendation_from');
              $nestbooking-> Recommendation_from = $hod[0]->id;
              //$nestbooking-> VCApproval = $request->input('VCApproval');
              $nestbooking-> GuestId = Auth::user()->id;
              $nestbooking-> GuestName = Auth::user()->name;
              $nestbooking-> NestId = $request->input('NestId');
               $nestbooking->payment_amount= $totalPayments;


              $data = array(
                  'id'      =>  Auth::user()->id,
                  'name'      =>  Auth::user()->name,
//                  'CheckInDate'=>$request->input('CheckInDate'),
//                  'CheckOutDate'=>$request->input('CheckOutDate'),


//                  'StartTime'=>$request->input('StartTime'),
//                  'EndTime'=>$request->input('EndTime'),

                  'CheckInDate'=>$request->input('CheckInDate'),
                  'CheckOutDate'=>$request->input('CheckOutDate'),

                  'NoOfAdults'=>$request->input('NoOfAdults'),
                  'NoOfChildren'=>$request->input('NoOfChildren'),
                  'NoOfUnits'=>$request->input('NoOfUnits'),
                  'Description'=>$request->input('Description'),
                  'BookingType'=>$request->input('BookingType'),
                  'NestId'=>$request->input('NestId'),

              );

              //$Recommendation_From = $request->input('Recommendation_from');
              $email = DB::select('select email from users where id = 10');


              $nestbooking->save();
              Mail::to($email)->send(new nestemail($data));
              return back()->with('success', 'Request Sent Successfuly!');
             }
        }



        if($request->input('NestId') == 2){
            //Master bed room

            $CheckInDate = nestbooking::whereDate('CheckInDate', '<=', $request->input('CheckInDate'))
                ->whereDate('CheckOutDate', '>=', $request->input('CheckInDate'))
                ->where('Status', 'Request for Booking')
                ->get();

            $CheckInDate2 = nestbooking::whereDate('CheckInDate', '>=', $request->input('CheckInDate'))
                ->whereDate('CheckInDate', '<=', $request->input('CheckOutDate'))
                ->where('Status', 'Request for Booking')
                ->get();

//            $CheckInDate = nestbooking::whereDate('CheckInDate', '<=', $request->input('CheckInDate'))->whereDate('CheckOutDate', '>=', $request->input('CheckInDate'))->where('Status', 'Confirmed')->get();
//            $CheckInDate2 = nestbooking::whereDate('CheckInDate', '>=', $request->input('CheckInDate'))->whereDate('CheckInDate', '<=', $request->input('CheckOutDate'))->where('Status', 'Confirmed')->get();
           // dd($CheckInDate,$CheckInDate2);

           $check_cndition1 = $CheckInDate->sum('NoOfUnits') + $request->input('NoOfUnits');
           $check_cndition2 = $CheckInDate2->sum('NoOfUnits') + $request->input('NoOfUnits');
           $check_cndition3 = ($CheckInDate->sum('NoOfUnits') + $CheckInDate2->sum('NoOfUnits')) + $request->input('NoOfUnits');

           if( $check_cndition1 > 4 || $check_cndition2 > 4 || $check_cndition3 > 4){
              // dd("already booked");
                 return redirect('/')->with('success','Sorry Allready Booked!');
             }else{
              // dd("available");

               $totalPayments = $nestPayment->single * $totalDays * $noOfUnits;

              $nestbooking = new nestbooking;
//              $nestbooking-> CheckInDate = $request->input('CheckInDate');
//              $nestbooking-> CheckOutDate = $request->input('CheckOutDate');

//               $nestbooking-> StartTime = $request->input('StartTime');
//               $nestbooking-> EndTime = $request->input('EndTime');

               $nestbooking-> CheckInDate = $request->input('CheckInDate');
               $nestbooking-> CheckOutDate = $request->input('CheckOutDate');


               $nestbooking-> NoOfAdults = $request->input('NoOfAdults');
              $nestbooking-> NoOfChildren = $request->input('NoOfChildren');
              $nestbooking-> NoOfUnits = $request->input('NoOfUnits');
              $nestbooking-> Description = $request->input('Description');
              $nestbooking-> BookingType = $request->input('BookingType');
              $nestbooking-> Status = 'Request for Booking';
              $nestbooking-> Recommendation_from = $hod[0]->id;
              //$nestbooking-> VCApproval = $request->input('VCApproval');
              $nestbooking-> GuestId = Auth::user()->id;
              $nestbooking-> GuestName = Auth::user()->name;
              $nestbooking-> NestId = $request->input('NestId');
              $nestbooking->payment_amount= $totalPayments;

              $data = array(
                  'id'      =>  Auth::user()->id,
                  'name'      =>  Auth::user()->name,
//                  'CheckInDate'=>$request->input('CheckInDate'),
//                  'CheckOutDate'=>$request->input('CheckOutDate'),


//                  'StartTime'=>$request->input('StartTime'),
//                  'EndTime'=>$request->input('EndTime'),

                  'CheckInDate'=>$request->input('CheckInDate'),
                  'CheckOutDate'=>$request->input('CheckOutDate'),

                  'NoOfAdults'=>$request->input('NoOfAdults'),
                  'NoOfChildren'=>$request->input('NoOfChildren'),
                  'NoOfUnits'=>$request->input('NoOfUnits'),
                  'Description'=>$request->input('Description'),
                  'BookingType'=>$request->input('BookingType'),
                  'NestId'=>$request->input('NestId'),

              );

              //$Recommendation_From = $request->input('Recommendation_from');
              $email = DB::select('select email from users where id = 10');


              $nestbooking->save();
              Mail::to($email)->send(new nestemail($data));
              return back()->with('success', 'Request Sent Successfuly!');
             }
        }

        //return redirect('/')->with('success','Successfuly Booked!');
    }

}
