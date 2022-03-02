<?php

namespace App\Http\Controllers;

use App\airport;
use App\flight;
use App\luggage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if(Auth::check()){
            $date_cur = date("Y/m/d");
            $flight_departure = flight::where('departure_date','>=',$date_cur)->paginate(10);
            $airport = airport::get();
            return view('home',['flight_departure'=>$flight_departure,
                'airport'=>$airport]);
        }
        else{
            return view('auth/login');
        }
    }
}
