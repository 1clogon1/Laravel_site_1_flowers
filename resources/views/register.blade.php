<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    <title>Регистрация</title>
</head>
<body>

<div class="container py-2">
    <header>
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            <a href="{{route('welcome')}}" class="d-flex align-items-center text-dark text-decoration-none">
                <img class="d-block" src="{{ asset('/storage/app/public/uploads/logo2.png') }}" alt="slide" height="150px">
            </a>

            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('info')}}">Где нас найти?</a>

                <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('login')}}">Log In</a>
            </nav>
        </div>
    </header>


    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Регистрация</h1>
    </div>



    <form class="row g-3 needs-validation shadow-lg p-3 mb-5 bg-body rounded" action="{{route('register')}}"
          method="POST">
        @csrf
        <div class="col-md-10">
            <label for="validationCustom07" class="form-label text-dark">Имя</label>
            <input name="name" id="name" type="name" class="form-control" aria-describedby="namelHelp"
                   placeholder="Введите имя" value="{{old('name')}}" required autofocus><br>
            @error('name')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="col-md-10">
            <label for="validationCustom07" class="form-label text-dark">Фамилия</label>
            <input name="surname" id="surname" type="surname" class="form-control" aria-describedby="surnamelHelp"
                   placeholder="Введите фамилию" value="{{old('surname')}}" required autofocus><br>
            @error('surname')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="col-md-10">
            <label for="validationCustom07" class="form-label text-dark">Отчество</label>
            <input name="patronymic" id="patronymic" type="patronymic" class="form-control"
                   aria-describedby="patronymiclHelp" placeholder="Введите отчество" value="{{old('patronymic')}}"
                   required autofocus><br>
            @error('patronymic')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="col-md-10">
            <label for="validationCustom07" class="form-label text-dark">login</label>
            <input name="login" id="login" type="login" class="form-control" aria-describedby="loginlHelp"
                   placeholder="Введите login" value="{{old('login')}}" required autofocus><br>
            @error('login')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="col-md-10">
            <label for="validationCustom07" class="form-label text-dark">Email</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input name="email" id="email" type="email" class="form-control" aria-describedby="emailHelp"
                       placeholder="Введите  email" {{old('email')}} required>
            </div>
            <br>
            @error('email')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="col-md-10">
            <label for="validationCustom07" class="form-label text-dark">Пароль</label>
            <input name="password" id="password" type="password" class="form-control" placeholder="Введите пароль"
                   required><br>
            @error('password')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="col-md-10">
            <label for="validationCustom07" class="form-label text-dark">Повторите пароль</label>
            <input name="password_confirmation" id="password_confirmation" type="password" class="form-control"
                   placeholder="Повторите пароль" required><br>
            @error('password_confirmation')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-check">
            <input type="checkbox" class="checkbox" id="checkbox" required>
            <label class="form-check-label" for="exampleCheck1">Даю согласие на обработку своих данных</label><br>
            @error('checkbox')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="text-center">
            <button type="submit" class="me-3 py-2 text-dark text-decoration-none btn btn-primary w-50">
                Зарегистрироваться
            </button>
        </div><br>
        <div class="text-center">
            <a class="me-3 py-2 text-dark text-decoration-none text-green" href="{{route('login')}}">Login</a>
        </div><br>
    </form>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>

