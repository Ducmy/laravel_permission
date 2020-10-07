<?php 
    function randomString($length = 10) {
        $str = "";
        $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
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
@endpush
@push('js')
<script src="https://cdn.plyr.io/3.6.2/plyr.polyfilled.js"></script>
@endpush
@section('content')
<div class="container menu_course">
    Thêm một menu mô tả khóa học và lựa chọn bài học ở đây, có thể dùng collpase để chọn bài học
</div>
<div class="container">
    <!-- <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Chi tiết bài học ở đây</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('khoahoc', $ddcourse->course_id) }}"> Quay lại</a>
            </div>
        </div>
    </div> -->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <h5 class="text-primary baihoc_title">
                Bài học:
                {{ $ddcourse->dd_title }}
                </h5>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <div class="error_video">
                <?php 
                    $i = range(1, 50);
                    foreach($i as $key){ ?>
                <div class=""><a href="https://youtube.com/<?php echo randomString();?>" class=""></a><div>
                <?php }?>
                </div>
                <div class="plyr__video-embed" id="player" style="--plyr-color-main: #1b4b72;">
                    <iframe src="{{$ddcourse->url}}?showinfo=0&origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1" allowfullscreen allowtransparency allow="autoplay"></iframe>
                </div>
            </div>
        </div>
        <div class="">
            <div class="form-group">
                <div class="content_title">Nội dung</div>
                <div class="text dsread"><p>{!! nl2br($ddcourse->body) !!}</p> </div>
            </div>
        </div>
    </div>
</div>

<script>
  const player = new Plyr('#player', {
    title:' Nội dung bài 1',
  });
  document.addEventListener('contextmenu', function(e) {
  e.preventDefault();
    });
  
</script>
<style>

    .plyr iframe {
    transition: 0.2s filter linear;
    }

    .plyr.plyr--paused iframe {
        filter: blur(1.5rem);
    } 

    iframe .ytp-chrome-, .ytp-show-cards-title {
        display: none!important;
    }

    .error_video > div{
        width: 1000px;
        height: 555px;
        margin: 0 auto;
        max-width: 100%;
    }

    .form-group {
        max-width: 1000px;
        margin: 0 auto;
    }

    .text {
        width: 100%;
        height: unset;
        margin: 0 auto;
    }

    .baihoc_title {
        font-weight: bold;
        margin-bottom: 30px;;
    }

    .content_title {
        margin-top: 80px;
    }

    .content_title {
        color: orange;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .dsread,
    .error_video
     {
        -webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
     -khtml-user-select: none; /* Konqueror HTML */
       -moz-user-select: none; /* Old versions of Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none; /* Non-prefixed version, currently
                                  supported by Chrome, Edge, Opera and Firefox */
    }

</style>

@endsection