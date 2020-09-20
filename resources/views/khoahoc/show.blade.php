@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Chi tiết khóa học</h2>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Tiêu đề:</strong>
            {{ $course->title }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Mô tả ngắn:</strong>
            {{ $course->summary }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Giá:</strong>
            <label for="" class="text-primary font-weight-bold">{{ $course->price }}</label> <strong class="">CREDIT</strong>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Giáo viên:</strong>
            {{ $teacher->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <form action="{{ route('my-account-buy') }}" method="post">
            @csrf
            <div class="col-xs-12 col-sm-12 col-md-12">
                <input type="hidden" name="course_id" class="form-control" value="{{$course->id}}">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                @auth
                @if($isPurchased)
                <div class="badge badge-success mb-3">Bạn đã mua khóa học này</div>
                <div class="course-lists">
                    <div class="alert alert-success w-100 text-center">Nội dung khóa học</div>
                    <ul class="courses">
                        @foreach($ddcourses as $ddcourse)
                        @if($ddcourse->course_id == $course->id)
                            <li>
                                <a href="{{ route('khdetail',[ $course->id, $ddcourse->id]) }}">{{$ddcourse->dd_title}}</a>
                            </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
                @else
                <button type="submit" class="btn btn-primary">Mua khóa học</button>
                @endif
                @else
                <button type="submit" class="btn btn-primary">Mua khóa học</button>
                @endauth
            </div>
        </form>
    </div>
</div>
@auth
@if($isPurchased)
<div class="col-xs-12 col-sm-12 col-md-12">
    <h4>Phần bình luận</h4>
    @include('courses.commentsDisplay', ['comments' => $course->comments, 'course_id' => $course->id])
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
<p class="text-center text-primary"><small>Develop by MyNguyen</small></p>
@endsection