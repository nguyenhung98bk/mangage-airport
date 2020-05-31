@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h2>Danh sách chuyến bay lượt đi</h2>
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
                        <td>{{$value->price}}</td>
                        <td>{{$value->departure_date}} {{$value->departure_time}}</td>
                        <td><button>Đặt vé</button></td>
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
                @foreach($flight_return as $key=>$value)
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
                        <td>{{$value->price}}</td>
                        <td>{{$value->departure_date}} {{$value->departure_time}}</td>
                        <td><button onclick="confirm('{{$value->id}}','{{$id_luggage}}');">Đặt vé</button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
