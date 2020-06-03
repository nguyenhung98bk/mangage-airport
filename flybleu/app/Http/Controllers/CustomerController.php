<?php

namespace App\Http\Controllers;

use App\twoway_ticket;
use Illuminate\Http\Request;
use App\airport;
use App\flight;
use App\luggage;
use App\seat;
use App\oneway_ticket;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class CustomerController extends Controller
{
    public function getBookticket(){
        $airport = airport::get();
        $luggage = luggage::get();
        return view('customer/bookticket',['airport'=>$airport,'luggage'=>$luggage]);
    }
    public function postBookticket(Request $req){
        $type_ticket = $req->type_ticket;
        $id_start_airport = $req->start_airport;
        $id_end_airport = $req->end_airport;
        $date_departure = $req->date_departure;
        $id_luggage = $req->luggage;
        $flight_departure = flight::where([
            ['id_start_airport',$id_start_airport],
            ['id_end_airport',$id_end_airport],
            ['departure_date',$date_departure],
        ])->get();
        $airport = airport::get();
        $seat = seat::get();
        if($type_ticket=="twoway"){
            $date_return = $req->date_return;
            $flight_return = flight::where([
                ['id_start_airport',$id_end_airport],
                ['id_end_airport',$id_start_airport],
                ['departure_date',$date_return]
            ])->get();
            return view('customer/buyticket2way',[
                'ticket'=>'2',
                'flight_departure'=>$flight_departure,
                'airport'=>$airport,
                'id_luggage'=>$id_luggage,
                'seat'=>$seat,
                'flight_return'=>$flight_return,
            ]);
        }
        else{
            return view('customer/buyticketoneway',[
                'ticket'=>'1',
                'flight_departure'=>$flight_departure,
                'airport'=>$airport,
                'id_luggage'=>$id_luggage,
                'seat'=>$seat,
            ]);
        }
    }
    public function confirmBuy1(Request $request){
        if($request->get('id_seat')) {
            $id_flight = $request->get('id_flight_departure');
            $id_seat = $request->get('id_seat');
            $id_luggage = $request->get('id_luggage');
            $flight = flight::where('id', $id_flight)->first();
            $luggage = luggage::where('id', $id_luggage)->first();
            $price = $flight->price_flight + $luggage->price_luggage;
            oneway_ticket::insert([
                'id_customer'=>Auth::user()->id,
                'id_flight'=>$id_flight,
                'id_luggage'=>$id_luggage,
                'id_seat'=>$id_seat,
                'price'=>$price,
                'status_ticket'=>'2',
            ]);
            return "Vui lòng thanh toán.";
        }
        return "???";
    }
    public function confirmBuy2(Request $request){
        if($request->get('id_seat_departure')&&$request->get('id_seat_return')) {
            $id_seat_departure = $request->get('id_seat_departure');
            $id_flight_departure = $request->get('id_flight_departure');
            $flight_departure = flight::where('id', $id_flight_departure)->first();
            $id_luggage = $request->get('id_luggage');
            $luggage = luggage::where('id', $id_luggage)->first();
            $id_flight_return = $request->get('id_flight_return');
            $id_seat_return = $request->get('id_seat_return');
            $flight_return = flight::where('id', $id_flight_return)->first();
            $price = $flight_departure->price_flight + $flight_return->price_flight + $luggage->price_luggage;
            twoway_ticket::insert([
                'id_customer'=>Auth::user()->id,
                'id_flight_outward'=>$id_flight_departure,
                'id_flight_return'=>$id_flight_return,
                'id_luggage'=>$id_luggage,
                'id_seat_outward'=>$id_seat_departure,
                'id_seat_return'=>$id_seat_return,
                'price'=>$price,
                'status_ticket'=>'2',
            ]);
            return "Vui lòng thanh toán.";
        }
        return "???";
    }
    public function preview(Request $request) {
        $output = '';
        if($request->get('id_seat')) {
            $id_flight = $request->get('id_flight_departure');
            $id_seat = $request->get('id_seat');
            $id_luggage = $request->get('id_luggage');
            $flight = flight::where('id', $id_flight)->first();
            $luggage = luggage::where('id', $id_luggage)->first();
            $seat = seat::where('id', $id_seat)->first();
            $price = $flight->price_flight + $luggage->price_luggage;
            $start_airport = airport::where('id', $flight->id_start_airport)->value('name_airport');
            $end_airport = airport::where('id', $flight->id_end_airport)->value('name_airport');
            $output = '<table><tr><td>Chuyến bay:</td><td>' . $start_airport . '-' . $end_airport . '</td></tr>
<tr><td>Chỗ ngồi số:</td><td>' . $seat->id_seat_inline . '</td></tr>
<tr><td>Thời gian:</td><td>' . $flight->departure_date . ' ' . $flight->departure_time .  '</td></tr>
<tr><td>Gói hành lý:</td><td>' . $luggage->weight . 'Kg</td></tr>
<tr><td>Tổng chi phí:</td><td>' . number_format($price) . 'VNĐ</td></tr></table>';
        }
        return $output;
    }
    public function preview2(Request $request) {
        $output = '';
        if($request->get('id_seat_departure')&&$request->get('id_seat_return')) {
            $id_seat_departure = $request->get('id_seat_departure');
            $id_flight_departure = $request->get('id_flight_departure');
            $flight_departure = flight::where('id', $id_flight_departure)->first();
            $id_luggage = $request->get('id_luggage');
            $luggage = luggage::where('id', $id_luggage)->first();
            $start_airport_departure = airport::where('id', $flight_departure->id_start_airport)->value('name_airport');
            $end_airport_departure = airport::where('id', $flight_departure->id_end_airport)->value('name_airport');
            $seat_departure = seat::where('id', $id_seat_departure)->first();
            $id_flight_return = $request->get('id_flight_return');
            $id_seat_return = $request->get('id_seat_return');
            $flight_return = flight::where('id', $id_flight_return)->first();
            $seat_return = seat::where('id', $id_seat_return)->first();
            $start_airport_return = airport::where('id', $flight_return->id_start_airport)->value('name_airport');
            $end_airport_return = airport::where('id', $flight_return->id_end_airport)->value('name_airport');
            $price = $flight_departure->price_flight + $flight_return->price_flight + $luggage->price_luggage;
            $output = '<table><tr><td>Chuyến bay đi:</td><td>' . $start_airport_departure . '-' . $end_airport_departure . '</td></tr>
<tr><td>Chỗ ngồi số:</td><td>' . $seat_departure->id_seat_inline . '</td></tr>
<tr><td>Thời gian:</td><td>' . $flight_departure->departure_date . ' ' . $flight_departure->departure_time .  '</td></tr>
<tr><td>Chuyến bay về:</td><td>' . $start_airport_return . '-' . $end_airport_return . '</td></tr>
<tr><td>Chỗ ngồi số:</td><td>' . $seat_return->id_seat_inline . '</td></tr>
<tr><td>Thời gian:</td><td>' . $flight_return->departure_date . ' ' . $flight_return->departure_time .  '</td></tr>
<tr><td>Gói hành lý:</td><td>' . $luggage->weight . 'Kg</td></tr>
<tr><td>Tổng chi phí:</td><td>' . number_format($price) . 'VNĐ</td></tr></table>';
        }
        return $output;
    }
    public function payment(){
        $oneway_ticket = oneway_ticket::where('id_customer',Auth::user()->id)->orderBy('id', 'desc')->first();
        return view('customer/payment',['ticket'=>$oneway_ticket]);
    }
    public function payment2(){
        $twoway_ticket = twoway_ticket::where('id_customer',Auth::user()->id)->orderBy('id', 'desc')->first();
        return view('customer/payment2',['ticket'=>$twoway_ticket]);
    }
    public function re_payment($id){
        $oneway_ticket = oneway_ticket::where('id_seat',$id)->first();
        return view('customer/payment',['ticket'=>$oneway_ticket]);
    }
    public function re_payment2($id){
        $twoway_ticket = twoway_ticket::where('id_seat_outward',$id)->first();
        return view('customer/payment2',['ticket'=>$twoway_ticket]);
    }
    public  function historyBuy(){
        $oneway_ticket = oneway_ticket::where('oneway_ticket.id_customer', Auth::user()->id)
            ->leftjoin('seat','oneway_ticket.id_seat','=','seat.id')
            ->leftjoin('flight','oneway_ticket.id_flight','=','flight.id')
            ->leftjoin('luggage','oneway_ticket.id_luggage','=','luggage.id')
            ->get();
        $count = oneway_ticket::where('oneway_ticket.id_customer', Auth::user()->id)
            ->leftjoin('seat','oneway_ticket.id_seat','=','seat.id')
            ->leftjoin('flight','oneway_ticket.id_flight','=','flight.id')
            ->leftjoin('luggage','oneway_ticket.id_luggage','=','luggage.id')
            ->count();
        $twoway_ticket = twoway_ticket::where('twoway_ticket.id_customer', Auth::user()->id)
            ->leftjoin('seat','twoway_ticket.id_seat_outward','=','seat.id')
            ->leftjoin('flight','twoway_ticket.id_flight_outward','=','flight.id')
            ->leftjoin('luggage','twoway_ticket.id_luggage','=','luggage.id')
            ->get();
        $airport = airport::get();
        $flight = flight::get();
        $seat = seat::get();
        return view('customer/historyBuy',[
            'oneway_ticket'=>$oneway_ticket,
            'twoway_ticket'=>$twoway_ticket,
            'airport'=>$airport,
            'flight'=>$flight,
            'seat'=>$seat,
            'count'=>$count,
        ]);
    }
    public function finish_payment(Request $request){
        $id = $request->get('id');
        $code_trade = $request->get('code_trade');
        $ticket_count = oneway_ticket::where('code_trade',$code_trade)->count();
        $ticket_count2 = twoway_ticket::where('code_trade',$code_trade)->count();
        if($ticket_count+$ticket_count2==0){
            $id_seat = oneway_ticket::where('id',$id)->value('id_seat');
            seat::where('id',$id_seat)->update(['status'=>"1"]);
            oneway_ticket::where('id',$id)->update(['status_ticket'=>"1",'code_trade'=>$code_trade]);
            return "Thanh toán thành công!";
        }
        else{
            return "false";
        }
    }
    public function finish_payment2(Request $request){
        $id = $request->get('id');
        $code_trade = $request->get('code_trade');
        $ticket_count = oneway_ticket::where('code_trade',$code_trade)->count();
        $ticket_count2 = twoway_ticket::where('code_trade',$code_trade)->count();
        if($ticket_count+$ticket_count2==0){
            $id_seat_outward = twoway_ticket::where('id',$id)->value('id_seat_outward');
            $id_seat_return = twoway_ticket::where('id',$id)->value('id_seat_return');
            seat::where('id',$id_seat_outward)->orWhere('id',$id_seat_return)->update(['status'=>"1"]);
            twoway_ticket::where('id',$id)->update(['status_ticket'=>"1",'code_trade'=>$code_trade]);
            return "Thanh toán thành công!";
        }
        else{
            return "false";
        }
    }
    public function cancel_ticket($id_seat,$type){
        if($type==1){
            oneway_ticket::where('id_seat',$id_seat)->update(['status_ticket'=>'0']);
        }
        else{
            echo $id_seat;
            twoway_ticket::where('id_seat_outward',$id_seat)->update(['status_ticket'=>'0']);
        }
        return redirect()->back();
    }
    public function print_ticket($id_seat,$type){
        $airport = airport::get();
        if($type==1){
            $oneway_ticket = oneway_ticket::where('oneway_ticket.id_seat',$id_seat)
                ->leftjoin('seat','oneway_ticket.id_seat','=','seat.id')
                ->leftjoin('flight','oneway_ticket.id_flight','=','flight.id')
                ->leftjoin('luggage','oneway_ticket.id_luggage','=','luggage.id')
                ->first();
            return view('customer/print_ticket',['ticket'=>$oneway_ticket,'airport'=>$airport,'type'=>'1']);
        }
        elseif ($type==2){
            $twoway_ticket = twoway_ticket::where('twoway_ticket.id_seat_outward', $id_seat)
                ->leftjoin('seat','twoway_ticket.id_seat_outward','=','seat.id')
                ->leftjoin('flight','twoway_ticket.id_flight_outward','=','flight.id')
                ->leftjoin('luggage','twoway_ticket.id_luggage','=','luggage.id')
                ->first();
            $airport = airport::get();
            $flight = flight::get();
            $seat = seat::get();
            return view('customer/print_ticket',[
                'value2'=>$twoway_ticket,
                'airport'=>$airport,
                'flight'=>$flight,
                'seat'=>$seat,
                'type'=>'2'
            ]);
        }
    }
}
