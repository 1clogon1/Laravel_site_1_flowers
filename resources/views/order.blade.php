<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    <title>Продукты</title>
</head>
<body>

<div class="container py-3">
    <header>
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            <a href="{{route('welcome')}}" class="d-flex align-items-center text-dark text-decoration-none">
                <img class="d-block" src="{{ asset('/storage/app/public/uploads/logo2.png') }}" alt="slide"
                     height="150px"> </a>

            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('info')}}">Где нас найти?</a>

                @guest
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('login')}}">Login</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('register')}}">Register</a>
                @endguest

                @auth
                    @if(Auth::user()->isAdmin())
                        <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('admin')}}">admin panel</a>
                    @endif
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('product')}}">Товары</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('cart')}}">Корзина</a>
                @endauth


                @auth
                <!--Специальная деректива выводящая в ней данные только для зарегистрированных пользователей-->
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('logout')}}">Log Out</a>
                @endauth
            </nav>
        </div>
    </header>


    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Заказы</h1>
    </div>
    @isset($Ok_zakaz)
        <div class="alert alert-success" role="alert">
            {{$Ok_zakaz}}
        </div>
    @endisset
    @isset($Error_zakaz)
        <div class="alert alert-danger" role="alert">
            {{$Error_zakaz}}
        </div>
    @endisset
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Номер</th>
            <th scope="col">Фото</th>
            <th scope="col">Название</th>
            <th scope="col">Цена</th>
            <th scope="col">Статус</th>
            <th scope="col">Описание</th>
            <th scope="col">Количество</th>
            <th scope="col">Функции</th>
        </tr>
        </thead>
        <tbody>
        @php $i=1; @endphp
        @foreach($users as $order)
            <tr>
            <td>{{$i++}}</td>
            <td><img src="{{ asset('/storage/'.$order->image) }}" alt="Изображение не загрузилось" height="100"
                     width="100"></td>
            <td>{{$order->name}}</td>
            <td>{{$order->price}}</td>
            <td>{{$order->status}}</td>
            <td>{{$order->resons}}</td>
            <td>{{$order->sum}}</td>
            <td>

                <form method="get" action="{{route('delete_order',$order->order_id)}}">
                    @csrf
                    <a class="me-3 py-2 text-dark text-decoration-none"
                       href="{{route('delete_order',$order->order_id)}}">&#128465;</a>
                </form>

            </td>
            </tr>
        @endforeach
        </tbody>
    </table>


</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

</body>
</html>

