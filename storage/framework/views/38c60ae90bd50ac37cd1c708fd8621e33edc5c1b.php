<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    <title>Регистрация</title>
</head>
<body>

<div class="container py-2">
    <header>
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            <a href="<?php echo e(route('welcome')); ?>" class="d-flex align-items-center text-dark text-decoration-none">
                <img class="d-block" src="<?php echo e(asset('/storage/app/public/uploads/logo2.png')); ?>" alt="slide" height="150px">
            </a>

            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('info')); ?>">Где нас найти?</a>

                <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('login')); ?>">Log In</a>
            </nav>
        </div>
    </header>


    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Регистрация</h1>
    </div>



    <form class="row g-3 needs-validation shadow-lg p-3 mb-5 bg-body rounded" action="<?php echo e(route('register')); ?>"
          method="POST">
        <?php echo csrf_field(); ?>
        <div class="col-md-10">
            <label for="validationCustom07" class="form-label text-dark">Имя</label>
            <input name="name" id="name" type="name" class="form-control" aria-describedby="namelHelp"
                   placeholder="Введите имя" value="<?php echo e(old('name')); ?>" required autofocus><br>
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="col-md-10">
            <label for="validationCustom07" class="form-label text-dark">Фамилия</label>
            <input name="surname" id="surname" type="surname" class="form-control" aria-describedby="surnamelHelp"
                   placeholder="Введите фамилию" value="<?php echo e(old('surname')); ?>" required autofocus><br>
            <?php $__errorArgs = ['surname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="col-md-10">
            <label for="validationCustom07" class="form-label text-dark">Отчество</label>
            <input name="patronymic" id="patronymic" type="patronymic" class="form-control"
                   aria-describedby="patronymiclHelp" placeholder="Введите отчество" value="<?php echo e(old('patronymic')); ?>"
                   required autofocus><br>
            <?php $__errorArgs = ['patronymic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="col-md-10">
            <label for="validationCustom07" class="form-label text-dark">login</label>
            <input name="login" id="login" type="login" class="form-control" aria-describedby="loginlHelp"
                   placeholder="Введите login" value="<?php echo e(old('login')); ?>" required autofocus><br>
            <?php $__errorArgs = ['login'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="col-md-10">
            <label for="validationCustom07" class="form-label text-dark">Email</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input name="email" id="email" type="email" class="form-control" aria-describedby="emailHelp"
                       placeholder="Введите  email" <?php echo e(old('email')); ?> required>
            </div>
            <br>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="col-md-10">
            <label for="validationCustom07" class="form-label text-dark">Пароль</label>
            <input name="password" id="password" type="password" class="form-control" placeholder="Введите пароль"
                   required><br>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="col-md-10">
            <label for="validationCustom07" class="form-label text-dark">Повторите пароль</label>
            <input name="password_confirmation" id="password_confirmation" type="password" class="form-control"
                   placeholder="Повторите пароль" required><br>
            <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-check">
            <input type="checkbox" class="checkbox" id="checkbox" required>
            <label class="form-check-label" for="exampleCheck1">Даю согласие на обработку своих данных</label><br>
            <?php $__errorArgs = ['checkbox'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="text-center">
            <button type="submit" class="me-3 py-2 text-dark text-decoration-none btn btn-primary w-50">
                Зарегистрироваться
            </button>
        </div><br>
        <div class="text-center">
            <a class="me-3 py-2 text-dark text-decoration-none text-green" href="<?php echo e(route('login')); ?>">Login</a>
        </div><br>
    </form>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>

<?php /**PATH /home/Maksim/web/trifonov-m1.сделай.site/public_html/resources/views/register.blade.php ENDPATH**/ ?>