<?php
    use Illuminate\Support\Facades\DB;

$categories = DB::table('course_category')
               ->where('course_category.status', 1)
               ->get();

?> 


@if (Auth::check())
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
                                @foreach ( $categories as $cate )
                                <div><a class="#" href="/all-class/{{Str::Slug($cate->title.'-'.$cate->id)}}">{{ $cate->title }}</a></a></div>
                                @endforeach
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
                <div class="fsearch" style="position: relative">

                    <input type="text" placeholder="Search.." id="fsearchh">
                    <div class="list-group" id="search-result" style="position: absolute; z-index: 100; top: 50px">
                    </div>
                    <button class="btn-search">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
                {{-- <div class="cart">
                        <a href="#"><i class="fas fa-shopping-cart"></i></a>
                    </div> --}}
                <div class="right_nav">
                    <a class="nav-link" style="padding-top: 0px;" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown">
                        <img src="/public/sites/svg/avt.svg" alt="">
                    </a>
                    <div class="dropdown-menu" id="dropdown-menu1" aria-labelledby="navbarDropdown">
                        <a style="color: black;" class="dropdown-item" href="/account">Account information</a>
                        <a style="color: black;" class="dropdown-item" href="/my-course">My Course</a>
                        <a style="color: black;" class="dropdown-item" href="{{ route('sites.account.logout') }}">Log
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

@else
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
                                @foreach ( $categories as $cate )
                                <div><a class="#" href="/all-class/{{Str::Slug($cate->title.'-'.$cate->id)}}">{{ $cate->title }}</a></a></div>
                                @endforeach
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
                <div class="fsearch" style="position: relative">

                    <input type="text" placeholder="Search.." id="fsearchh">
                    <div class="list-group" id="search-result" style="position: absolute; z-index: 100; top: 50px">
                    </div>
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

@endif

<script>


// search
function ChangeToSlug(title)
{
    //?????i ch??? hoa th??nh ch??? th?????ng
    var slug = title.toLowerCase();
 
    //?????i k?? t??? c?? d???u th??nh kh??ng d???u
    slug = slug.replace(/??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'a');
    slug = slug.replace(/??|??|???|???|???|??|???|???|???|???|???/gi, 'e');
    slug = slug.replace(/i|??|??|???|??|???/gi, 'i');
    slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'o');
    slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???/gi, 'u');
    slug = slug.replace(/??|???|???|???|???/gi, 'y');
    slug = slug.replace(/??/gi, 'd');
    //X??a c??c k?? t??? ?????t bi???t
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //?????i kho???ng tr???ng th??nh k?? t??? g???ch ngang
    slug = slug.replace(/ /gi, "-");
    //?????i nhi???u k?? t??? g???ch ngang li??n ti???p th??nh 1 k?? t??? g???ch ngang
    //Ph??ng tr?????ng h???p ng?????i nh???p v??o qu?? nhi???u k?? t??? tr???ng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //X??a c??c k?? t??? g???ch ngang ??? ?????u v?? cu???i
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox c?? id ???slug???
    return slug;
}

const fsearchh = document.querySelector('#fsearchh');
const divResult = document.querySelector('#search-result');

fsearchh.addEventListener('keyup', () => {
    const key = fsearchh.value.trim();
    if(key) {
        const url = `https://traderclass.vn/api/search-course?key=${key}`;
            $.ajax({
            url: url,
            cache: false,
            type: 'get',
            success: ({data}) => {
                divResult.innerHTML = "";
                data.forEach(item => {
                    divResult.innerHTML += `
                    <div class="list-group-item list-group-item-action border-1">
                        <div class="row">
                            <div class="col-3">
                                <img class="img-fluid" src="${item.photo}">
                            </div>
                            <div class="col-9">
                                <a href="/teacher/${ChangeToSlug(item.name + ' ' + item.id)}">${item.name}</a>
                                <p>${item.teacherName}</p>
                            </div>
                        </div>
                    </div>`;
                });
        }
        })
    } else {
        divResult.innerHTML = "";
    }

});
</script>