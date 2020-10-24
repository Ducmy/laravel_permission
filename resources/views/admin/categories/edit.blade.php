@extends('layouts.admin')
@push('css')
<link href="{{ asset('css/admin/index.css') }}" rel="stylesheet" />
@endpush
@section('content')
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
<div style="max-width: 500px;">
<form action="{{ route('update_cat', ['cat_id' => $category->id]) }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Đổi tên chuyên mục</strong>
                <input type="text" value="{{$category->name}}" name="name" class="form-control" placeholder="Phần cứng, phần mềm, kỹ năng, pan bệnh,...">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Đổi chuyên mục cha</strong>
                <select name="category_id" class="form-control" >
                    <option value="" selected>Không thể chuyển đổi</option>
                    @foreach($categories as $key => $cat)
                        @if($cat->id == $category->category_id)
                            <option value="{{$cat->id}}" selected>{{$cat->name}}</option>
                        @else
                            {{-- <option value="{{$cat->id}}">{{$cat->name}}</option> --}}
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Cập nhật chuyên mục</button>
        </div>
    </div>
</form>
</div>
@endsection