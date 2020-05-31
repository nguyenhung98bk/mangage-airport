@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Mua vé</h2>
        <form action="{{url('bookticket')}}" method="POST" class="col-sm-12">
            <input type="hidden" name="_token" value="{{ csrf_token() }} ">
            <div class="form-group">
                <label class="" for="type_ticket">Loại vé:</label>
                <div class="col-sm-6">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="type_ticket" onclick="oneway();" checked="checked" value="oneway">Một chiều
                        </label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" id="2way" name="type_ticket" onclick="twoway();" value="twoway">Khứ hồi
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="" for="start_airport">Điểm đi:</label>
                <div class="col-sm-6">
                    <select class="form-control" id="start_airport" name="start_airport">
                        <option value="0">Chọn điểm đi</option>
                        @foreach($airport as $value)
                            <option value="{{$value->id}}">{{$value->name_airport}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="" for="end_airport">Điểm đến:</label>
                <div class="col-sm-6">
                    <select class="form-control" id="end_airport" name="end_airport">
                        <option>Chọn điểm đên</option>
                        @foreach($airport as $value)
                            <option value="{{$value->id}}">{{$value->name_airport}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="" for="date_departure">Ngày đi:</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="date_departure" required>
                </div>
            </div>
            <div class="form-group" id="date_return">

            </div>
            <div class="form-group">
                <label>Hành lý:</label>
                <div class="col-sm-6">
                    <select class="form-control" name="luggage">
                        @foreach($luggage as $value)
                            <option value="{{$value->id}}">{{$value->weight}}Kg-{{$value->price_luggage}}VNĐ</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary" style="width: 100%">Mua vé</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        function twoway() {
            $("#span_date_return").remove();
            $("#div_date_return").remove();
            var span = document.createElement("span");
            span.innerHTML = "Ngày về:";
            span.id = "span_date_return";
            document.getElementById("date_return").appendChild(span);
            var div = document.createElement("div");
            div.id = "div_date_return";
            div.className = "col-sm-6";
            document.getElementById("date_return").appendChild(div);
            var input = document.createElement("input");
            input.type = "date";
            input.name = "date_return";
            input.required = true;
            input.className = "form-control";
            document.getElementById("div_date_return").appendChild(input);
        }
        function oneway(){
            $("#span_date_return").remove();
            $("#div_date_return").remove();
        }
    </script>
@endsection
