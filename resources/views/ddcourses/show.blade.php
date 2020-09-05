@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Chi tiết bài học ở đây</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('courses.edit', $ddcourse->course_id) }}"> Quay lại</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Tiêu đề:</strong>
            {{ $ddcourse->title }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nội dung</strong>
            {{ $ddcourse->body }}
        </div>
    </div>
</div>
<p class="text-center text-primary"><small>Develop by MyNguyen</small></p>
@endsection
