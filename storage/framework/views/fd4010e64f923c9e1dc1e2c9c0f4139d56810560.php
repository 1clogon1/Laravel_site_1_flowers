<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    <title>Главная</title>
</head>
<body>

<div class="container py-3">
    <header>
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            <a href="<?php echo e(route('welcome')); ?>" class="d-flex align-items-center text-dark text-decoration-none">
                <span class="fs-4">Большие карманы</span>
            </a>

            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <?php if(auth()->guard()->guest()): ?><!--Специальная деректива выводящая в ней данные только для не зарегистрированных пользователей-->
                  <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('login')); ?>">Login</a>
                  <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('register')); ?>">Register</a>
                <?php endif; ?>


                <?php if(auth()->guard()->check()): ?><!--Специальная деректива выводящая в ней данные только для зарегистрированных пользователей-->
                    <form method="post" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php if(auth()->guard()->check()): ?>
                            <?php if(Auth::user()->isAdmin()): ?>
                                <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('admin')); ?>">admin panel</a>
                        <?php endif; ?>
                    <?php endif; ?>
                        <!--onclick="event.preventDefault(); this.closest('form').submit() - предотвращение стандартного поведения браузера, то есть в место бучной отправки get запроса по Log out будет форма отправленная по post запросу-->
                        <!--event.preventDefault() - предотвращаем стандартное поведение браузера, this.closest('form') - выбираем из дом дерева ближайшую форму(то есть в ту в которой мы находимся) и отправляем ее с помощью .submit()-->
                        <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('logout')); ?>" onclick="preventDefault(); this.closest('form').submit();">Log Out</a>

                    </form>
                <?php endif; ?>


            </nav>
        </div>
    </header>


    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Главнаяя</h1>
    </div>


</div>

</body>
</html>

<?php /**PATH C:\Users\maksi\PhpstormProjects\Gos_Podgotovka\resources\views/welcome.blade.php ENDPATH**/ ?>