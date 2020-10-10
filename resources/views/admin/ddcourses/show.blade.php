@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tiêu đề:</strong>
                <h4 class="text-danger">{{ $ddcourse->dd_title }}</h4>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">

            <strong class="">Link video</strong> <a href="{{ $ddcourse->url }}" target="_blank" class="">:{{$ddcourse->url}}</a>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
            <div class="mb-3"> <strong class="">Nội dung (Text + Hình ảnh)</strong></div>
            <div class="content"> {!! nl2br($ddcourse->body) !!}</div>
        </div>
    </div>
</div>
<style>
    .content {
        border: 1px dotted black;
        padding: 50px 20px;
    }
</style>
@endsection