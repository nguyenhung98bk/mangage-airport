@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h2>Thông tin vé</h2>
            <table class="table">
                @if($type==1)
                <tr>
                    <th>Loại vé</th>
                    <td>Một chiều</td>
                </tr>
                <tr>
                    <th>Chuyến bay</th>
                    <td>@foreach($airport as $air)
                            @if($ticket->id_start_airport == $air->id)
                                {{$air->name_airport}}
                            @endif
                        @endforeach
                        -
                        @foreach($airport as $air)
                            @if($ticket->id_end_airport == $air->id)
                                {{$air->name_airport}}
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>Số ghế</th>
                    <td>{{$ticket->id_seat_inline}}</td>
                </tr>
                <tr>
                    <th>Thời gian</th>
                    <td>{{$ticket->departure_date}} {{$ticket->departure_time}}</td>
                </tr>
                <tr>
                    <th>Hành lý</th>
                    <td>{{$ticket->weight}}KG</td>
                </tr>
                <tr>
                    <th>Giá</th>
                    <td>{{$ticket->price}}</td>
                </tr>
                @else
                    <tr>
                        <th>Loại vé</th>
                        <td>Khứ hồi</td>
                    </tr>
                    <tr>
                        <th>Chuyến bay</th>
                        <td>@foreach($airport as $air)
                                @if($value2->id_start_airport == $air->id)
                                    {{$air->name_airport}}
                                @endif
                            @endforeach
                            -
                            @foreach($airport as $air)
                                @if($value2->id_end_airport == $air->id)
                                    {{$air->name_airport}}
                                @endif
                            @endforeach</td>
                    </tr>
                    <tr>
                        <th>Thời gian đi</th>
                        <td>{{$value2->departure_date}} {{$value2->departure_time}}</td>
                    </tr>
                    <tr>
                        <th>Thời gian về</th>
                        <td>@foreach($flight as $f)
                                @if($value2->id_flight_return==$f->id)
                                    {{$f->departure_date}} {{$f->departure_time}}
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Số ghế lượt đi</th>
                        <td>{{$value2->id_seat_inline}}</td>
                    </tr>
                    <tr>
                        <th>Số ghế lượt về</th>
                        <td>@foreach($seat as $s)
                                @if($value2->id_seat_return==$s->id)
                                    {{$s->id_seat_inline}}
                                @endif
                            @endforeach</td>
                    </tr>
                    <tr>
                        <th>Hành lý</th>
                        <td>{{$value2->weight}}KG</td>
                    </tr>
                    <tr>
                        <th>Giá</th>
                        <td>{{$value2->price}}</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
@endsection
