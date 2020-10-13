@extends('layouts.admin')

@push('css')
<link href="{{ asset('css/admin/index.css') }}" rel="stylesheet" />
@endpush

@push('js')
<script src="/ckeditor/ckeditor.js"></script> 
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-3">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('courses.edit', $ddcourse->course_id) }}"> Quay lại</a>
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

<form action="{{ route('ddcourses.update',$ddcourse->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tên bài học</strong>
                <input type="text" name="dd_title" value="{{ $ddcourse->dd_title }}" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nội dung</strong>
                <textarea id="editor1" class="form-control" name="body" cols="30" rows="10">{{ $ddcourse->body }}</textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Link video</strong>
                <input type="text" name="url" value="{{ $ddcourse->url }}" class="form-control" placeholder="URL">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Cập nhập bài học</button>
        </div>
    </div>
</form>

<script type="text/javascript">  
   CKEDITOR.replace( 'editor1');  
</script>  
@endsection