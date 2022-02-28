<?php

namespace App\Http\Controllers;

use App\Models\KabanaPaymentType;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\agrifarmstay;
use App\Models\agrsbooking;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\User;
use Auth;
use App\Mail\agriemail;
use DB;
use Session;
use Illuminate\Support\Facades\Input;


// to handle agri farm booking details
class AgriFarmController extends Controller
{
    public function getagrifarm(){

        $sessionData = [];

        // Check the availability session exist or not
        if(Session::has('CheckAvailabilityRequest')){
            $sessionData = (object)Session::get('CheckAvailabilityRequest');
            //dd(Session::all());
            if($sessionData->property !== "Agri Farm Kabana"){
                Session::forget('CheckAvailabilityRequest');
                $sessionData=NULL;
            }
        }

        $Users = User::where('roleNo','>=', 11)->get();
        $select = [];
        foreach($Users as $User){
            $select[$User->id] = $User->name;
        }


        $af = agrifarmstay::all();

        return view('af', compact('select','af', 'sessionData'));

    }





    public function submit(Request $request){


        $Department= Auth::user()->Department;
        $hod=User::select('id')
        ->where('Department', '=', [$Department])
        ->where('Designation', '=', 'Head of The Department')
        ->get();

        $this->validate($request,[
            'BookingType' =>'required',
//            'CheckInDate'=>'required|date|after:yesterday',
//            'CheckOutDate'=>'required|date|after:CheckInDate',
            'NoOfAdults'=>'required|numeric|min:1',
            'NoOfChildren'=>'required|numeric|min:0',
            'NoOfUnits'=>'required|numeric|min:1',
            'Description'=>'required',
            //'Recommendation_from'=>"required_if:BookingType,==,Resource Person,SUSL Staff",
        ],
        [
            'BookingType.required' => 'Please Select Whom are You Booking For',
//            'CheckInDate.after' => 'Please Enter a Valid Date',
//            'CheckOutDate.after' => 'Please Enter a Valid Date',
            'NoOfAdults.required' => 'Please Enter The Number of Adults',
            'NoOfChildren.required' => 'Please Enter The Number of Children',
            'NoOfUnits.required' => 'Please Enter The Number of Units',
            'Description.required' => 'Please Add a Description',
        ]);


        $CheckInDate = agrsbooking::whereDate('CheckInDateTime', '<=', $request->input('CheckInDateTime'))
            ->whereDate('CheckOutDateTime', '>=', $request->input('CheckInDateTime'))
            ->where('Status', 'Confirmed')
            ->get();

        $CheckInDate2 = agrsbooking::whereDate('CheckInDateTime', '>=', $request->input('CheckInDateTime'))
            ->whereDate('CheckInDateTime', '<=', $request->input('CheckOutDateTime'))
            ->where('Status', 'Confirmed')
            ->get();

//            $CheckInDate = agrsbooking::whereDate('CheckInDate', '<=', $request->input('CheckInDate'))->whereDate('CheckOutDate', '>=', $request->input('CheckInDate'))->where('Status', 'Confirmed')->get();
//            $CheckInDate2 = agrsbooking::whereDate('CheckInDate', '>=', $request->input('CheckInDate'))->whereDate('CheckInDate', '<=', $request->input('CheckOutDate'))->where('Status', 'Confirmed')->get();
            //dd($CheckInDate,$CheckInDate2);
            $check_cndition1 = $CheckInDate->sum('NoOfUnits') + $request->input('NoOfUnits');
            $check_cndition2 = $CheckInDate2->sum('NoOfUnits') + $request->input('NoOfUnits');
            $check_cndition3 = ($CheckInDate->sum('NoOfUnits') + $CheckInDate2->sum('NoOfUnits')) + $request->input('NoOfUnits');

            if( $check_cndition1 > 3 || $check_cndition2 > 3 || $check_cndition3 > 3){
             //  dd("already booked");
                // return redirect('/')->with('danger','Sorry Allready Booked!');
                 return back()->with('success','Sorry Allready Booked!');
             }else{
              //dd("available");

                // calculation

                $amountByDate=0;
                $totalDays =0;
                $booking_type = KabanaPaymentType::where('booking_type',$request->BookingType)->first();



                $getstartdate = date('Y-m-d', strtotime( $request->CheckInDateTime ) );
                $getenddate = date('Y-m-d', strtotime( $request->CheckOutDateTime ) );


                $startDate = Carbon::createFromFormat('Y-m-d',$getstartdate);
                $startDate= $startDate->addDay();
                $endDate = Carbon::createFromFormat('Y-m-d',$getenddate);


                $dateRange = CarbonPeriod::create($startDate, $endDate);
                foreach($dateRange as $date){
                    $totalDays++;
                    if($date->isMonday()===true || $date->isTuesday()===true || $date->isWednesday()===true ||$date->isThursday()===true){
                        // monday - tuesday
                        $amountByDate+=$booking_type->weekdays;
                    }else{
                        //friday sat sun days
                        $amountByDate+=$booking_type->weekend;
                    }
                }
                $totalAmount = $amountByDate*$request->NoOfUnits;


              $agrsbooking = new agrsbooking;
              $agrsbooking-> BookingType = $request->input('BookingType');
              $agrsbooking-> CheckInDateTime = $request->input('CheckInDateTime');
              $agrsbooking-> CheckOutDateTime = $request->input('CheckOutDateTime');
              $agrsbooking-> NoOfAdults = $request->input('NoOfAdults');
              $agrsbooking-> NoOfChildren = $request->input('NoOfChildren');
              $agrsbooking-> NoOfUnits = $request->input('NoOfUnits');
              $agrsbooking-> Description = $request->input('Description');
              $agrsbooking-> Status = 'Request for Booking';
              $agrsbooking->payment_total= $totalAmount;

              if($request->input('BookingType') == "Resource Person" || $request->input('BookingType') == "SUSL Staff"){
                $agrsbooking-> Recommendation_from = $hod[0]->id;
                // $agrsbooking-> VCApproval = $request->input('VCApproval');

              }
              else{
                $agrsbooking-> Recommendation_from = 13;
                //$agrsbooking-> VCApproval = 0;

              }

              $agrsbooking-> GuestId = Auth::user()->id;
              $agrsbooking-> GuestName = Auth::user()->name;
              $agrsbooking-> AgriFarmStayId = 1;
              $agrsbooking->save();

              $data = array(
                  'id'      =>  Auth::user()->id,
                  'name'      =>  Auth::user()->name,
                  'CheckInDateTime'=>$request->input('CheckInDateTime'),
                  'CheckOutDateTime'=>$request->input('CheckOutDateTime'),
                  'NoOfUnits'=>$request->input('NoOfUnits'),
                  'Description'=>$request->input('Description')
              );


              //$Recommendation_From = $request->input('Recommendation_from');
              $email = DB::select('select email from users where id = 11');


                    Mail::to($email)->send(new agriemail($data));
                    return back()->with('success', 'Request Sent Successfuly!');
             }





                return redirect('/')->with('success','Sorry Allready Booked!');

        }

        public function cancelBooking($id){
            $status='Cancelled';
            $state =DB::update('update agrsbookings set Status = ? where BookingId = ?',[$status,$id]);
            if($state!=1) return redirect()->back()->with('success', 'Somthing went wrong');
            return redirect()->back()->with('success', 'Reservation cancelled!');
        }
    }
