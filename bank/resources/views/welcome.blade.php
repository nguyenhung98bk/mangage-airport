<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </head>
    <body>
    <div class="container">
        <h2>Thanh toán</h2>
        <form action="{{url('payment')}}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="code_card">Mã thẻ</label>
                <input type="text" class="form-control col-sm-4" placeholder="Mã thẻ" name="code_card" required>
            </div>
            <div class="form-group">
                <label for="pwd">Mật khẩu:</label>
                <input type="password" class="form-control col-sm-4" placeholder="Mật khẩu" name="password" maxlength="6" required>
            </div>
            <div class="form-group">
                <label for="amount">Số tiền:</label>
                <input type="text" class="form-control col-sm-4" placeholder="Số tiền" name="amount" required>
            </div>
            <button type="submit" class="btn btn-primary">Thanh toán</button>
        </form>
    </div>
    </body>
</html>
