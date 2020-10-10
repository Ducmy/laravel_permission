<?php
function randomString($length = 10)
{
    $str = "";
    $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
    $max = count($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
    }
    return $str;
}
?>
@extends('layouts.app')
@push('css')
<link href="https://cdn.plyr.io/3.6.2/plyr.css" rel="stylesheet" />
<link href="{{ asset('css/khoahoc/baihoc.css') }}" rel="stylesheet" />
@endpush
@push('js')
<script src="https://cdn.plyr.io/3.6.2/plyr.polyfilled.js"></script>
@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <h5 class="baihoc_title">
                {{ $ddcourse->dd_title }}
            </h5>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="error_video">
                <?php
                $i = range(1, 2);
                foreach ($i as $key) { ?>
                    <div class=""><a href="https://youtube.com/<?php echo randomString(); ?>" class=""></a>
                        <div>
                        <?php } ?>
                        </div>
                        <div class="plyr__video-embed" id="player" style="--plyr-color-main: #1b4b72;">
                            <iframe src="{{$ddcourse->url}}?showinfo=0&origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1" allowfullscreen allowtransparency allow="autoplay"></iframe>
                        </div>
                    </div>
            </div>
            <div class="noi_dung_bai_hoc">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Nội dung bài học</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Danh sách bài học</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Giải đáp thắc mắc</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="text dsread">
                            <p>{!! nl2br($ddcourse->body) !!}</p>
                            <div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                         <ul class="list-group">
                            @foreach($ddcourses as $v)
                                <li class="list-group-item <?php if($v->id == $ddcourse->id)  { echo "active";}?>">
                                    <a href="{{ route('khdetail', [$course_id, $v->id] )}}">{{$v->dd_title}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">Phần bình luận ở đây</div>
                </div>


            </div>

            <script>
                const player = new Plyr('#player', {
                    title: ' Nội dung bài',
                });
                // document.addEventListener('contextmenu', function(e) {
                //     e.preventDefault();
                // });
            </script>
            @endsection