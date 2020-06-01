@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h2>Danh sách chuyến bay lượt đi</h2>
            <div class="col-sm-8">
                <button type="button" style="float: right;" class="btn" data-toggle="modal" data-target="#detail_flight" onclick="preview();">Xem chuyến bay đã chọn</button>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Chuyến bay</th>
                    <th>Giá</th>
                    <th>Thời gian</th>
                </tr>
                </thead>
                <tbody>
                @foreach($flight_departure as $key=>$value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>
                            @if(!empty($airport))
                                @foreach($airport as $air)
                                    @if($value->id_start_airport == $air->id)
                                        {{$air->name_airport}}
                                    @endif
                                @endforeach
                                -
                                @foreach($airport as $air)
                                    @if($value->id_end_airport == $air->id)
                                        {{$air->name_airport}}
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td>{{$value->price_flight}}</td>
                        <td>{{$value->departure_date}} {{$value->departure_time}}</td>
                        <td>
                            <button type="button" data-toggle="modal" data-target="#myModal1"
                                    onclick="getData1('{{$value->id}}','{{$id_luggage}}');">
                                Chọn chuyến bay
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <h2>Danh sách chuyến bay lượt về</h2>
            <table class="table">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Chuyến bay</th>
                    <th>Giá</th>
                    <th>Thời gian</th>
                </tr>
                </thead>
                <tbody>
                @foreach($flight_return as $key=>$value2)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>
                            @if(!empty($airport))
                                @foreach($airport as $air)
                                    @if($value2->id_start_airport == $air->id)
                                        {{$air->name_airport}}
                                    @endif
                                @endforeach
                                -
                                @foreach($airport as $air)
                                    @if($value2->id_end_airport == $air->id)
                                        {{$air->name_airport}}
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td>{{$value2->price_flight}}</td>
                        <td>{{$value2->departure_date}} {{$value2->departure_time}}</td>
                        <td>
                            <button type="button" data-toggle="modal" data-target="#myModal2"
                                    onclick="getData3('{{$value2->id}}','{{$id_luggage}}');">
                                Chọn chuyến bay
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="myModal1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Mời bạn chọn ghế</h4>
                    </div>
                    <div class="modal-body">
                        <p>Màu xanh là ghế còn chỗ</p>
                        @if(isset($value))
                            @foreach($seat as $s)
                                @if($s->id_flight==$value->id)
                                    <button  onclick="getData2('{{$s->id}}','{{$s->id_seat_inline}}');" style="width: 30px;
                                    @if($s->status==0)
                                        background-color:green;
                                    @else
                                        background-color:red;
                                    @endif">
                                        {{$s->id_seat_inline}}
                                    </button>
                                    @if($s->id_seat_inline%5==0)
                                        <br>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                        <br>
                        <p id="Notification"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đồng ý</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Mời bạn chọn ghế</h4>
                    </div>
                    <div class="modal-body">
                        <p>Màu xanh là ghế còn chỗ</p>
                        @if(isset($value2))
                            @foreach($seat as $s)
                                @if($s->id_flight==$value2->id)
                                    <button  onclick="getData4('{{$s->id}}','{{$s->id_seat_inline}}');" style="width: 30px;
                                    @if($s->status==0)
                                        background-color:green;
                                    @else
                                        background-color:red;
                                    @endif">
                                        {{$s->id_seat_inline}}
                                    </button>
                                    @if($s->id_seat_inline%5==0)
                                        <br>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                        <br>
                        <p id="Notification2"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đồng ý</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="detail_flight" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thông tin chuyến bay:</h4>
                </div>
                <div class="modal-body">
                    <div id="countryList"></div>
                </div>
                <div class="modal-footer">
                    <button onclick="confirm();" type="button" class="btn btn-default" data-dismiss="modal">Xác nhận</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id_luggage;
        var id_seat_departure;
        var id_seat_return;
        var id_flight_departure;
        var id_flight_return;
        function getData1(id_flight_departure2,id_luggage2) {
            id_flight_departure = id_flight_departure2
            id_luggage = id_luggage2;
        }
        function getData3(id_flight_return2,id_luggage2) {
            id_flight_return = id_flight_return2
        }
        function getData2(id_seat2,id_seat_inFlight) {
            id_seat_departure = id_seat2;
            document.getElementById("Notification").innerHTML = "Bạn đã chọn ghế số "+id_seat_inFlight;
        }
        function getData4(id_seat3,id_seat_inFlight) {
            id_seat_return = id_seat3;
            document.getElementById("Notification2").innerHTML = "Bạn đã chọn ghế số "+id_seat_inFlight;
        }
        function preview() {
            $.ajax({
                type: "POST",
                url: '/preview2',
                data: {
                    id_flight_departure:id_flight_departure,
                    id_flight_return:id_flight_return,
                    id_seat_return:id_seat_return,
                    id_seat_departure:id_seat_departure,
                    id_luggage:id_luggage,
                    _token: '{{csrf_token()}}' },
                success: function (data) {
                    $('#countryList').fadeIn();
                    $('#countryList').html(data);
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);

                },
            });
        }
        function confirm() {
            $.ajax({
                type: "POST",
                url: '/confirmBuy2',
                data: {
                    id_flight_departure:id_flight_departure,
                    id_flight_return:id_flight_return,
                    id_seat_return:id_seat_return,
                    id_seat_departure:id_seat_departure,
                    id_luggage:id_luggage,
                    _token: '{{csrf_token()}}'
                },
                success: function (data) {
                    alert(data);
                    window.location.href = "{{route('payment2')}}"
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
                },
            });
        }
    </script>
@endsection
