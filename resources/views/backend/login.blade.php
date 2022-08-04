<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Admin</title>
    <link rel="stylesheet" href="{{ asset('css/backend/main.css') }}">
</head>

<body>
    <div class="admin" style="background-image: url('{{asset('images/backend/logo-bgc.jpg')}}')">
        <div class="container d-flex"
            style="height: 100vh">
            <div class="admin-login w-50 m-auto">
                <h2 class="mb-3 mt-4 text-white"> Đăng nhập admin </h2>
                <form action="{{route('fe.admin-login.post')}}" method="POST">
                    @csrf
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <button class="btn btn-primary mt-3">Đăng nhập</button>
                </form>
            </div>
        </div>
    </div>


    <!-- Template Javascript -->
    <script src="{{ asset('js/backend/index.js') }}"></script>
</body>

</html>
