<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container py-3">
    <header>
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                <span class="fs-4">Большие карманы</span>
            </a>

            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <a class="me-3 py-2 text-dark text-decoration-none" href="/">Главная</a>
                <a class="me-3 py-2 text-dark text-decoration-none" href="/about">Про нас</a>
            </nav>
            <a class="btn btn-outline-warning" href="/review">Отзывы</a>
        </div>
    </header>

    <div class="conteiner">
        <?php echo $__env->yieldContent('main_content'); ?>
    </div>

</div>
</body>
</html>
<?php /**PATH C:\Users\maksi\PhpstormProjects\Gos_Podgotovka\resources\views/layout.blade.php ENDPATH**/ ?>