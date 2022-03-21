
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
                    
                    <iframe class="video" width="730" height="400" src="https://www.youtube.com/embed/<?php echo e(isset($course_video) ? $course_video->id_video : $course->video_id); ?>?modestbranding=1&showinfo=0&controls=0&autohide=1&rel=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                    
                    
                    
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
                        <p><span style="font-size: 14px; color: #EF8D21;"> 
                            <?php echo e(round((double) $count_avg->avg_rating, 1)); ?> 
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <?php if($i <= (int) $count_avg->avg_rating ): ?>
                                    <i class="fas fa-star"></i>
                                <?php elseif(ceil($count_avg->avg_rating) > $count_avg->avg_rating && $i == (int) $count_avg->avg_rating + 1): ?>
                                    <i class="fas fa-star-half-alt"></i>
                                <?php else: ?>
                                <i class="far fa-star"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                           </span>&ensp;<span style="font-size: 14px; color: white;">(<?php echo e($course_comment_count->count); ?> Đánh giá) - <?php echo e($sum_user_of_course->count); ?> Học viên</span></p>
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
              <?php if(isset($course_video)): ?>
                <p style="font-size: 13px; color: white;"><?php echo e($course_video->description); ?></p>
              <?php else: ?>
                <p style="font-size: 13px; color: white;"><?php echo e($course->description); ?></p>
              <?php endif; ?>
                <p id="title" style="padding-top: 30px;">Rate and comment</p>
                <div class="commet">
                    <div class="imt">
                        <?php $__currentLoopData = $course_comment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="com">
                                    <div class="date">
                                        <div id="google">
                                           <img class="img-fluid" src="<?php echo e($cmt->photo); ?>" alt="">
                                        </div>
                                        <p id="date"><span><?php echo e($cmt->fullname); ?></span> </p>
                                    </div>
                                    <div class="str">
                                        <p style="color: #EF8D21; padding-left: 7%;">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <?php if($i <= $cmt->rating): ?>
                                                <i class="fas fa-star"></i>
                                            <?php else: ?>
                                            <i class="far fa-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        </p>
                                        <p id="commet" style="color: white;"><?php echo e($cmt->comment); ?></p>
                                    </div>
                                </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            </div>
        </div>
        <form action="/course/<?php echo e(Str::slug($course->name.'-'.$course_id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-floating">
                <label for="courseComment" class="form-label" style="color: white; font-size: 2em;">Comment and rating</label>
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="courseComment"></textarea>
                <label for="floatingTextarea2">Comments</label>
              </div>
              <select class="form-select" aria-label="Default select example" name="ratingCourse">
                <option value="0" selected>
                    Rating
                </option>
                <option value="1">
                    1 sao
                </option>
                <option value="2">
                    2 sao
                </option>
                <option value="3">
                    3 sao
                </option>     
                <option value="4">
                    4 sao
                </option>
                <option value="5">
                    5 sao
                </option>
              </select>
              <?php if($errors->any()): ?>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div style="color: red"><?php echo e($error); ?></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             <?php endif; ?>
                <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        
    </div>
</div>

 <?php $__env->stopSection(); ?>

<?php echo $__env->make('Sites::courseIntroduction', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\branch-TraderClass\TraderClass\app\Modules/Sites/Views/course_detail/index.blade.php ENDPATH**/ ?>