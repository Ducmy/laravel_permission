@extends('layouts.admin')
@push('css')
<link href="{{ asset('css/admin/index.css') }}" rel="stylesheet" />
@endpush
@section('content')
<div class="row mb-3">
    <div class="col-lg-12 margin-tb">
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
<form action="{{ route('courses.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tiêu đề:</strong>
                <input type="text" name="title" class="form-control" placeholder="Khóa học A, B...">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Giá:</strong>
                <input type="text" name="price" class="form-control" placeholder="100, 200,...">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Mô tả khóa học:</strong>
                <textarea class="form-control" style="height:150px" name="summary" placeholder=""></textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Giáo viên</strong>
                <select name="teacher_id">
                    <option value="1">Giáo viên A</option>
                    <option value="2">Giáo viên B</option>
                    <option value="3">Giáo viên C</option>
                    <option value="4">Giáo viên D</option>
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Tạo khóa học</button>
        </div>
    </div>
</form>
@endsection