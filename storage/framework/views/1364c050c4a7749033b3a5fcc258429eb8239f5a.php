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
                <img class="d-block" src="<?php echo e(asset('/storage/app/public/uploads/logo2.png')); ?>" alt="slide"
                     height="150px"> </a>

            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('info')); ?>">Где нас найти?</a>

                <?php if(auth()->guard()->guest()): ?>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('login')); ?>">Login</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('register')); ?>">Register</a>
                <?php endif; ?>

                <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->isAdmin()): ?>
                        <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('admin')); ?>">admin panel</a>
                    <?php endif; ?>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('product')); ?>">Товары</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('cart')); ?>">Корзина</a>
                <?php endif; ?>


                <?php if(auth()->guard()->check()): ?>
                <!--Специальная деректива выводящая в ней данные только для зарегистрированных пользователей-->
                    <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('logout')); ?>">Log Out</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>


    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Заказы</h1>
    </div>
    <?php if(isset($Ok_zakaz)): ?>
        <div class="alert alert-success" role="alert">
            <?php echo e($Ok_zakaz); ?>

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
            <th scope="col">Статус</th>
            <th scope="col">Описание</th>
            <th scope="col">Количество</th>
            <th scope="col">Функции</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1; ?>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
            <td><?php echo e($i++); ?></td>
            <td><img src="<?php echo e(asset('/storage/'.$order->image)); ?>" alt="Изображение не загрузилось" height="100"
                     width="100"></td>
            <td><?php echo e($order->name); ?></td>
            <td><?php echo e($order->price); ?></td>
            <td><?php echo e($order->status); ?></td>
            <td><?php echo e($order->resons); ?></td>
            <td><?php echo e($order->sum); ?></td>
            <td>

                <form method="get" action="<?php echo e(route('delete_order',$order->order_id)); ?>">
                    <?php echo csrf_field(); ?>
                    <a class="me-3 py-2 text-dark text-decoration-none"
                       href="<?php echo e(route('delete_order',$order->order_id)); ?>">&#128465;</a>
                </form>

            </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>


</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

</body>
</html>

<?php /**PATH /home/Maksim/web/trifonov-m4.сделай.site/public_html/resources/views/order.blade.php ENDPATH**/ ?>