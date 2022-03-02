@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chuyến bay gần nhất</div>

                <div class="card-body">
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
                                <td id="{{$value->id}}_price">{{$value->price_flight}}</td>
                                <td>{{$value->departure_date}} {{$value->departure_time}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
