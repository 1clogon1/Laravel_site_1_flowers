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
            <a href="<?php echo e(route('welcome')); ?>" class="d-flex align-items-center text-dark text-decoration-none">
                <img class="d-block" src="<?php echo e(asset('/storage/app/public/uploads/logo2.png')); ?>" alt="slide" height="150px">            </a>

            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <?php if(auth()->guard()->check()): ?>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('logout')); ?>">Где нас найти?</a>

                <?php if(Auth::user()->isAdmin()): ?>
                        <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('welcome')); ?>">Вернутся на
                            сайт</a>
                    <?php endif; ?>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="<?php echo e(route('product')); ?>">Товары</a>
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
    <a class="d-flex align-items-center text-dark text-decoration-none">
        <span class="fs-1">Категория</span>
    </a>
    <form class="row needs-validation shadow-lg p-3 mb-5 bg-body rounded" action="<?php echo e(route('create_category')); ?>"
          method="POST">
        <?php echo csrf_field(); ?>
        <div class="col-md-10">
            <label for="validationCustom07" class="form-label text-dark">Category</label>
            <div class="input-group has-validation">
                <input name="category" id="category" type="text" class="form-control" aria-describedby="emailHelp"
                       placeholder="Введите новую категорию" required value="<?php echo e(old('name')); ?>">
            </div>
            <br>
            <?php $__errorArgs = ['category'];
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
            <button type="submit" class="me-3 py-2 text-dark text-decoration-none btn btn-primary w-50">Авторизоваться
            </button>
        </div>
    </form>

    <a class="d-flex align-items-center text-dark text-decoration-none">
        <span class="fs-1">Продукт</span>
    </a>
    <form class="row g-3 needs-validation shadow-lg p-3 mb-5 bg-body rounded" action="<?php echo e(route('create_product')); ?>"
          method="POST" enctype="multipart/form-data" id="upload-image">
        <?php echo csrf_field(); ?>
        <div class="col-md-10">
            <label for="validationCustom07" class="form-label text-dark">Продукт</label>
            <div class="input-group has-validation">
                <input name="name" id="name" type="text" class="form-control" aria-describedby="emailHelp"
                       placeholder="Введите название продукта" required value="<?php echo e(old('name')); ?>">
            </div>
            <br>
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
            <div class="input-group has-validation">
                <input name="price" id="price" type="text" class="form-control" aria-describedby="emailHelp"
                       placeholder="Введите цену продукта" required value="<?php echo e(old('name')); ?>">
            </div>
            <br>
            <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <div class="form-group">
                <input type="file" name="image" placeholder="Выбрать изображение" id="image">
                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="alert alert-danger mt-1 mb-1"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <br>
            <div class="input-group has-validation">
                <input name="country" id="country" type="text" class="form-control" aria-describedby="emailHelp"
                       placeholder="Введите страну производителя" required value="<?php echo e(old('country')); ?>">
            </div>
            <br>
            <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Категории
                </button>
                <ul class="dropdown-menu">
                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><input type="radio" class="dropdown-item" name="category_id" id="category_id" value="<?php echo e($categorys->id); ?>"><?php echo e($categorys->category); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>

            <div class="input-group has-validation">
                <input name="color" id="color" type="text" class="form-control" aria-describedby="emailHelp"
                       placeholder="Введите цвет" required value="<?php echo e(old('color')); ?>">
            </div>
            <br>
            <?php $__errorArgs = ['color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <div class="input-group has-validation">
                <input name="count" id="count" type="text" class="form-control" aria-describedby="emailHelp"
                       placeholder="Введите количество товара" required value="<?php echo e(old('count')); ?>">
            </div>
            <br>
            <?php $__errorArgs = ['count'];
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
                        <?php $i=1000; ?>
                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $i++; ?>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Категория: <?php echo e($categorys->category); ?></div>
                                <div class="fw-bold">id: <?php echo e($categorys->id); ?></div>
                            </div>

                            <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal<?php echo e($i); ?>"
                                    data-bs-whatever="@mdo">Редактировать
                            </button>



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
                                        <form class="row g-3 needs-validation p-3 mb-5 bg-body"
                                              action="<?php echo e(route('update_category', $categorys->id)); ?>"
                                              method="POST" enctype="multipart/form-data" id="upload-image">
                                            <?php echo csrf_field(); ?>
                                            <div class="col-md-12">
                                                <label for="validationCustom07"
                                                       class="form-label text-dark">Продукт</label>
                                                <div class="input-group has-validation">
                                                    <input name="category" id="category" type="text"
                                                           class="form-control"
                                                           aria-describedby="emailHelp"
                                                           placeholder="Введите название продукта" required
                                                           value="<?php echo e($categorys->category); ?>">
                                                </div>
                                                <br>
                                                <?php $__errorArgs = ['category'];
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
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>

                </div>

        </div>

        <div class="col shadow-none rounded-2">
            <a class="d-flex align-items-center text-dark text-decoration-none">
                <span class="fs-1">Продукты</span>
            </a>
            <?php $i=2000; ?>
            <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $i++; ?>
                <div class="card border-0">
                    <ol class="list-group list-group-numbered p-4">

                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">

                                <img src="<?php echo e(asset('/storage/'.$products->image)); ?>"
                                     alt="Изображение не загрузилось"
                                     width="100" height="100">
                                <div class="fw-bold">Name: <?php echo e($products->name); ?></div>
                                <div class="fw-bold">id: <?php echo e($products->id); ?></div>
                            </div>

                            <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal<?php echo e($i); ?>"
                                    data-bs-whatever="@mdo">Редактировать
                            </button>
                            <a class="me-3 py-2 text-dark text-decoration-none"
                               href="<?php echo e(route('delete_product',$products->id)); ?>">&#128465;</a>
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
                                            <form class="row g-3 needs-validation p-3 mb-5 bg-body"
                                                  action="<?php echo e(route('update_product', $products->id)); ?>"
                                                  method="POST" enctype="multipart/form-data" id="upload-image">
                                                <?php echo csrf_field(); ?>
                                                <div class="col-md-12">
                                                    <label for="validationCustom07"
                                                           class="form-label text-dark">Продукт</label>
                                                    <div class="input-group has-validation">
                                                        <input name="name" id="name" type="text"
                                                               class="form-control"
                                                               aria-describedby="emailHelp"
                                                               placeholder="Введите название продукта" required
                                                               value="<?php echo e($products->name); ?>">
                                                    </div>
                                                    <br>
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
                                                    <div class="input-group has-validation">
                                                        <input name="price" id="price" type="text"
                                                               class="form-control"
                                                               aria-describedby="emailHelp"
                                                               placeholder="Введите цену продукта" required
                                                               value="<?php echo e($products->price); ?>">
                                                    </div>
                                                    <br>
                                                    <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="text-danger"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    <div class="form-group">
                                                        <img src="<?php echo e(asset('/storage/'.$products->image)); ?>"
                                                             alt="Изображение не загрузилось"
                                                             width="100" height="100">
                                                        <input type="file" name="image"
                                                               placeholder="Выбрать изображение"
                                                               id="image">
                                                        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div
                                                            class="alert alert-danger mt-1 mb-1"><?php echo e($message); ?></div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                    <br>
                                                    <div class="input-group has-validation">
                                                        <input name="country" id="country" type="text"
                                                               class="form-control"
                                                               aria-describedby="emailHelp"
                                                               placeholder="Введите страну производителя" required
                                                               value="<?php echo e($products->country); ?>">
                                                    </div>
                                                    <br>
                                                    <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="text-danger"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Категории
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li><input type="radio" class="dropdown-item" name="category_id" id="category_id" value="<?php echo e($categorys->id); ?>"><?php echo e($categorys->category); ?></li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                    </div>
                                                    <br>
                                                    <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="text-danger"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    <div class="input-group has-validation">
                                                        <input name="color" id="color" type="text"
                                                               class="form-control"
                                                               aria-describedby="emailHelp"
                                                               placeholder="Введите цвет" required
                                                               value="<?php echo e($products->color); ?>">
                                                    </div>
                                                    <br>
                                                    <?php $__errorArgs = ['color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="text-danger"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    <div class="input-group has-validation">
                                                        <input name="count" id="count" type="text"
                                                               class="form-control"
                                                               aria-describedby="emailHelp"
                                                               placeholder="Введите количество товара" required
                                                               value="<?php echo e($products->count); ?>">
                                                    </div>
                                                    <br>
                                                    <?php $__errorArgs = ['count'];
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
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="col shadow-none rounded-2">
            <a class="d-flex align-items-center text-dark text-decoration-none">
                <span class="fs-1">Заказы</span>
            </a>
            <?php $i=3000; ?>
            <?php $__currentLoopData = $order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $i++; ?>
                <div class="card border-0">
                    <ol class="list-group list-group-numbered p-4">

                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">

                                <div class="fw-bold">id: <?php echo e($orders->id); ?></div>
                                <div class="fw-bold">User_id: <?php echo e($orders->user_id); ?></div>
                                <div class="fw-bold">Product_id: <?php echo e($orders->status); ?></div>
                                <div class="fw-bold">Product_id: <?php echo e($orders->resons); ?></div>
                            </div>

                            <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="<?php echo e('#exampleModal'.$i); ?>"
                                    data-bs-whatever="@mdo">Редактировать
                            </button>


                        </li>
                        <div class="modal fade" id="<?php echo e('exampleModal'.$i); ?>" tabindex="-1"
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
                                              action="<?php echo e(route('update_order', $orders->id)); ?>"
                                              method="POST" enctype="multipart/form-data" id="upload-image">
                                            <?php echo csrf_field(); ?>
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
                                                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="text-danger"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                                <div class="input-group has-validation">
                                                    <input name="resons" id="resons" type="text"
                                                           class="form-control"
                                                           aria-describedby="emailHelp"
                                                           placeholder="Введите причину"
                                                           value="<?php echo e($orders->resons); ?>">
                                                </div>
                                                <br>
                                                <?php $__errorArgs = ['resons'];
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
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php /**PATH /home/Maksim/web/trifonov-m4.сделай.site/public_html/resources/views/admin.blade.php ENDPATH**/ ?>