@extends('layouts.app')

@push('css')
<link href="{{ asset('css/khoahoc/index.css') }}" rel="stylesheet" />
<!-- <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <h5 class="alert alert-primary text-center">{{ $course->title }}</h5>
        </div>
    </div>
    <div class="mt-5"></div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 mt-sm-5">
            <div class="form-group">
                <form action="{{ route('danhgia') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="container-fliud">
                            <div class="wrapper row">
                                <div class="preview col-md-3">
                                    <div class="preview-pic tab-content">
                                        <div class="tab-pane active" id="pic-1"><img src="https://dummyimage.com/150x150/0099ff/000" /></div>
                                    </div>
                                </div>
                                <div class="details col-md-9">
                                    <h3 class="product-title">Cho điểm bài học</h3>
                                    <div class="rating">
                                        <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $course->averageRating }}" data-size="xs">
                                        <input type="hidden" name="id" required="" value="{{ $course->id }}"> <span> {{$course->usersRated()}} lượt Review</span>
                                        <br />
                                        <button class="btn btn-success">Gửi</button>
                                    </div>

                                    <div class="mo_ta_bai_hoc">
                                        <div class="mo-ta-ngan text-primary">Mô tả ngắn:</div>
                                        <div class=""> {!! nl2br($course->summary) !!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-sm-5">
            <div class="form-group">
                <div class="title-group">Giáo viên:</div>
                <div class="">{{ $teacher->name }}</div>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12 mt-5">
            <div class="row">
                <form action="{{ route('my-account-buy') }}" method="post">
                    @csrf
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <input type="hidden" name="course_id" class="form-control" value="{{$course->id}}">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        @auth
                        @if($isPurchased)
                        <h4 class=""><span class="badge badge-primary">Nội dung khóa học</span></h4>
                        @else
                        <h4 class=""><span class="badge badge-success">{{ $course->price }} Xu</span></h4>
                        <button type="submit" class="btn btn-primary">Mua khóa học</button>

                        @endif

                        @else
                        <h4 class=""><span class="badge badge-success">{{ $course->price }} Xu</span></h4>
                        <button type="submit" class="btn btn-primary">Mua khóa học</button>
                        @endauth
                    </div>
                </form>
            </div>
        </div>
    </div>
    @auth
    @if($isPurchased)
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <ul class="list-group">
                @foreach($ddcourses as $ddcourse)
                @if($ddcourse->course_id == $course->id)
                <li class="list-group-item">
                    <a href="{{ route('khdetail', [$course, $ddcourse->id] )}}" target="_blank">{{$ddcourse->dd_title}}</a>
                </li>
                @endif
                @endforeach
            </ul>
        </div>

    </div>

    {{--
    <div class="col-xs-12 col-sm-12 col-md-12">
        <h4>Phần bình luận</h4>
        @include('khoahoc.commentsDisplay', ['comments' => $course->comments, 'course_id' => $course->id])
        <hr />
        <h4>Thêm bình luận</h4>
        <form method="post" action="{{ route('comments.store') }}">
    @csrf
    <div class="form-group">
        <textarea class="form-control" name="body"></textarea>
        <input type="hidden" name="course_id" value="{{ $course->id }}" />
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-success" value="Bình luận" />
    </div>
    </form>
</div>
--}}
@endif
@endauth
</div>

<script type="text/javascript">
    $("#input-id").rating();
</script>

<div class="mt-5 mb-5 pt-5"></div>
@endsection