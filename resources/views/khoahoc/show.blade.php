@extends('layouts.app')

<link href="{{ asset('css/khoahoc/index.css') }}" rel="stylesheet" />
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
        <h5 class="alert alert-primary text-center">{{ $course->title }}</h5>
        </div>
    </div>
    <div class="mt-5"></div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <div class="mo-ta-ngan text-primary">Mô tả ngắn:</div>
                <div class=""> {!! nl2br($course->summary) !!}</div>
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
                        <h4 class=""><span class="badge badge-primary">Nội dung bài học</span></h4>
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
                    <a href="{{ route('khdetail',[ $course->id, $ddcourse->id]) }}" target="_blank">{{$ddcourse->dd_title}}</a>
                </li>
                @endif
                @endforeach
            </ul>
        </div>

    </div>

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
    @endif
    @endauth
</div>
<div class="mt-5 mb-5 pt-5"></div>
@endsection