@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row" id="parent">
            <h2>Danh sách khách hàng</h2>
            <table class="table">
                <thead>
                <th>STT</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th><input id="name" class="form-control" placeholder="Tìm kiếm khách hàng theo email" onkeyup="search_customer(this.value);"></th>
                </thead>
                <tbody id="child">
                @foreach($user as $key => $value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->email}}</td>
                        <td><a href="{{url('view_history',$value->id)}}"><button>Lịch sử giao dịch</button></a></td>
                    </tr>
                @endforeach
                </tbody>
                <tbody id="list">

                </tbody>
            </table>
        </div>
    </div>
    <div class="col-xs-6 col-right" style="float:right;">
        <div class="dataTables_paginate paging_bootstrap">
            {!! $user->links() !!}
        </div>
    </div>
    <script>
        var email="";
        function search_customer(value){
            email = value;
            $.ajax({
                type: "POST",
                url: '/search_customer' ,
                data: {
                    email:email,
                    _token: '{{csrf_token()}}' },
                success: function (data) {
                    console.log(data);
                    $("tbody").remove("#child");
                    document.getElementById("list").innerHTML = data;
                    $('#countryList').fadeIn();
                    $('#countryList').html(data);
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
                },
            });
        }
    </script>
@endsection
