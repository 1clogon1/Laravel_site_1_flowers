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
            <a href="<?php echo e(route('welcome')); ?>" class="d-flex align-items-center text-dark text-decoration-none">
                <img class="d-block" src="<?php echo e(asset('/storage/app/public/uploads/logo2.png')); ?>" alt="slide" height="150px">            </a>

            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('logout')); ?>">Где нас найти?</a>

            <?php if(auth()->guard()->guest()): ?>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('login')); ?>">Login</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('register')); ?>">Register</a>
                <?php endif; ?>

                <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->isAdmin()): ?>
                        <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('admin')); ?>">admin panel</a>
                    <?php endif; ?>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('product')); ?>">Товары</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('order')); ?>">Заказы</a>
                <?php endif; ?>


                <?php if(auth()->guard()->check()): ?>
                <!--Специальная деректива выводящая в ней данные только для зарегистрированных пользователей-->

                    <?php echo csrf_field(); ?>
                    <!--onclick="event.preventDefault(); this.closest('form').submit() - предотвращение стандартного поведения браузера, то есть в место бучной отправки get запроса по Log out будет форма отправленная по post запросу-->
                        <!--event.preventDefault() - предотвращаем стандартное поведение браузера, this.closest('form') - выбираем из дом дерева ближайшую форму(то есть в ту в которой мы находимся) и отправляем ее с помощью .submit()-->
                        <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('logout')); ?>">Log Out</a>
                <?php endif; ?>

            </nav>
        </div>
    </header>


    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Корзина</h1>
    </div>
    <?php if(isset($OK_zakaz)): ?>
        <div class="alert alert-success" role="alert">
            <?php echo e($OK_zakaz); ?>

        </div>
    <?php endif; ?>
    <?php if(isset($Error_zakaz)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo e($Error_zakaz); ?>

        </div>
    <?php endif; ?>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Номер</th>
            <th scope="col">Фото</th>
            <th scope="col">Название</th>
            <th scope="col">Цена</th>
            <th scope="col">Количество</th>
            <th scope="col">Функции</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1; ?>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
                <td><?php echo e($i++); ?></td>
                <td><img src="<?php echo e(asset('/storage/'.$cart->image)); ?>" alt="Изображение не загрузилось" height="100" width="100"></td>
                <td><?php echo e($cart->name); ?></td>
                <td><?php echo e($cart->price); ?></td>
                <td>
                    <form class="row g-3 needs-validation p-3 mb-5 bg-body"
                          action="<?php echo e(route('add_order', $cart->cart_id)); ?>"
                          method="post" enctype="multipart/form-data" id="upload-image">
                        <?php echo csrf_field(); ?>
                    <input  min="1" name="sum" id="sum" type="number" class="form-control" aria-describedby="emailHelp"
                                         required value="<?php echo e($cart->sum); ?>">

                    <div class="modal fade" id="exampleModal<?php echo e($i); ?>" tabindex="-1"
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

                                        <div class="col-md-12">
                                            <div class="input-group has-validation">
                                                <input name="login" id="login" type="login"
                                                       class="form-control"
                                                       placeholder="Введите login" required
                                                       value="">
                                            </div>
                                            <br>
                                            <div class="input-group has-validation">
                                                <input name="password" id="password" type="password"
                                                       class="form-control"
                                                       placeholder="Введите пароль от аккаунта" required
                                                       value="">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">
                                                Закрыть
                                            </button>
                                            <button type="submit" class="btn btn-primary">Заказать</button>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </td>

                <td>
                    <button class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal<?php echo e($i); ?>"
                            data-bs-whatever="@mdo">Заказать
                    </button>
                    <form method="get" action="<?php echo e(route('delete_cart',$cart->cart_id)); ?>">
                        <?php echo csrf_field(); ?>
                        <a class="me-3 py-2 text-dark text-decoration-none"
                           href="<?php echo e(route('delete_cart',$cart->cart_id)); ?>">&#128465;</a>
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>


</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>

<?php /**PATH /home/Maksim/web/trifonov-m4.сделай.site/public_html/resources/views/cart.blade.php ENDPATH**/ ?>