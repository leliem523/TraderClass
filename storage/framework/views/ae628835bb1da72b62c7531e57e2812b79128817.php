<?php
    use Illuminate\Support\Facades\DB;

$categories = DB::table('course_category')
               ->where('course_category.status', 1)
               ->get();

               
$teachers = DB::table('teachers')
            ->select('teachers.id', 'course.name', 'teachers.fullname')
            ->join('course', 'teachers.id', 'course.teacher_id')
            ->where('course.status', 1)
            ->get();
?> 


<?php if(Auth::check()): ?>
<div class="header">
    <div class="header_bottom">
        <div class="container">
            <div class="mai">
                <div class="logo">
                    <a href="/" title="">
                        TraderClass
                    </a>
                </div>
                <div class="menu header-menu">
                    <ul>
                        <li class="drop-header">
                        <a style="padding-top: 0px; color:white;" class="nav-link header-dropdown"
                                href="#"><i
                                class="fas fa-chalkboard-teacher"></i>&nbsp; All Categories 
                            </a>
                            <div class="parent-drop">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div><a class="#" href="/all-class/<?php echo e(Str::Slug($cate->title.'-'.$cate->id)); ?>"><?php echo e($cate->title); ?></a></a></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </li>
                        <li>
                            <a style="padding-top: 0px;" class="nav-link" href="/all-teacher"><i
                                    class="fas fa-chalkboard-teacher"></i>&nbsp; All Teacher</a>
                        </li>
                        <li>
                            <a style="padding-top: 0px;" class="nav-link" href="/all-class"><i
                                    class="fas fa-users-class"></i>&nbsp; All Class</a>
                        </li>
                    </ul>
                </div>
                <div class="fsearch">

                    <input list="brows" type="text" name="search" placeholder="Search.." id="fsearchh">
                    <datalist id="brows">
                        <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($teacher->name); ?>"><?php echo e($teacher->fullname); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </datalist>
                    <button class="btn-search">
                        <i class="bi bi-search"></i>
                    </button>
                    <div id="countryList"></div>
                </div>
                
                <div class="right_nav">
                    <a class="nav-link" style="padding-top: 0px;" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown">
                        <img src="/public/sites/svg/avt.svg" alt="">
                    </a>
                    <div class="dropdown-menu" id="dropdown-menu1" aria-labelledby="navbarDropdown">
                        <a style="color: black;" class="dropdown-item" href="/account">Account information</a>
                        <a style="color: black;" class="dropdown-item" href="/my-course">My Course</a>
                        <a style="color: black;" class="dropdown-item" href="<?php echo e(route('sites.account.logout')); ?>">Log
                            out</a>
                    </div>
                    <!-- <div class="dropdown">
                        <a style="padding-top: 0px;" class="dropbtn" href="#"><img src="./svg/avt.svg" alt=""></a>
                        <div class="dropdown-content">
                            <a href="./account.html">Account information</a>
                            <a href="#">Log out</a>
                        </div>
                    </div> -->
                </div>
                <a class="toggle" id="btn-toggle-sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path fill="currentColor"
                            d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

</div>

<?php else: ?>
<header>
    <div class="header_bottom">
        <div class="container">
            <div class="main">
                <div class="logo">
                    <a href="/" title="">
                        TraderClass
                    </a>
                </div>
                <div class="menu header-menu">
                    <ul>
                        <li class="drop-header">
                            <a style="padding-top: 0px; color:white;" class="nav-link header-dropdown"
                                href="#">&nbsp; All Categories <i
                                class="fas fa-chalkboard-teacher"></i>
                            </a>
                            <div class="parent-drop">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div><a class="#" href="/all-class/<?php echo e(Str::Slug($cate->title.'-'.$cate->id)); ?>"><?php echo e($cate->title); ?></a></a></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </li>
                        <li>
                            <a style="padding-top: 0px;" class="nav-link" href="/all-teacher"><i
                                    class="fas fa-chalkboard-teacher"></i>&nbsp; All Teacher</a>
                        </li>
                        <li>
                            <a style="padding-top: 0px;" class="nav-link" href="/all-class"><i
                                    class="fas fa-users-class"></i>&nbsp;
                                All Class</a>
                        </li>
                    </ul>
                </div>
                <div class="fsearch">
                    <input list="brows" type="text" name="search" placeholder="Search.." id="fsearchh">
                    <datalist id="brows">
                        <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($teacher->name.' '.$teacher->id); ?>"><?php echo e($teacher->fullname); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </datalist>
                    <button class="btn-search">
                        <i class="bi bi-search"></i>
                        </button>
                </div>
                <div class="right_nav">
                    <ul>
                        <li>
                            <a href="#" title="log in" onclick="sign_in()" class="text-uppercase">log in</a>
                        </li>
                        <li>
                            <a href="#" title="log in" onclick="toggle()" class="text-uppercase">sign up</a>
                        </li>
                    </ul>
                </div>
                <a class="toggle" id="btn-toggle-sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path fill="currentColor"
                            d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

</header>

<?php endif; ?>

<script>

const inputSearch = document.querySelector('#fsearchh');
const btnSearch = document.querySelector('.btn-search');

btnSearch.addEventListener('click', () => {
    if(inputSearch.value) {
        window.location = '/all-class/' + ChangeToSlug(inputSearch.value);
    }
});

function ChangeToSlug(title)
{

    //Đổi chữ hoa thành chữ thường
    var slug = title.toLowerCase();
 
    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, " - ");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox có id “slug”
    return slug;
}

// search
function ChangeToSlug(title)
{
    //Đổi chữ hoa thành chữ thường
    var slug = title.toLowerCase();
 
    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox có id “slug”
    return slug;
}


// $(document).ready(function() {

//     $('#fsearchh').keyup(function() {
//         var query = $(this).val();
//         console.log("ngon");
//         if (query != '') {
//             var _token = $('meta[name="csrf-token"]').attr('content');
//             $.ajax({
//                 url: "<?php echo e(route('sites.search')); ?>",
//                 method: "POST",
//                 data: {
//                     query: query,
//                     _token: _token
//                 },
//                 success: function(data) {
//                     $('#brows').fadeIn();
//                     $('#brows').html(data);
//                 }
//             });
//         }
//     });

//     $(document).on('click', 'option', function() {
//         $('#fsearchh').val($(this).text());
//         $('#brows').fadeOut();
//     });
// });
</script><?php /**PATH E:\branch-TraderClass\TraderClass\app\Modules/Sites/Views/inc/header.blade.php ENDPATH**/ ?>