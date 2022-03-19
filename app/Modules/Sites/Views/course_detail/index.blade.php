@extends('Sites::courseIntroduction')
@section('title', $row->title)
@section('content')
@include('Sites::inc.maketting')
<div class="main">
    <div class="container">
        <p id="title">
            Detailed course
        </p>
        <!-- <p style="color: white;">View offers and select courses of interest.</p> -->
        @if (isset($course->video_id))
        <div class="row" id="row">
            <div class="col-md-8">
                {{-- <div class="wrappe">
                    <video class="video" id="video" controls>
                    <source src="https://www.youtube.com/embed/{{ $course->video_id}}" type="video/mp4">
                  </video>
                    <div class="playpause" id="playpause" onclick="on()"><img src="/public/sites/images/media_play_pause_resume.png" alt=""></div>
                    <div class="offvideo" id="offvideo" onclick="off()"></div>
                </div> --}}
                <div class="youtube wrappe" onclick="playvideo()">
                    {{-- <video src="" class="video"> --}}
                    <iframe class="video" width="730" height="400" src="https://www.youtube.com/embed/{{ isset($course_video) ? $course_video->id_video : $course->video_id }}?modestbranding=1&showinfo=0&controls=0&autohide=1&rel=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                    
                    {{-- </video> --}}
                    {{-- <div class="playpause"><img src="/public/sites/images/media_play_pause_resume.png" alt=""></div> --}}
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
                    @foreach ($list_video as $value)
                    <div class="video_fields">
                      <a href="/course/{{ Str::slug($course->name.'-'.$course->id) }}/{{ Str::slug($value->name.'-'.        $value->id) }}">
                        <p>{{ $value->name }}</p>
                      </a>
                    </div> 
                    @endforeach
                </div>
            </div>
        </div>
        @else
           <div class="row">
               <div class="col-md-8">
                <h1 class="" style="color: white; padding: 5em 0; text-align: center">
                    No video to show
                </h1>
               </div>
           </div>
        @endif
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-9">
                        <p id="title">{{ isset($course->name) ? $course->name : '' }}</p>
                        <p style="font-size: 20px; color: white; font-weight: 100;">{{ isset($course->fullname) ? $course->fullname : '' }}</p>
                        <p><span style="font-size: 14px; color: #EF8D21;"> 
                            {{ (double) $count_avg->avg_rating }} 
                            @for ($i = 1; $i <= 5; $i++)
                                @if (ceil($count_avg->avg_rating) > $count_avg->avg_rating && $i <= (int) $count_avg->avg_rating )
                                    <i class="fas fa-star"></i>
                                @elseif ($i == (int) $count_avg->avg_rating + 1)
                                    <i class="fas fa-star-half-alt"></i>
                                @else
                                <i class="far fa-star"></i>
                                @endif
                            @endfor
                           </span>&ensp;<span style="font-size: 14px; color: white;">({{ $course_comment_count->count }} Đánh giá) - {{ $sum_user_of_course->count }} Học viên</span></p>
                    </div>
                    {{-- <div class="col-md-3" id="col-md-3">
                        <button onclick="nextv()"><p><img width="12px" style="margin-bottom: 3px;"  src="/public/sites/images/nextvideo.png" alt="">&ensp; Next video</p></button>
                        <!-- <button id="but" onclick="nextvideo('/public/sites/mp4/Teacher2.mp4')"><p><img width="12px" style="margin-bottom: 3px;"  src="/public/sites/images/nextvideo.png" alt="">&ensp; Next video</p></button> -->
                    </div> --}}
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
              @if (isset($course_video))
                <p style="font-size: 13px; color: white;">{{ $course_video->description }}</p>
              @else
                <p style="font-size: 13px; color: white;">{{ $course->description }}</p>
              @endif
                <p id="title" style="padding-top: 30px;">Rate and comment</p>
                <div class="commet">
                    <div class="imt">
                        @foreach ($course_comment as $cmt)
                                <div class="com">
                                    <div class="date">
                                        <div id="google">
                                           <img class="img-fluid" src="{{ $cmt->photo }}" alt="">
                                        </div>
                                        <p id="date"><span>{{ $cmt->fullname }}</span> </p>
                                    </div>
                                    <div class="str">
                                        <p style="color: #EF8D21; padding-left: 7%;">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $cmt->rating)
                                                <i class="fas fa-star"></i>
                                            @else
                                            <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                        </p>
                                        <p id="commet" style="color: white;">{{$cmt->comment}}</p>
                                    </div>
                                </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 @endsection
