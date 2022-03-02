<?php

namespace App\Http\Controllers;

use App\airport;
use App\flight;
use App\luggage;
use App\oneway_ticket;
use App\seat;
use App\twoway_ticket;
use App\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;

class AdminController extends Controller
{
    public function create_account(){
        return view('admin/create_account');
    }
    public function postCreate_account(Request $request){
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => 'required|min:6|confirmed'
        ];
        $messages = [
            'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không đúng'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else {
            User::create([
                'type_user' => '1',
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }
        return view('admin/notification',['name'=>$request->name,'email'=>$request->email]);
    }
    public function customer(){
        $user = users::where('type_user','2')->paginate(5);
        return view('admin/customer',['user'=>$user]);
    }
    public function view_history($id){
        $oneway_ticket = oneway_ticket::where('oneway_ticket.id_customer', $id)
            ->leftjoin('seat','oneway_ticket.id_seat','=','seat.id')
            ->leftjoin('flight','oneway_ticket.id_flight','=','flight.id')
            ->leftjoin('luggage','oneway_ticket.id_luggage','=','luggage.id')
            ->get();
        $count = oneway_ticket::where('oneway_ticket.id_customer', $id)
            ->leftjoin('seat','oneway_ticket.id_seat','=','seat.id')
            ->leftjoin('flight','oneway_ticket.id_flight','=','flight.id')
            ->leftjoin('luggage','oneway_ticket.id_luggage','=','luggage.id')
            ->count();
        $twoway_ticket = twoway_ticket::where('twoway_ticket.id_customer', $id)
            ->leftjoin('seat','twoway_ticket.id_seat_outward','=','seat.id')
            ->leftjoin('flight','twoway_ticket.id_flight_outward','=','flight.id')
            ->leftjoin('luggage','twoway_ticket.id_luggage','=','luggage.id')
            ->get();
        $airport = airport::get();
        $flight = flight::get();
        $seat = seat::get();
        return view('admin/historyBuy',[
            'oneway_ticket'=>$oneway_ticket,
            'twoway_ticket'=>$twoway_ticket,
            'airport'=>$airport,
            'flight'=>$flight,
            'seat'=>$seat,
            'count'=>$count,
        ]);
    }
    public function search_customer(Request $request){
        if($email=$request->get('email')) {
            $list_user = users::where('email','LIKE',$email.'%')->where('type_user',2)->get();
            $list = "";
            foreach ($list_user as $key => $value){
                $list = $list. '<tr><td>'.($key+1).'</td><td>'.$value->name.'</td><td>'.$value->email.'</td><td><a href="http://localhost:8000/view_history/'.$value->id.'"><button>Lịch sử giao dịch</button></a></td></tr>';
            }
            return $list;
        }
    }
}
