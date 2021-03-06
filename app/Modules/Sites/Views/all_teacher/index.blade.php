@extends('Sites::allTeacher')
@section('title', $row->title)
@section('content')
@include('Sites::inc.maketting')
<div class="main">
    <div class="intro">
        <p style="font-size: 18px;">Start your first course</p>
        <p style="font-size: 18px;">Choose a course to get started</p>
        <p style="font-size: 24px;">NEW COURSE FROM PROS</p>
    </div>
    <div class="classify">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="sort">
                        <p style="color: white;">Sorted by:</p>
                        <button onclick="window.location='?mostPopular'">Most Popular</button>
                        <button onclick="window.location='?justAdded'">Just Added</button>
                        <div class="position">
                            <button id="navbarDropdown" role="button" data-toggle="dropdown"> Position &nbsp; <i class="bi bi-caret-down-fill"></i></button>
                            <div class="dropdown-menu" id="dropdown-menu1" aria-labelledby="navbarDropdown">
                                {{-- @foreach ($topics as $value)
                                <p onclick="window.location='?topic={{ Str::slug($value->title.'-'.$value->id) }}'" class="dropdown-item">{{ $value->title }}</p>
                                @endforeach --}}
                                @foreach ($position_all_teachers as $pos)
                                <p onclick="window.location='?position={{ $pos->position }}'" class="dropdown-item">{{ $pos->position }}</p>
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md">

                </div>
            </div>
        </div>
    </div>
    <div class="teacher">
        <div class="container">
            <div class="row">
                @foreach ($data as $value)
                <div class="col-md-4">
                    <div class="img">
                        <img src="{{$value->photo}}" alt="">
                        <div class="text-center">
                            <div class="cenn">
                                <div class="text"><span class="a">{{$value->fullname}}</span>
                                </div>
                                <div class="button">
                                    <button><a href="all-class/{{ Str::slug($value->fullname.'-'.$value->id) }}"><p><i class="bi bi-play-fill"></i>View all classes</p></a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{-- {{ $data->onEachSide(1)->links("pagination::bootstrap-4") }} --}}
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
@endsection