<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    <title>Админ панельmm</title>
</head>
<body>

<div class="container py-3">
    <header>
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            <a href="{{route('welcome')}}" class="d-flex align-items-center text-dark text-decoration-none">
                <img class="d-block" src="{{ asset('/storage/app/public/uploads/logo2.png') }}" alt="slide" height="150px">            </a>

            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                @auth
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('logout')}}">Где нас найти?</a>

                @if(Auth::user()->isAdmin())
                        <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('welcome')}}">Вернутся на
                            сайт</a>
                    @endif
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('product')}}">Товары</a>
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
    <a class="d-flex align-items-center text-dark text-decoration-none">
        <span class="fs-1">Категория</span>
    </a>
    <form class="row needs-validation shadow-lg p-3 mb-5 bg-body rounded" action="{{route('create_category')}}"
          method="POST">
        @csrf
        <div class="col-md-10">
            <label for="validationCustom07" class="form-label text-dark">Category</label>
            <div class="input-group has-validation">
                <input name="category" id="category" type="text" class="form-control" aria-describedby="emailHelp"
                       placeholder="Введите новую категорию" required value="{{old('name')}}">
            </div>
            <br>
            @error('category')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="text-center">
            <button type="submit" class="me-3 py-2 text-dark text-decoration-none btn btn-primary w-50">Авторизоваться
            </button>
        </div>
    </form>

    <a class="d-flex align-items-center text-dark text-decoration-none">
        <span class="fs-1">Продукт</span>
    </a>
    <form class="row g-3 needs-validation shadow-lg p-3 mb-5 bg-body rounded" action="{{route('create_product')}}"
          method="POST" enctype="multipart/form-data" id="upload-image">
        @csrf
        <div class="col-md-10">
            <label for="validationCustom07" class="form-label text-dark">Продукт</label>
            <div class="input-group has-validation">
                <input name="name" id="name" type="text" class="form-control" aria-describedby="emailHelp"
                       placeholder="Введите название продукта" required value="{{old('name')}}">
            </div>
            <br>
            @error('name')
            <div class="text-danger">{{$message}}</div>
            @enderror
            <div class="input-group has-validation">
                <input name="price" id="price" type="text" class="form-control" aria-describedby="emailHelp"
                       placeholder="Введите цену продукта" required value="{{old('name')}}">
            </div>
            <br>
            @error('price')
            <div class="text-danger">{{$message}}</div>
            @enderror
            <div class="form-group">
                <input type="file" name="image" placeholder="Выбрать изображение" id="image">
                @error('image')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <br>
            <div class="input-group has-validation">
                <input name="country" id="country" type="text" class="form-control" aria-describedby="emailHelp"
                       placeholder="Введите страну производителя" required value="{{old('country')}}">
            </div>
            <br>
            @error('country')
            <div class="text-danger">{{$message}}</div>
            @enderror

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Категории
                </button>
                <ul class="dropdown-menu">
                    @foreach($category as $categorys)
                        <li><input type="radio" class="dropdown-item" name="category_id" id="category_id" value="{{$categorys->id}}">{{$categorys->category}}</li>
                    @endforeach
                </ul>
            </div>

            <div class="input-group has-validation">
                <input name="color" id="color" type="text" class="form-control" aria-describedby="emailHelp"
                       placeholder="Введите цвет" required value="{{old('color')}}">
            </div>
            <br>
            @error('color')
            <div class="text-danger">{{$message}}</div>
            @enderror
            <div class="input-group has-validation">
                <input name="count" id="count" type="text" class="form-control" aria-describedby="emailHelp"
                       placeholder="Введите количество товара" required value="{{old('count')}}">
            </div>
            <br>
            @error('count')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="text-center">
            <button type="submit" class="me-3 py-2 text-dark text-decoration-none btn btn-primary w-50">Добавить
            </button>
        </div>
    </form>

    <a class="d-flex align-items-center text-dark text-decoration-none">
        <span class="fs-1">Редактирование</span>
    </a>

    <div class="row row-cols-1 row-cols-md-2 g-5">
        <div class="col shadow-none rounded-2">

            <a class="d-flex align-items-center text-dark text-decoration-none">
                <span class="fs-1">Категории</span>
            </a>
            <div class="card border-0">

                    <ol class="list-group list-group-numbered p-4">
                        @php $i=1000; @endphp
                        @foreach($category as $categorys)
                            @php $i++; @endphp
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Категория: {{$categorys->category}}</div>
                                <div class="fw-bold">id: {{$categorys->id}}</div>
                            </div>

                            <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{$i}}"
                                    data-bs-whatever="@mdo">Редактировать
                            </button>



                        <div class="modal fade" id="exampleModal{{$i}}" tabindex="-1"
                             aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="row g-3 needs-validation p-3 mb-5 bg-body"
                                              action="{{route('update_category', $categorys->id)}}"
                                              method="POST" enctype="multipart/form-data" id="upload-image">
                                            @csrf
                                            <div class="col-md-12">
                                                <label for="validationCustom07"
                                                       class="form-label text-dark">Продукт</label>
                                                <div class="input-group has-validation">
                                                    <input name="category" id="category" type="text"
                                                           class="form-control"
                                                           aria-describedby="emailHelp"
                                                           placeholder="Введите название продукта" required
                                                           value="{{$categorys->category}}">
                                                </div>
                                                <br>
                                                @error('category')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <div class="text-center">
                                                <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                    Закрыть
                                                </button>
                                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </li>
                        @endforeach
                    </ol>

                </div>

        </div>

        <div class="col shadow-none rounded-2">
            <a class="d-flex align-items-center text-dark text-decoration-none">
                <span class="fs-1">Продукты</span>
            </a>
            @php $i=2000; @endphp
            @foreach($product as $products)
                @php $i++; @endphp
                <div class="card border-0">
                    <ol class="list-group list-group-numbered p-4">

                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">

                                <img src="{{ asset('/storage/'.$products->image) }}"
                                     alt="Изображение не загрузилось"
                                     width="100" height="100">
                                <div class="fw-bold">Name: {{$products->name}}</div>
                                <div class="fw-bold">id: {{$products->id}}</div>
                            </div>

                            <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{$i}}"
                                    data-bs-whatever="@mdo">Редактировать
                            </button>
                            <a class="me-3 py-2 text-dark text-decoration-none"
                               href="{{route('delete_product',$products->id)}}">&#128465;</a>
                            <div class="modal fade" id="exampleModal{{$i}}" tabindex="-1"
                                 aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3 needs-validation p-3 mb-5 bg-body"
                                                  action="{{route('update_product', $products->id)}}"
                                                  method="POST" enctype="multipart/form-data" id="upload-image">
                                                @csrf
                                                <div class="col-md-12">
                                                    <label for="validationCustom07"
                                                           class="form-label text-dark">Продукт</label>
                                                    <div class="input-group has-validation">
                                                        <input name="name" id="name" type="text"
                                                               class="form-control"
                                                               aria-describedby="emailHelp"
                                                               placeholder="Введите название продукта" required
                                                               value="{{$products->name}}">
                                                    </div>
                                                    <br>
                                                    @error('name')
                                                    <div class="text-danger">{{$message}}</div>
                                                    @enderror
                                                    <div class="input-group has-validation">
                                                        <input name="price" id="price" type="text"
                                                               class="form-control"
                                                               aria-describedby="emailHelp"
                                                               placeholder="Введите цену продукта" required
                                                               value="{{$products->price}}">
                                                    </div>
                                                    <br>
                                                    @error('price')
                                                    <div class="text-danger">{{$message}}</div>
                                                    @enderror
                                                    <div class="form-group">
                                                        <img src="{{ asset('/storage/'.$products->image) }}"
                                                             alt="Изображение не загрузилось"
                                                             width="100" height="100">
                                                        <input type="file" name="image"
                                                               placeholder="Выбрать изображение"
                                                               id="image">
                                                        @error('image')
                                                        <div
                                                            class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <br>
                                                    <div class="input-group has-validation">
                                                        <input name="country" id="country" type="text"
                                                               class="form-control"
                                                               aria-describedby="emailHelp"
                                                               placeholder="Введите страну производителя" required
                                                               value="{{$products->country}}">
                                                    </div>
                                                    <br>
                                                    @error('country')
                                                    <div class="text-danger">{{$message}}</div>
                                                    @enderror
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Категории
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            @foreach($category as $categorys)
                                                                <li><input type="radio" class="dropdown-item" name="category_id" id="category_id" value="{{$categorys->id}}">{{$categorys->category}}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <br>
                                                    @error('category_id')
                                                    <div class="text-danger">{{$message}}</div>
                                                    @enderror
                                                    <div class="input-group has-validation">
                                                        <input name="color" id="color" type="text"
                                                               class="form-control"
                                                               aria-describedby="emailHelp"
                                                               placeholder="Введите цвет" required
                                                               value="{{$products->color}}">
                                                    </div>
                                                    <br>
                                                    @error('color')
                                                    <div class="text-danger">{{$message}}</div>
                                                    @enderror
                                                    <div class="input-group has-validation">
                                                        <input name="count" id="count" type="text"
                                                               class="form-control"
                                                               aria-describedby="emailHelp"
                                                               placeholder="Введите количество товара" required
                                                               value="{{$products->count}}">
                                                    </div>
                                                    <br>
                                                    @error('count')
                                                    <div class="text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>


                                                <div class="text-center">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                        Закрыть
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>


                    </ol>
                </div>
            @endforeach
        </div>
        <div class="col shadow-none rounded-2">
            <a class="d-flex align-items-center text-dark text-decoration-none">
                <span class="fs-1">Заказы</span>
            </a>
            @php $i=3000; @endphp
            @foreach($order as $orders)
                @php $i++; @endphp
                <div class="card border-0">
                    <ol class="list-group list-group-numbered p-4">

                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">

                                <div class="fw-bold">id: {{$orders->id}}</div>
                                <div class="fw-bold">User_id: {{$orders->user_id}}</div>
                                <div class="fw-bold">Product_id: {{$orders->status}}</div>
                                <div class="fw-bold">Product_id: {{$orders->resons}}</div>
                            </div>

                            <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="{{'#exampleModal'.$i}}"
                                    data-bs-whatever="@mdo">Редактировать
                            </button>


                        </li>
                        <div class="modal fade" id="{{'exampleModal'.$i}}" tabindex="-1"
                             aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="row g-3 needs-validation p-3 mb-5 bg-body"
                                              action="{{route('update_order', $orders->id)}}"
                                              method="POST" enctype="multipart/form-data" id="upload-image">
                                            @csrf
                                            <div class="col-md-12">
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Категории
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><input type="radio" class="dropdown-item" name="status" id="status" value="Новый">Новый</li>
                                                        <li><input type="radio" class="dropdown-item" name="status" id="status" value="Подтвержден">Подтвержден</li>
                                                        <li><input type="radio" class="dropdown-item" name="status" id="status" value="Отменен">Отменен</li>
                                                    </ul>
                                                </div>
                                                <br>
                                                @error('status')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror

                                                <div class="input-group has-validation">
                                                    <input name="resons" id="resons" type="text"
                                                           class="form-control"
                                                           aria-describedby="emailHelp"
                                                           placeholder="Введите причину"
                                                           value="{{$orders->resons}}">
                                                </div>
                                                <br>
                                                @error('resons')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror


                                            </div>


                                            <div class="text-center">
                                                <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                    Закрыть
                                                </button>
                                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </ol>
                </div>
            @endforeach
        </div>
    </div>
</div>

</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

</body>
</html>

