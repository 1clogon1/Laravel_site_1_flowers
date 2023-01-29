<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?php echo e(asset('bootstrap-5.0.2/dist/css/bootstrap.min.css')); ?>" rel="stylesheet"/>

    <title>Где нас найти</title>
</head>
<body>

<div class="container py-3">
    <header>
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            <a href="<?php echo e(route('welcome')); ?>" class="d-flex align-items-center text-dark text-decoration-none">
                <img class="d-block" src="<?php echo e(asset('/storage/app/public/uploads/logo2.png')); ?>" alt="slide" height="150px">
            </a>

            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('product')); ?>">Товары</a>

            <?php if(auth()->guard()->guest()): ?>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('login')); ?>">Login</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('register')); ?>">Register</a>
                <?php endif; ?>

                <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->isAdmin()): ?>
                        <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('admin')); ?>">admin panel</a>
                    <?php endif; ?>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('cart')); ?>">Корзина</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('order')); ?>">Заказы</a>
                <?php endif; ?>


                <?php if(auth()->guard()->check()): ?>
                    <!--Специальная деректива выводящая в ней данные только для зарегистрированных пользователей-->
                        <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('logout')); ?>">Log Out</a>

                    <?php endif; ?>
            </nav>
        </div>
    </header>
</div>

<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h1>Где нас найти?</h1>
</div>
<div class="container py-3">
    <div class="row row-cols-1 row-cols-md-1 g-4">
            <div class="col">
                <div class="card">
                    <img class="rounded-2" src="<?php echo e(asset('/storage/app/public/uploads/maps2.png')); ?>"
                         alt="Изображение не загрузилось">
                    <div class="card-body text-center">
                        <h5 class="card-title">Адрес: ул. Савушкина, 124, корп. 1</h5>
                        <h5 class="card-text">Номер: +7 (812) 777-92-04</h5>
                        <h5 class="card-text">Почта: FloralDesign@gmail.com</h5>
                    </div>
                </div>
            </div>
    </div>
</div>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>

<?php /**PATH /home/Maksim/web/trifonov-m4.сделай.site/public_html/resources/views/info.blade.php ENDPATH**/ ?>