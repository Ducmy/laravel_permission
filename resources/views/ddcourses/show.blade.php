@extends('layouts.app')
@push('css')
<link href="{{ asset('css/admin/index.css') }}" rel="stylesheet" />
@endpush
@section('content')
<!-- <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Chi tiết bài học</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('courses.edit', $ddcourse->course_id) }}"> Quay lại</a>
        </div>
    </div>
</div> -->
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Bài học:</strong>
                {{ $ddcourse->dd_title }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <div class="">Nội dung</div>
                <div class=""> {!! nl2br($ddcourse->body) !!}</div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <iframe width="100%" height="500" src="{{ $ddcourse->url }}">
                </iframe>
            </div>
        </div>
    </div>
</div>
@endsection