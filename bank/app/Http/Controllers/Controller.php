<?php

namespace App\Http\Controllers;

use App\card;
use App\history_trade;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function payment(Request $request){
        $code_card = $request->code_card;
        $password = $request->password1;
        $amount = $request->amount;
        $balance = card::where([['code_card',$code_card],['password',$password]])->value('balance');
        if($balance==null){
            echo "sai mật khẩu";
        }
        else{
            $balance-=$amount;
            if($balance<0){
                echo "Tài khoản không đủ";
            }
            else {
                $codeTrade = $this->creatCodeTrade();
                card::where('code_card',$code_card)->update(['balance'=>$balance]);
                history_trade::insert(['code_card'=>$code_card,'code_trade'=>$codeTrade,'amount'=>$amount]);
                return view('displayCodeTrade',['codeTrade'=>$codeTrade])->with(['flag'=>'success','message'=>'Giao dịch thành công']);
            }
        }
    }
    public function creatCodeTrade(){
        $codeTrade = date("Ymdhis");
        $codeTrade = 'flyblue'.$codeTrade;
        return $codeTrade;
    }
}
