@extends('Sites::allClass')
@section('title', $row->title)
@section('content')
@include('Sites::inc.maketting')
<div class="main">
    <div class="intro">
        <p>Choose a class to start</p>
    </div>
    <div class="classify">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                   @if (!isset($teacher_id))
                   <div class="sort">
                    <p style="color: white;">Sorted by:</p>
                    <button onclick="window.location='?mostPopular'">Most Popular</button>
                    {{-- <button>Just Added</button> --}}
                    <div class="topics">
                        <button id="navbarDropdown" role="button" data-toggle="dropdown"> Topics &nbsp; <i class="bi bi-caret-down-fill"></i></button>
                        <div class="dropdown-menu" id="dropdown-menu1" aria-labelledby="navbarDropdown">
                            @foreach ($topics as $value)
                            <p onclick="window.location='?topic={{ Str::slug($value->title.'-'.$value->id) }}'" class="dropdown-item">{{ $value->title }}</p>
                            @endforeach
                        </div>
                    </div>
                    <div class="nteacher">
                        <button id="navbarDropdown" role="button" data-toggle="dropdown">Teacher &nbsp; <i class="bi bi-caret-down-fill"></i></button>
                        <div class="dropdown-menu" id="dropdown-menu1" aria-labelledby="navbarDropdown">
                            @foreach ($teachers as $value)
                            <p onclick="window.location='?teacher={{ Str::slug($value->fullname.'-'.$value->id) }}'" class="dropdown-item">{{ $value->fullname }}</p>     
                            @endforeach

                        </div>
                    </div>
                </div>
                   @endif
                </div>
                <div class="col-md"></div>
            </div>
        </div>
    </div>
    <div class="teacher">
        <div class="container">
            <div class="row">
                @foreach ($data as $value)
                <div class="col-md-4">
                    <a href="/teacher/{{Str::slug($value->name.'-'.$value->id)}}">
                        <div class="img">
                            <img src="{{$value->photo}}" alt="">
                        </div>
                        <div class="nameclass">
                            <p>{{$value->name}}</p>
                            <p>{{$value->title}}</p>
                            <p>{{$value->fullname}}</p>
                        </div>
                    </a> 
                </div>
                @endforeach
            </div>
            @if (!isset($_GET['mostPopular']))
            {{ $data->onEachSide(1)->links("pagination::bootstrap-4") }}
            @endif
            {{-- <div class="pagination">
                <a class="active" href="#">1</a>
                <a href="#">2</a>
                <p style="color: white; margin-bottom: 0px; padding-top: 10px;">...</p>
                <a href="#">5</a>
                <a href="#">6</a>
            </div> --}}
        </div>
    </div>
</div>
<script>
    function handleClickListener() {
        alert('aaa');
    }
</script>
@endsection