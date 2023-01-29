<?php $__env->startSection('title'); ?>
   Отзывы
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main_content'); ?>
    <h1>Форма добавения отзывов</h1>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <!--Перебор по всем ошибкам и их вывод в виде списка-->
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="/review/check">
        <input type="email" name="email" id="email" placeholder="Введите email" class="form-control"><br>
        <input type="text" name="subject" id="subject" placeholder="Введите отзыв" class="form-control"><br>
        <textarea name="message" id="message" placeholder="Введите сообщение" class="form-control"></textarea><br>
        <button type="submit" class="btn btn-success">Отправить</button>
    </form>

    <br><br><br>

    <h1>Все отзовы</h1>
    <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $el): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="alert alert-warning">
            <h3><?php echo e($el->subject); ?></h3>
            <b><?php echo e($el->email); ?></b>
            <b><?php echo e($el->message); ?></b>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/Maksim/web/trifonov-m4.сделай.site/public_html/resources/views/review.blade.php ENDPATH**/ ?>