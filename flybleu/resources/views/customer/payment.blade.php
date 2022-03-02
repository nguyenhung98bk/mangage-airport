@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Mua vé</h2>
        <p>Số tiền bạn cần thanh toán là {{$ticket->price}}</p>
        <p>Bạn vui lòng click vào <a target="_blank" href="http://localhost:8001">đây để thanh toán</a> và điền mã giao dịch bên dưới</p>
        <input type="hidden" name="_token" value="{{ csrf_token() }} ">
        <div class="form-group">
            <label class="" for="trading_code">Mã giao dịch:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="trading_code" name="trading_code" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary" style="width: 100%" onclick="getListTrade(
                    '{{$ticket->id}}',
                    '{{$ticket->price}}');">Xác nhận</button>
            </div>
        </div>
    </div>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function getListTrade(id,price) {
            var code_trade = document.getElementById("trading_code").value;
            var request = new XMLHttpRequest();
            price = parseInt(price);
            request.open('GET', 'http://localhost:8001/getlistflytrade', true);
            request.onload = function() {
                let check1 = false;
                let check2 = false;
                var data = JSON.parse(this.response)
                data.forEach(trade => {
                    if(code_trade==trade.code_trade) {
                        amount = parseInt(trade.amount);
                        check2 = true;
                        if (price <= amount) {
                            check1=true;
                            updateStatus(id,code_trade);
                        }
                    }
                })
                if(check1==false){
                    if(check2==true){
                        alert("Tiền bạn đã thanh toán không đủ!");
                    }
                    else{
                        alert("Mã giao dịch không đúng!");
                    }
                }
            }
            request.send()
        }
        function updateStatus(id,code_trade) {
            $.ajax({
                type: "POST",
                url: '/finish_payment',
                data: {
                    id: id,
                    code_trade: code_trade,
                    _token: '{{csrf_token()}}'
                },
                success: function (data) {
                    if(data=="false"){
                        alert("Mã giao dịch đã sử dụng cho thanh toán khác!");
                    }
                    else if(data=="false2"){
                        alert("Ghế đã có người đặt, hãy sử dụng mã giao dịch cho giao dịch khác!");
                    }
                    else{
                        alert(data);
                        window.location.href = "{{route('historyBuy')}}"
                    }
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
                },
            });
        }
    </script>
@endsection
