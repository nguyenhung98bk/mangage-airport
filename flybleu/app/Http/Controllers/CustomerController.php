<?php

namespace App\Http\Controllers;

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
                'flight_return'=>$flight_return,
                'airport'=>$airport,
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
<tr><td>Gói hành lý:</td><td>' . $luggage->weight . 'Kg</td></tr>
<tr><td>Tổng chi phí:</td><td>' . number_format($price) . 'VNĐ</td></tr></table>';
        }
        return $output;
    }
    public function payment(){
        $oneway_ticket = oneway_ticket::where('id_customer',Auth::user()->id)->orderBy('id', 'desc')->first();
        $queue = (new \App\Jobs\BlockTicket($oneway_ticket->id))->delay(600);
        $this->dispatch($queue);
        return view('customer/payment',['ticket'=>$oneway_ticket]);
    }
    public function re_payment($id){
        $oneway_ticket = oneway_ticket::where('id_seat',$id)->first();
        return view('customer/payment',['ticket'=>$oneway_ticket]);
    }
    public  function historyBuy(){
        $oneway_ticket = oneway_ticket::where('oneway_ticket.id_customer', Auth::user()->id)
            ->leftjoin('seat','oneway_ticket.id_seat','=','seat.id')
            ->leftjoin('flight','oneway_ticket.id_flight','=','flight.id')
            ->leftjoin('luggage','oneway_ticket.id_luggage','=','luggage.id')
            ->get();
        $flight = flight::get();
        $airport = airport::get();
        $seat = seat::get();
        $luggage = luggage::get();
        return view('customer/historyBuy',[
            'oneway_ticket'=>$oneway_ticket,
            'flight'=>$flight,
            'airport'=>$airport,
            'seat'=>$seat,
            'luggage'=>$luggage,
        ]);
    }
    public function finish_payment(Request $request){
        $id = $request->get('id');
        $code_trade = $request->get('code_trade');
        $ticket_count = oneway_ticket::where('code_trade',$code_trade)->count();
        if($ticket_count==0){
            $id_seat = oneway_ticket::where('id',$id)->value('id_seat');
            seat::where('id',$id_seat)->update(['status'=>"1"]);
            oneway_ticket::where('id',$id)->update(['status_ticket'=>"1",'code_trade'=>$code_trade]);
            return "Thanh toán thành công!";
        }
        else{
            return "false";
        }
    }
}
