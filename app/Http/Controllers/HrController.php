<?php

namespace App\Http\Controllers;

use App\Models\HoliydayResortPayment;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\holidayresort;
use App\Models\hrbooking;
use Auth;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\hremail;
use DB;
use Session;
use Illuminate\Support\Facades\Input;

//to handle holiday resort details
class HrController extends Controller
{
    public function gethr(){

        $sessionData = [];

        // Check the availability session exist or not
        if(Session::has('CheckAvailabilityRequest')){
            $sessionData = (object)Session::get('CheckAvailabilityRequest');
            //dd(Session::all());

            if($sessionData->property !== "Holiday Resort"){
                Session::forget('CheckAvailabilityRequest');
                $sessionData=NULL;
            }
        }

        $hr = holidayresort::all();
        $hrdetail = DB::select('select * from holidayresorts');
        $hrfill = [];
        foreach($hrdetail as $n){
            $hrfill[$n->HolodayResortId] = $n->Type;
        }
        $Users = User::where('roleNo','>=', 11)->get();
        $select = [];
        foreach($Users as $User){
            $select[$User->id] = $User->name;
        }

        return view('hr', compact('select','hrfill','hr', 'sessionData'));


    }



    public function submit(Request $request){

        $Department= Auth::user()->Department;
        $hod=User::select('id')
        ->where('Department', '=', [$Department])
        ->where('Designation', '=', 'Head of The Department')
        ->get();

        $this->validate($request,[


            'BookingType' =>'required',
            'CheckInDate'=>'required|date|after:-1 days',
            'CheckOutDate'=>'required|date|after:CheckInDate',
            'NoOfAdults'=>'required|numeric|min:1',
            'NoOfChildren'=>'required|numeric|min:0',
            'NoOfUnits'=>'required|numeric|min:1',
            'Description'=>'required',
           // 'Recommendation_from'=>"required_if:BookingType,==,Resource Person,SUSL Staff",
//            'HolodayResortId'=>'required',
        ]);


        // payment calculate
//         $getstartdate = date('Y-m-d', strtotime( $request->CheckInDate ) );
//         $getenddate = date('Y-m-d', strtotime( $request->CheckOutDate ) );

//         $startDate = Carbon::createFromFormat('Y-m-d',$getstartdate);
//         $endDate = Carbon::createFromFormat('Y-m-d',$getenddate);

// //        $startDate = Carbon::createFromFormat('Y-m-d',$request->CheckInDate);
// //        $endDate = Carbon::createFromFormat('Y-m-d',$request->CheckOutDate);


//         $dateRange = CarbonPeriod::create($startDate, $endDate);

//         $totalDaysObj =$startDate->diff($endDate);
//         $totalDays =$totalDaysObj->format('%a');

$t1 = Carbon::parse($request->CheckInDate);
        $t2 = Carbon::parse($request->CheckOutDate);
        $diff = $t1->diff($t2);

        $hoursPerDay=0;
        $diff->h>0?$hoursPerDay++:'';

        $totalDays = $diff->d+$hoursPerDay;
        $holidayPayment = HoliydayResortPayment::where('booking_type',$request->input('BookingType'))->first();


        $totalPayments = 0;
        //dd($request->input('HolodayResortId'));

        if($request->input('HolodayResortId') == 3){
            //Master bed room
            //$bookings1 = hrbooking::whereBetween('CheckInDate', [$request->input('CheckInDate'), $request->input('CheckOutDate')])->get();
            //$bookings2 = hrbooking::whereBetween('CheckOutDate', [$request->input('CheckInDate'), $request->input('CheckOutDate')])->get();
            $CheckInDate = hrbooking::whereDate('CheckInDate', '<=', $request->input('CheckInDate'))
                ->whereDate('CheckOutDate', '>=', $request->input('CheckInDate'))
                ->where('HolodayResortId', '3')
                ->where('Status', 'Confirmed')
                ->get();

            $CheckInDate2 = hrbooking::whereDate('CheckInDate', '>=', $request->input('CheckInDate'))
                ->whereDate('CheckInDate', '<=', $request->input('CheckOutDate'))
                ->where('HolodayResortId', '3')
                ->where('Status', 'Confirmed')
                ->get();
//            $CheckInDate = hrbooking::whereDate('CheckInDate', '<=', $request->input('CheckInDate'))->whereDate('CheckOutDate', '>=', $request->input('CheckInDate'))->where('HolodayResortId', '1')->where('Status', 'Confirmed')->get();
//            $CheckInDate2 = hrbooking::whereDate('CheckInDate', '>=', $request->input('CheckInDate'))->whereDate('CheckInDate', '<=', $request->input('CheckOutDate'))->where('HolodayResortId', '1')->where('Status', 'Confirmed')->get();
            //dd($CheckInDate->sum('NoOfUnits'),$CheckInDate2);

            $check_cndition1 = $CheckInDate->sum('NoOfUnits') + $request->input('NoOfUnits');
            $check_cndition2 = $CheckInDate2->sum('NoOfUnits') + $request->input('NoOfUnits');
            $check_cndition3 = ($CheckInDate->sum('NoOfUnits') + $CheckInDate2->sum('NoOfUnits')) + $request->input('NoOfUnits');

//            dd($check_cndition1);
            if( $check_cndition1 > 7 || $check_cndition2 > 7 || $check_cndition3 > 7){
             //  dd("already booked");
                // return redirect('/')->with('danger','Sorry Allready Booked!');
                //dd( $CheckInDate->sum('NoOfUnits'));
                //dd($check_cndition1,$check_cndition2,$check_cndition3);
                 return back()->with('success','Sorry Allready Booked!');
             }else{
              // dd("available");



                // master room
                $totalPayments = $holidayPayment->master * $totalDays * (+$request->input('NoOfUnits'));


                    $hrbooking = new hrbooking;
                    $hrbooking-> BookingType = $request->input('BookingType');
                    $hrbooking-> CheckInDate = $request->input('CheckInDate');
                    $hrbooking-> CheckOutDate = $request->input('CheckOutDate');

//                    $hrbooking-> CheckInDate = $request->input('CheckInDate');

                    $hrbooking-> NoOfAdults = $request->input('NoOfAdults');
                    $hrbooking-> NoOfChildren = $request->input('NoOfChildren');
                    $hrbooking-> NoOfUnits = $request->input('NoOfUnits');
                    $hrbooking-> Description = $request->input('Description');
                    $hrbooking-> Status = 'Request for Booking';
                    $hrbooking-> payment_total = $totalPayments;

                    if($request->input('BookingType') == "Resource Person" || $request->input('BookingType') == "SUSL Staff"){
                        $hrbooking-> Recommendation_from = $hod[0]->id;
                        //$hrbooking-> VCApproval = $request->input('VCApproval');

                      }
                      else{
                        $hrbooking-> Recommendation_from = 13;
                        //$hrbooking-> VCApproval = 0;

                      }

                    $hrbooking-> GuestId = Auth::user()->id;
                    $hrbooking-> GuestName = Auth::user()->name;
                    $hrbooking-> HolodayResortId =  $request->input('HolodayResortId');
                    $hrbooking->save();


                    $data = array(
                        'id'      =>  Auth::user()->id,
                        'name'      =>  Auth::user()->name,
                        'CheckInDate'=>$request->input('CheckInDate'),
                        'CheckOutDate'=>$request->input('CheckOutDate'),
                        'NoOfUnits'=>$request->input('NoOfUnits'),
                        'Description'=>$request->input('Description')
                    );

                    //$Recommendation_From = $request->input('Recommendation_from');
                   $email = DB::select('select email from users where id = 12');
                    //$CheckInDate = hrbooking::where('CheckInDate', '=', $request->input('CheckInDate'))->first();


                   Mail::to($email)->send(new hremail($data));
                    return back()->with('success', 'Request Sent Successfuly!');
             }
        }
        if($request->input('HolodayResortId') == 1){
            //Master bed room
            //$bookings1 = hrbooking::whereBetween('CheckInDate', [$request->input('CheckInDate'), $request->input('CheckOutDate')])->get();
            //$bookings2 = hrbooking::whereBetween('CheckOutDate', [$request->input('CheckInDate'), $request->input('CheckOutDate')])->get();
            $CheckInDate = hrbooking::whereDate('CheckInDate', '<=', $request->input('CheckInDate'))
                ->whereDate('CheckOutDate', '>=', $request->input('CheckInDate'))
                ->where('HolodayResortId', '1')
                ->where('Status', 'Confirmed')
                ->get();

            $CheckInDate2 = hrbooking::whereDate('CheckInDate', '>=', $request->input('CheckInDate'))
                ->whereDate('CheckInDate', '<=', $request->input('CheckOutDate'))
                ->where('HolodayResortId', '1')
                ->where('Status', 'Confirmed')
                ->get();
//            $CheckInDate = hrbooking::whereDate('CheckInDate', '<=', $request->input('CheckInDate'))->whereDate('CheckOutDate', '>=', $request->input('CheckInDate'))->where('HolodayResortId', '2')->where('Status', 'Confirmed')->get();
//            $CheckInDate2 = hrbooking::whereDate('CheckInDate', '>=', $request->input('CheckInDate'))->whereDate('CheckInDate', '<=', $request->input('CheckOutDate'))->where('HolodayResortId', '2')->where('Status', 'Confirmed')->get();
            //dd($CheckInDate->sum('NoOfUnits'),$CheckInDate2);

            $check_cndition1 = $CheckInDate->sum('NoOfUnits') + $request->input('NoOfUnits');
            $check_cndition2 = $CheckInDate2->sum('NoOfUnits') + $request->input('NoOfUnits');
            $check_cndition3 = ($CheckInDate->sum('NoOfUnits') + $CheckInDate2->sum('NoOfUnits')) + $request->input('NoOfUnits');

            if( $check_cndition1 > 7 || $check_cndition2 > 7 || $check_cndition3 > 7){
                //  dd("already booked");
                // return redirect('/')->with('danger','Sorry Allready Booked!');
                return back()->with('success','Sorry Allready Booked!');
            }else{
                // dd("available");

                $totalPayments = $holidayPayment->single * $totalDays * (+$request->input('NoOfUnits'));


                $hrbooking = new hrbooking;
                $hrbooking-> BookingType = $request->input('BookingType');
//                    $hrbooking-> CheckInDate = $request->input('CheckInDate');
//                    $hrbooking-> CheckOutDate = $request->input('CheckOutDate');
                $hrbooking-> CheckInDate = $request->input('CheckInDate');
                $hrbooking-> CheckOutDate = $request->input('CheckOutDate');

                $hrbooking-> NoOfAdults = $request->input('NoOfAdults');
                $hrbooking-> NoOfChildren = $request->input('NoOfChildren');
                $hrbooking-> NoOfUnits = $request->input('NoOfUnits');
                $hrbooking-> Description = $request->input('Description');
                $hrbooking-> Status = 'Request for Booking';
                $hrbooking-> payment_total = $totalPayments;

                if($request->input('BookingType') == "Resource Person" || $request->input('BookingType') == "SUSL Staff"){
                    $hrbooking-> Recommendation_from = $hod[0]->id;
                    // $hrbooking-> VCApproval = $request->input('VCApproval');

                }
                else{
                    $hrbooking-> Recommendation_from = 13;
                    // $hrbooking-> VCApproval = 0;

                }

                $hrbooking-> GuestId = Auth::user()->id;
                $hrbooking-> GuestName = Auth::user()->name;
                $hrbooking-> HolodayResortId =  $request->input('HolodayResortId');
                $hrbooking->save();

                //data array which pass details to hrmail
                $data = array(
                    'id'      =>  Auth::user()->id,
                    'name'      =>  Auth::user()->name,
                    'CheckInDate'=>$request->input('CheckInDate'),
                    'CheckOutDate'=>$request->input('CheckOutDate'),
                    'NoOfUnits'=>$request->input('NoOfUnits'),
                    'Description'=>$request->input('Description')
                );


                $email = DB::select('select email from users where id = 12');
                //send mail to hr coordinator
                Mail::to($email)->send(new hremail($data));

                //$Recommendation_From = $request->input('Recommendation_from');
                //$CheckInDate = hrbooking::where('CheckInDate', '=', $request->input('CheckInDate'))->first();



                return back()->with('success', 'Request Sent Successfuly!');
            }
        }

        if($request->input('HolodayResortId') == 2){
            //Master bed room
            //$bookings1 = hrbooking::whereBetween('CheckInDate', [$request->input('CheckInDate'), $request->input('CheckOutDate')])->get();
            //$bookings2 = hrbooking::whereBetween('CheckOutDate', [$request->input('CheckInDate'), $request->input('CheckOutDate')])->get();
            $CheckInDate = hrbooking::whereDate('CheckInDate', '<=', $request->input('CheckInDate'))
                ->whereDate('CheckOutDate', '>=', $request->input('CheckInDate'))
                ->where('HolodayResortId', '2')
                ->where('Status', 'Confirmed')
                ->get();

            $CheckInDate2 = hrbooking::whereDate('CheckInDate', '>=', $request->input('CheckInDate'))
                ->whereDate('CheckInDate', '<=', $request->input('CheckOutDate'))
                ->where('HolodayResortId', '2')
                ->where('Status', 'Confirmed')
                ->get();
//            $CheckInDate = hrbooking::whereDate('CheckInDate', '<=', $request->input('CheckInDate'))->whereDate('CheckOutDate', '>=', $request->input('CheckInDate'))->where('HolodayResortId', '2')->where('Status', 'Confirmed')->get();
//            $CheckInDate2 = hrbooking::whereDate('CheckInDate', '>=', $request->input('CheckInDate'))->whereDate('CheckInDate', '<=', $request->input('CheckOutDate'))->where('HolodayResortId', '2')->where('Status', 'Confirmed')->get();
            //dd($CheckInDate->sum('NoOfUnits'),$CheckInDate2);

            $check_cndition1 = $CheckInDate->sum('NoOfUnits') + $request->input('NoOfUnits');
            $check_cndition2 = $CheckInDate2->sum('NoOfUnits') + $request->input('NoOfUnits');
            $check_cndition3 = ($CheckInDate->sum('NoOfUnits') + $CheckInDate2->sum('NoOfUnits')) + $request->input('NoOfUnits');

            if( $check_cndition1 > 28 || $check_cndition2 > 28 || $check_cndition3 > 28){
             //  dd("already booked");
                // return redirect('/')->with('danger','Sorry Allready Booked!');
                return back()->with('success','Sorry Allready Booked!');
             }else{
              // dd("available");

                $totalPayments = $holidayPayment->single * $totalDays * (+$request->input('NoOfUnits'));


                $hrbooking = new hrbooking;
                    $hrbooking-> BookingType = $request->input('BookingType');
//                    $hrbooking-> CheckInDate = $request->input('CheckInDate');
//                    $hrbooking-> CheckOutDate = $request->input('CheckOutDate');
                $hrbooking-> CheckInDate = $request->input('CheckInDate');
                $hrbooking-> CheckOutDate = $request->input('CheckOutDate');

                    $hrbooking-> NoOfAdults = $request->input('NoOfAdults');
                    $hrbooking-> NoOfChildren = $request->input('NoOfChildren');
                    $hrbooking-> NoOfUnits = $request->input('NoOfUnits');
                    $hrbooking-> Description = $request->input('Description');
                    $hrbooking-> Status = 'Request for Booking';
                    $hrbooking-> payment_total = $totalPayments;

                    if($request->input('BookingType') == "Resource Person" || $request->input('BookingType') == "SUSL Staff"){
                        $hrbooking-> Recommendation_from = $hod[0]->id;
                       // $hrbooking-> VCApproval = $request->input('VCApproval');

                      }
                      else{
                        $hrbooking-> Recommendation_from = 13;
                       // $hrbooking-> VCApproval = 0;

                      }

                    $hrbooking-> GuestId = Auth::user()->id;
                    $hrbooking-> GuestName = Auth::user()->name;
                    $hrbooking-> HolodayResortId =  $request->input('HolodayResortId');
                    $hrbooking->save();

                   //data array which pass details to hrmail
                    $data = array(
                        'id'      =>  Auth::user()->id,
                        'name'      =>  Auth::user()->name,
                        'CheckInDate'=>$request->input('CheckInDate'),
                        'CheckOutDate'=>$request->input('CheckOutDate'),
                        'NoOfUnits'=>$request->input('NoOfUnits'),
                        'Description'=>$request->input('Description')
                    );


                    $email = DB::select('select email from users where id = 12');
                    //send mail to hr coordinator
                    Mail::to($email)->send(new hremail($data));

                     //$Recommendation_From = $request->input('Recommendation_from');
                    //$CheckInDate = hrbooking::where('CheckInDate', '=', $request->input('CheckInDate'))->first();



                    return back()->with('success', 'Request Sent Successfuly!');
             }
        }
            return redirect('/')->with('danger','Sorry Allready Booked!');

    }



    // function send(Request $request)
    // {
    //  $this->validate($request, [

    //  ]);

    //  $data = array(
    //     'id'      =>  Auth::user()->id,
    //     'name'      =>  Auth::user()->name,

    // );

    //         Mail::to('ashansawijeratne@gmail.com')->send(new SendMail($data));
    //         return back()->with('success', 'Successfuly sent!');

    // }
}
