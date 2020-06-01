@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tạo tài khoản thành công</div>

                <div class="card-body">
                    {{$name}}
                </div>
                <div class="card-body">
                    {{$email}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
