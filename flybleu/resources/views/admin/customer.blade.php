@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h2>Danh sách khách hàng</h2>
            <table class="table">
                <thead>
                <th>STT</th>
                <th>Họ tên</th>
                <th>Email</th>
                </thead>
                <tbody>
                @foreach($user as $key => $value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->email}}</td>
                        <td><a href="{{url('view_history',$value->id)}}"><button>Lịch sử giao dịch</button></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-xs-6 col-right" style="float:right;">
        <div class="dataTables_paginate paging_bootstrap">
            {!! $user->links() !!}
        </div>
    </div>
@endsection
