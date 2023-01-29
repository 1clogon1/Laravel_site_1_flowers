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
            <a href="<?php echo e(route('welcome')); ?>" class="d-flex align-items-center text-dark text-decoration-none">
                <img class="d-block" src="<?php echo e(asset('/storage/app/public/uploads/logo2.png')); ?>" alt="slide" height="150px">
            </a>

            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('cart')); ?>">Корзина</a>
                <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('product')); ?>">Товары</a>
                <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('info')); ?>">Где нас найти?</a>
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

    <div>
        <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">


        </nav>
    </div>
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <h1 class="display-4 fw-normal"><?php echo e($products_name->name); ?></h1>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div class="row row-cols-1 row-cols-md-3 g-4">


    </div>
    <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row g-3 needs-validation shadow-lg p-3 mb-5 bg-body rounded">

            <div class="col-md-5">
                <div class="col">
                    <div class="card">
                        <img src="<?php echo e(asset('/storage/'.$products->image)); ?>"
                             alt="Изображение не загрузилось">
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <label for="validationCustom07" class="form-label text-dark"><h3>Название:</h3>
                    <h4><?php echo e($products->name); ?></h4></label>
                <div class="col-md-10">
                    <label for="validationCustom07" class="form-label text-dark"><h3>Цена:</h3>
                        <h4><?php echo e($products->price); ?> руб</h4></label>

                </div>
                <div class="col-md-10">
                    <label for="validationCustom07"
                           class="form-label text-dark"><h3>Страна-производитель: </h3>
                        <h4><?php echo e($products->country); ?></h4>
                    </label>

                </div>
                <div class="col-md-10">

                    <label for="validationCustom07" class="form-label text-dark"><h3>Вид товара:</h3>

                        <h4><?php echo e($products->category_id); ?></h4>

                    </label>

                </div>
                <div class="col-md-10">
                    <label for="validationCustom07" class="form-label text-dark"><h3>Цвет:</h3>
                        <h4><?php echo e($products->color); ?></h4>
                    </label>
                </div>
            </div>



            <form method="get" action="<?php echo e(route('add_cart',$products->id)); ?>">
                <?php echo csrf_field(); ?>
                <div class="d-grid gap-2 d-md-block">
                    <button type="submit" class="btn btn-outline-dark shadow p-2 bg-gray rounded">В корзину</button>
                </div>
            </form>

        </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>

<?php /**PATH /home/Maksim/web/trifonov-m1.сделай.site/public_html/resources/views/product_id.blade.php ENDPATH**/ ?>