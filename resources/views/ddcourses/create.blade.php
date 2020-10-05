@extends('layouts.app')
@push('css')
<link href="{{ asset('css/admin/index.css') }}" rel="stylesheet" />
@endpush
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <!-- <div class="pull-left">
            <h2>Thêm bài học mới</h2>
        </div> -->
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('courses.index') }}"> Quay lại</a>
        </div>
    </div>
</div>
@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ route('ddcourses.store') }}" method="POST">
    @csrf
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <input type="hidden" name="course_id" class="form-control" value="{{$course_id}}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tên bài học </strong>
                <input type="text" name="dd_title" class="form-control" placeholder="">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nội dung:</strong>
                <textarea type="text" name="body" class="form-control" placeholder=""></textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nội dung:</strong>
                <input type="text" name="url" class="form-control" placeholder="https://">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Tạo bài học</button>
        </div>
    </div>
</form>
@endsection