
<?php $__env->startSection('title', $row->title); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('Sites::inc.maketting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="main">
    <div class="container">
        <p id="title">My Course</p>
        <div class="row">
            <div class="col-md-3">
                <div class="avta">
                    <div class="avt">
                        <img class="img-fluid" src="<?php echo e($user->photo); ?>" alt="" style="border-radius: 20%">
                    </div>
                    <p><?php echo e(isset($user->fullname) ? $user->fullname : 'No name'); ?></p>
                </div>
                <div class="profile">
                    <p style="    font-weight: 500;">PROFILE</p>
                    <a href="account">
                        <p><i class="bi bi-person-fill"></i>&nbsp; Profile</p>
                    </a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="list">
                    <?php $__currentLoopData = $course; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="items" 
                             onclick="return window.location = 'course/<?php echo e(Str::slug($value->name.'-'.$value->id)); ?>'"
                             style="cursor: pointer">
                            <?php if($value->photo): ?>
                                <img src="<?php echo e($value->photo); ?>" alt="">
                            <?php else: ?>
                                <img src="/public/upload/images/course/thumb/hidden-human.png" alt="">
                            <?php endif; ?>
                                <div class="lname">
                                    <p><?php echo e($value->name); ?></p>
                                    <p id="lname"><?php echo e($value->title); ?></p>
                                </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($course->onEachSide(1)->links('pagination::bootstrap-4')); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Sites::layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\2022\project-cty\new\TraderClass\app\Modules/Sites/Views/my_course/index.blade.php ENDPATH**/ ?>