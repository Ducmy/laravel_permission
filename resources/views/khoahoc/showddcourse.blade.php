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
<script src="{{ asset('js/khoahoc/khoahoc.js')  }}"></script>
@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
            <h5 class="baihoc_title">
                {{ $ddcourse->dd_title }}
            </h5>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="error_video">

                <?php 
                    $file_headers = @get_headers($ddcourse->url);
                    if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found'):
                        ?> <h1 class="alert alert-warning text-center">I CAN FIX</h1><?php
                    else:
                ?>
                <?php
                $i = range(1, 1);
                foreach ($i as $key) { ?>
                    <div class=""><a href="https://youtube.com/<?php echo randomString(); ?>" class=""></a>
                        <div>
                        <?php } ?>
                        </div>
                        <div class="plyr__video-embed" id="player" style="--plyr-color-main: #1b4b72;">
                            <iframe src="{{$ddcourse->url}}?showinfo=0&origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1" allowfullscreen allowtransparency allow="autoplay"></iframe>
                        </div>
                    </div>
                            <?php endif;?>
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
                        <div class="text dsread content">
                            
                            <div>
                            {!! nl2br($ddcourse->body) !!}
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                         <ul class="list-group">
                            @foreach($ddcourses as $v)
                            <li class="list-group-item <?php if ($v->id == $ddcourse->id) {
                                                            echo "active";
                                                        } ?>">
                                <a href="{{ route('khdetail', [$course_id, $v->id] )}}">{{$v->dd_title}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            @include('khoahoc.commentsDisplay', ['comments' => $comments, 'ddcourse_id' => $ddcourse->id])
                            <hr />
                            <h4>Đặt câu hỏi</h4>
                            <form method="post" action="{{ route('comments.store') }}">
                                @csrf
                                <div class="form-group mb-2">
                                    <textarea class="form-control" name="body"></textarea>
                                    <input type="hidden" name="lession_id" value="{{ $ddcourse->id }}" />
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" value="Gửi" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .content br {
                    display: none;
                }
            </style>

            <script>
                const player = new Plyr('#player', {
                    title: ' Nội dung bài',
                });

                // document.addEventListener('contextmenu', function(e) {
                //     e.preventDefault();
                // });
            </script>
            @endsection