@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Chi tiết khóa học</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('courses.index') }}"> Quay lại</a>
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
            {{ $course->price }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Giáo viên:</strong>
            {{ $course->teacher_id }}
        </div>
    </div>
    {!! Form::open(array('route' => 'my-account-buy','method'=>'POST')) !!}
    <div class="col-xs-12 col-sm-12 col-md-12">
            {!! Form::text('teacher_id', null, array('placeholder' => 'Teacher ID','class' => 'form-control')) !!}
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <button type="submit" class="btn btn-primary">Mua khóa học</button>
    </div>
    {!! Form::close() !!}
</div>
@endsection
<p class="text-center text-primary"><small>Develop by MyNguyen</small></p>