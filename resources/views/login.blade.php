<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    <title>Аунтефикация</title>
</head>
<body>

<div class="container py-2">
    <header>
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            <a href="{{route('welcome')}}" class="d-flex align-items-center text-dark text-decoration-none">
                <img class="d-block" src="{{ asset('/storage/app/public/uploads/logo2.png') }}" alt="slide" height="150px">            </a>

            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('info')}}">Где нас найти?</a>

                <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('register')}}">Register</a>
            </nav>
        </div>
    </header>


    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Аунтефикацияz</h1>
    </div>

    <ul>

    </ul>

    <form class="row g-3 needs-validation shadow-lg p-3 mb-5 bg-body rounded" action="{{route('login')}}" method="POST">
        @csrf
        <div class="col-md-10">
            <label for="validationCustom07" class="form-label text-dark">Логин</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input name="login" id="login" type="login" class="form-control"  aria-describedby="emailHelp" placeholder="Введите email" required value={{old('email')}} >
            </div><br>
            @error('login')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="col-md-10">
            <label for="validationCustom07" class="form-label text-dark">Пароль</label>
            <input name="password" id="password" type="password" class="form-control"  placeholder="Введите пароль" required>
            @error('password')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div><br>
        <div class="col-md-10">
            <input type="checkbox" id="remember" name="remember" class="form-check-input">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div><br>
        <div class="text-center">
            <button  type="submit" class="me-3 py-2 text-dark text-decoration-none btn btn-primary w-50">Авторизоваться</button>
        </div>
    </form>

</div>

</body>
</html>

