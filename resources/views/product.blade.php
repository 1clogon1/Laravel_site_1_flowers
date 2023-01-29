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
        <h1 class="display-4 fw-normal">Продуктыs</h1>
    </div>
    <br>
    <br>



    <div class="btn-group">
        <div class="dropdown p-2">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                По цене
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item"
                       href="{{route('index_desk_asc', 'asc')}}">По возрастанию</a></li>
                <li><a class="dropdown-item"
                       href="{{route('index_desk_asc', 'desc')}}">По убыванию</a></li>

            </ul>
        </div>

        <div class="dropdown p-2">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Категории
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item"
                       href="{{route('product')}}">Все</a></li>
                @if($category)
                    @foreach($category as $categor)
                        <li><a class="dropdown-item"
                               href="{{route('productByCategory', $categor->id)}}">{{$categor->category}}</a></li>
                    @endforeach
                @endif
            </ul>
        </div>

        <div class="dropdown p-2">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                Страна производителя
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item"
                       href="{{route('index_country', 'asc')}}">По возрастанию</a></li>
                <li><a class="dropdown-item"
                       href="{{route('index_country', 'desc')}}">По убыванию</a></li>
            </ul>
        </div>

        <div class="dropdown p-2">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                По названию
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item"
                       href="{{route('index_name', 'asc')}}">По возрастанию</a></li>
                <li><a class="dropdown-item"
                       href="{{route('index_name', 'desc')}}">По убыванию</a></li>
            </ul>
        </div>
    </div>
    <br>
    <br>
    <div class="row row-cols-1 row-cols-md-3 g-4">

        @foreach($product as $products)
            <div class="col">
                <div class="card">
                    <img class="rounded-2" src="{{ asset('/storage/'.$products->image) }}"
                         alt="Изображение не загрузилось">
                    <div class="card-body">

                        <h5 class="card-title">name: {{$products->name}}</h5>
                        <p class="card-text">price: {{$products->price}}</p>
                        <form method="get" action="{{route('add_cart2',$products->id)}}">
                            @csrf
                            <div class="d-grid gap-2 d-md-block">
                                <button
                                    class="btn btn-outline-dark shadow p-2 bg-gray rounded">
                                    Подробнее о товаре
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @isset($path)
        <img src=src={{asset('/storage/app/images/'.$path)}}" alt="">
    @endisset
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

</body>
</html>

