<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('bootstrap-5.0.2/dist/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Merriweather">
    <style>
        .fdjhdf {
            font-family: 'Merriweather', serif;
            font-size: 48px;
        }
    </style>

    <title>Главная</title>
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
                <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('product')}}">Товары</a>

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
</div>

<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h1>Цветы — это больше, чем слова</h1>
</div>
<div class="container py-3">
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">

        @php $i=0; @endphp
        @foreach($product as $products)
        @if ($array[$i]=="active")
                <div class="carousel-item active">
                    <img class="d-block w-100 h-100" src="{{ asset('/storage/'.$products->image) }}" alt="slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>{{$products->name}}</h3>
                    </div>
                </div>
            @else
                <div class="carousel-item">
                    <img class="d-block w-100 h-100" src="{{ asset('/storage/'.$products->image) }}" alt="slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>{{$products->name}}</h3>
                    </div>
                </div>
        @endif
            @php $i++; @endphp
        @endforeach

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
</div>
<div class="pricing-header p-3 pb-md-4 mx-auto text-center fdjhdf">
    <h5 >Доставляем цветы круглосуточно, зная только номер мобильного телефона.</h5>
    <h5 > Если опоздаем – цветы в подарок! Если не понравится букет – мы его бесплатно поменяем.</h5>
</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>

