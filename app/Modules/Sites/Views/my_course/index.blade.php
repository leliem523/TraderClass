@extends('Sites::layout')
@section('title', $row->title)
@section('content')
@include('Sites::inc.maketting')
<div class="main">
    <div class="container">
        <p id="title">My Course</p>
        <div class="row">
            <div class="col-md-3">
                <div class="avta">
                    <div class="avt">
                        <div class="ava">
                            <p>{{ isset($user->fullname) ? $user->fullname : '?' }}</p>
                        </div>
                    </div>
                    <p>{{ isset($user->fullname) ? $user->fullname : 'No name' }}</p>
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
                    @foreach ($course as $value)
                        <div class="items" 
                             onclick="return window.location = 'course/{{ Str::slug($value->name.'-'.$value->id) }}'"
                             style="cursor: pointer">
                            @if (isset($value->photo))
                                <img src="{{ $value->photo }}" alt="">
                            @else
                                <img src="/public/upload/images/course/thumb/hidden-human.png" alt="">
                            @endif
                                <div class="lname">
                                    <p>{{ $value->name }}</p>
                                    <p id="lname">{{ $value->title }}</p>
                                </div>
                        </div>
                    @endforeach
                    {{ $course->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection