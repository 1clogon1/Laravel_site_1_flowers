<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    <title>Продукты</title>
</head>
<body>

<div class="container py-3">
    <header>
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            <a href="{{route('welcome')}}" class="d-flex align-items-center text-dark text-decoration-none">
                <img class="d-block" src="{{ asset('/storage/app/public/uploads/logo2.png') }}" alt="slide" height="150px">
            </a>

            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('cart')}}">Корзина</a>
                <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('product')}}">Товары</a>
                <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('info')}}">Где нас найти?</a>
                @guest
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('login')}}">Login</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('register')}}">Register</a>
                @endguest

                @auth
                    @if(Auth::user()->isAdmin())
                        <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('admin')}}">admin panel</a>
                    @endif
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('cart')}}">Корзина</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('order')}}">Заказы</a>
                @endauth


                @auth
                    <!--Специальная деректива выводящая в ней данные только для зарегистрированных пользователей-->
                        <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('logout')}}">Log Out</a>

                    @endauth
            </nav>
        </div>
    </header>

    <div>
        <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">


        </nav>
    </div>
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        @foreach($product as $products_name)
            <h1 class="display-4 fw-normal">{{$products_name->name}}</h1>
        @endforeach
    </div>
    <br>
    <br>
    <br>
    <br>
    <div class="row row-cols-1 row-cols-md-3 g-4">


    </div>
    @foreach($product as $products)
        <div class="row g-3 needs-validation shadow-lg p-3 mb-5 bg-body rounded">

            <div class="col-md-5">
                <div class="col">
                    <div class="card">
                        <img src="{{ asset('/storage/'.$products->image) }}"
                             alt="Изображение не загрузилось">
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <label for="validationCustom07" class="form-label text-dark"><h3>Название:</h3>
                    <h4>{{$products->name}}</h4></label>
                <div class="col-md-10">
                    <label for="validationCustom07" class="form-label text-dark"><h3>Цена:</h3>
                        <h4>{{$products->price}} руб</h4></label>

                </div>
                <div class="col-md-10">
                    <label for="validationCustom07"
                           class="form-label text-dark"><h3>Страна-производитель: </h3>
                        <h4>{{$products->country}}</h4>
                    </label>

                </div>
                <div class="col-md-10">

                    <label for="validationCustom07" class="form-label text-dark"><h3>Вид товара:</h3>

                        <h4>{{$products->category_id}}</h4>

                    </label>

                </div>
                <div class="col-md-10">
                    <label for="validationCustom07" class="form-label text-dark"><h3>Цвет:</h3>
                        <h4>{{$products->color}}</h4>
                    </label>
                </div>
            </div>



            <form method="get" action="{{route('add_cart',$products->id)}}">
                @csrf
                <div class="d-grid gap-2 d-md-block">
                    <button type="submit" class="btn btn-outline-dark shadow p-2 bg-gray rounded">В корзину</button>
                </div>
            </form>

        </div>
@endforeach
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
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>

