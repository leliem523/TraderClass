
<?php $__env->startSection('title', $row->title); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('Sites::inc.maketting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="main">
    <div class="container">
        <p id="title">
            Detailed course
        </p>
        <!-- <p style="color: white;">View offers and select courses of interest.</p> -->
        <?php if(isset($course->video_id)): ?>
        <div class="row" id="row">
            <div class="col-md-8">
                
                <div class="youtube wrappe" onclick="playvideo()">
                    
                    <iframe class="video" width="730" height="400" src="https://www.youtube.com/embed/<?php echo e(isset($course_video) ? $course_video->id_video : $course->video_id); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    
                    
                </div>
            </div>
            <div class="col-md-4">
                <div class="all">
                    <a href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                        All field  &ensp; <i class="bi bi-chevron-down"></i>
                      </a>
                    <div class="dropdown-menu" id="dropdown-menu2" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">
                            <p>Action</p>
                        </a>
                        <a class="dropdown-item" href="#">
                            <p>Another action</p>
                        </a>
                        <!-- <div class="dropdown-divider"></div> -->
                        <a class="dropdown-item" href="#">
                            <p>Something else here</p>
                        </a>
                    </div>
                </div>
                <div class="im">
                    <?php $__currentLoopData = $list_video; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="video_fields">
                      <a href="/course/<?php echo e(Str::slug($course->name.'-'.$course->id)); ?>/<?php echo e(Str::slug($value->name.'-'.        $value->id)); ?>">
                        <p><?php echo e($value->name); ?></p>
                      </a>
                    </div> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <?php else: ?>
           <div class="row">
               <div class="col-md-8">
                <h1 class="" style="color: white; padding: 5em 0; text-align: center">
                    No video to show
                </h1>
               </div>
           </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-9">
                        <p id="title"><?php echo e(isset($course->name) ? $course->name : ''); ?></p>
                        <p style="font-size: 20px; color: white; font-weight: 100;"><?php echo e(isset($course->fullname) ? $course->fullname : ''); ?></p>
                        <p><span style="font-size: 14px; color: #EF8D21;"> 4.5 <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></span>&ensp;<span style="font-size: 14px; color: white;">(940 Đánh giá) - 0 Học viên</span></p>
                    </div>
                    
                    <script>
                                var vids = [
                                    "/public/sites/mp4/Teacher1.mp4",
                                    "/public/sites/mp4/Teacher2.mp4",
                                    "/public/sites/mp4/TraderClass Online Classes.mp4",
                                    "/public/sites/mp4/Teacher1.mp4",
                                    "/public/sites/mp4/Teacher2.mp4",
                                    "/public/sites/mp4/TraderClass Online Classes.mp4",
                                    "/public/sites/mp4/Teacher1.mp4",
                                    "/public/sites/mp4/Teacher2.mp4",
                                    "/public/sites/mp4/TraderClass Online Classes.mp4",
                                    "/public/sites/mp4/Teacher1.mp4"
                                ];
                                var o = 0;

                                function nextv() {
                                    console.log('aaa')
                                    // console.log(first)
                                    // if (o >= vids.length) {
                                    //     alert('too far!');
                                    //     return;
                                    // }
                                    // o++;
                                    // document.getElementById("video").src = vids[o];
                                    // console.log(o)
                                };

                                function nvideo(name) {
                                    var videoFile = name;
                                    $('.wrappe video source').attr('src', videoFile);
                                    $(".wrappe video")[0].load();
                                }
                    </script>

                </div>
                <p style="font-size: 13px; color: white;">From litigator to ultramarathoner to bestselling author to head instructor and VP at Peloton, Robin Arzón keeps proving it’s never too late to level up in your life. Now, she’s ready to teach you how building your mental strength can
                    help you see what’s possible for yourself—and see it through. Learn how to identify your dreams and apply the principles of endurance, power, and strength to help you reach your goals.
                </p>
                <p id="title" style="padding-top: 30px;">Rate and comment</p>
                <div class="commet">
                    <div class="imt">
                        <div class="com">
                            <div class="date">
                                <div id="google">
                                    <p>M</p>
                                </div>
                                <p id="date"><span>Jarratt Davis</span> </p>
                            </div>
                            <div class="str">
                                <p style="color: #EF8D21; padding-left: 7%;"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></p>
                                <p id="commet" style="color: white;">Thank you for sharing your knowledge and experience</p>
                            </div>
                        </div>
                        <div class="com">
                            <div class="date">
                                <div id="google">
                                    <p>M</p>
                                </div>
                                <p id="date"><span>Jarratt Davis</span> </p>
                            </div>
                            <div class="str">
                                <p style="color: #EF8D21; padding-left: 7%;"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></p>
                                <p id="commet" style="color: white;">Thank you for sharing your knowledge and experience</p>
                            </div>
                        </div>
                        <div class="com">
                            <div class="date">
                                <div id="google">
                                    <p>M</p>
                                </div>
                                <p id="date"><span>Jarratt Davis</span> </p>
                            </div>
                            <div class="str">
                                <p style="color: #EF8D21; padding-left: 7%;"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></p>
                                <p id="commet" style="color: white;">Thank you for sharing your knowledge and experience</p>
                            </div>
                        </div>
                        <div class="com">
                            <div class="date">
                                <div id="google">
                                    <p>M</p>
                                </div>
                                <p id="date"><span>Jarratt Davis</span> </p>
                            </div>
                            <div class="str">
                                <p style="color: #EF8D21; padding-left: 7%;"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></p>
                                <p id="commet" style="color: white;">Thank you for sharing your knowledge and experience</p>
                            </div>
                        </div>
                        <div class="com">
                            <div class="date">
                                <div id="google">
                                    <p>M</p>
                                </div>
                                <p id="date"><span>Jarratt Davis</span> </p>
                            </div>
                            <div class="str">
                                <p style="color: #EF8D21; padding-left: 7%;"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></p>
                                <p id="commet" style="color: white;">Thank you for sharing your knowledge and experience</p>
                            </div>
                        </div>
                        <div class="com">
                            <div class="date">
                                <div id="google">
                                    <p>M</p>
                                </div>
                                <p id="date"><span>Jarratt Davis</span> </p>
                            </div>
                            <div class="str">
                                <p style="color: #EF8D21; padding-left: 7%;"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></p>
                                <p id="commet" style="color: white;">Thank you for sharing your knowledge and experience</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 <?php $__env->stopSection(); ?>

<?php echo $__env->make('Sites::courseIntroduction', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\branch TraderClass\TraderClass\app\Modules/Sites/Views/course_detail/index.blade.php ENDPATH**/ ?>