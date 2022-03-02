
<?php $__env->startSection('title', $row->title); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('Sites::inc.maketting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="main">
    <div class="intro">
        <p>Choose a class to start</p>
    </div>
    <div class="classify">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="sort">
                        <p style="color: white;">Sorted by:</p>
                        <button onclick="window.location='?mostPopular'">Most Popular</button>
                        
                        <div class="topics">
                            <button id="navbarDropdown" role="button" data-toggle="dropdown"> Topics &nbsp; <i class="bi bi-caret-down-fill"></i></button>
                            <div class="dropdown-menu" id="dropdown-menu1" aria-labelledby="navbarDropdown">
                                <?php $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <p onclick="window.location='?topic=<?php echo e($value->id); ?>'" class="dropdown-item"><?php echo e($value->title); ?></p>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="nteacher">
                            <button id="navbarDropdown" role="button" data-toggle="dropdown">Teacher &nbsp; <i class="bi bi-caret-down-fill"></i></button>
                            <div class="dropdown-menu" id="dropdown-menu1" aria-labelledby="navbarDropdown">
                                <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <p onclick="window.location='?teacher=<?php echo e($value->id); ?>'" class="dropdown-item"><?php echo e($value->fullname); ?></p>     
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md"></div>
            </div>
        </div>
    </div>
    <div class="teacher">
        <div class="container">
            <div class="row">

                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <a href="/teacher/<?php echo e($value->id_teacher); ?>">
                        <div class="img">
                            <img src="/public/upload/images/course/thumb/<?php echo e($value->photo); ?>" alt="">
                        </div>
                        <div class="nameclass">
                            <p><?php echo e($value->name); ?></p>
                            <p><?php echo e($value->title); ?></p>
                            <p><?php echo e($value->fullname); ?></p>
                        </div>
                    </a> 
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php echo e($data->onEachSide(1)->links("pagination::bootstrap-4")); ?>

            
        </div>
    </div>
</div>
<script>
    function handleClickListener() {
        alert('aaa');
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Sites::allClass', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PC\OneDrive\Máy tính\branch TraderClass\TraderClass\app\Modules/Sites/Views/all_class/index.blade.php ENDPATH**/ ?>