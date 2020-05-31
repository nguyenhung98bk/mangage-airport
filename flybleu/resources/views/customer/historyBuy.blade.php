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
                        @if($value->status_ticket==2)
                            <td><a href="{{url('re_payment',$value->id_seat)}}"><button>Thanh toán</button></a></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

