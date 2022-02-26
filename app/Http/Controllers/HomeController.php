<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\holidayresort;
use App\Models\hrbooking;

use App\Models\nest;
use App\Models\nestbooking;
use Auth;
use DB;

use Session;
use Illuminate\Support\Facades\Input;

use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sessionData = [];

        if(Session::has('CheckAvailabilityRequest')){
            $sessionData = (object)Session::get('CheckAvailabilityRequest');
            if($sessionData->property == "NEST"){
                return redirect('/nest');
            }
            if($sessionData->property == "Holiday Resort"){
                return redirect('/hr');
            }
            if($sessionData->property == "Audio Visual Unit"){
                return redirect('/avu');
            }
            if($sessionData->property == "Agri Farm Kabana"){
                return redirect('/af');
            }
            if($sessionData->property == "Agri Farm Dining Room"){
                return redirect('/afd');
            }
        }

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

        return view('home', compact('hrfill','hr','nestfill','nest'));
    }

   
}
