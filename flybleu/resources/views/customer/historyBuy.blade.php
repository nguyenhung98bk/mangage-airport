@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h2>Lịch sử đặt vé</h2>
            <table class="table">
                <thead>
                <td>STT</td>
                <td>Loại vé</td>
                <td>Chuyến bay đi</td>
                <td>Chỗ ngồi</td>
                <td>Thời gian bay</td>
                <td>Chuyến bay về</td>
                <td>Chỗ ngồi</td>
                <td>Thời gian bay</td>
                <td>Hành lý</td>
                <td>Chi phí</td>
                <td>Trạng thái</td>
                </thead>
                <tbody>
                @foreach($oneway_ticket as $key=>$value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>Một chiều</td>
                        <td>
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
                        </td>
                        <td>{{$value->id_seat_inline}}
                        </td>
                        <td>{{$value->departure_date}} {{$value->departure_time}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{$value->weight}}KG</td>
                        <td>{{$value->price}}</td>
                        <td>@if($value->status_ticket==2)
                                Chưa thanh toán
                            @elseif($value->status_ticket==1)
                                Thanh toán thành công
                            @else
                                Đã hủy
                            @endif
                        </td>
                        <td>
                        @if($value->status_ticket==2)
                            <a href="{{url('re_payment',$value->id_seat)}}"><button>Thanh toán</button></a>
                        @endif
                        </td>
                        <td>
                            @if($value->status_ticket==2)
                                <a href="{{route('cancel_ticket',[$value->id_seat,1])}}"><button>Hủy vé</button></a>
                            @endif
                        </td>
                        <td>
                            @if($value->status_ticket==1)
                                <a href="{{route('print_ticket',[$value->id_seat,1])}}"><button>Xem vé</button></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                @foreach($twoway_ticket as $key=>$value2)
                    <tr>
                        <td>{{$key+1+$count}}</td>
                        <td>Khứ hồi</td>
                        <td>
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
                        </td>
                        <td>{{$value2->id_seat_inline}}
                        </td>
                        <td>{{$value2->departure_date}} {{$value2->departure_time}}</td>
                        <td>
                            @foreach($flight as $f)
                                @if($f->id==$value2->id_flight_return)
                                    @foreach($airport as $air)
                                        @if($f->id_start_airport == $air->id)
                                            {{$air->name_airport}}
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                            -
                                @foreach($flight as $f)
                                    @if($f->id==$value2->id_flight_return)
                                        @foreach($airport as $air)
                                            @if($f->id_end_airport == $air->id)
                                                {{$air->name_airport}}
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                        </td>
                        <td>
                            @foreach($seat as $s)
                                @if($value2->id_seat_return==$s->id)
                                {{$s->id_seat_inline}}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($flight as $f)
                                @if($value2->id_flight_return==$f->id)
                                    {{$f->departure_date}} {{$f->departure_time}}
                                @endif
                            @endforeach
                        </td>
                        <td>{{$value2->weight}}KG</td>
                        <td>{{$value2->price}}</td>
                        <td>@if($value2->status_ticket==2)
                                Chưa thanh toán
                            @elseif($value2->status_ticket==1)
                                Thanh toán thành công
                            @else
                                Đã hủy
                            @endif
                        </td>
                        <td>
                        @if($value2->status_ticket==2)
                            <a href="{{url('re_payment2',$value2->id_seat_outward)}}"><button>Thanh toán</button></a>
                        @endif
                        </td>
                        <td>
                            @if($value2->status_ticket==2)
                                <a href="{{route('cancel_ticket',[$value2->id_seat_outward,2])}}"><button>Hủy vé</button></a>
                            @endif
                        </td>
                        <td>
                            @if($value2->status_ticket==1)
                                <a href="{{route('print_ticket',[$value2->id_seat_outward,2])}}"><button>Xuất vé</button></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

