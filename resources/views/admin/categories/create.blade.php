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
<form action="{{ route('store_cat') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tên chuyên mục</strong>
                <input type="text" name="name" class="form-control" placeholder="Phần cứng, phần mềm, kỹ năng, pan bệnh,...">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Chuyên mục cha</strong>
                <select name="category_id" class="form-control" >
                    @foreach($categories as $key => $category)
                        @if($category->id == 1)
                            <option value="">Không chọn</option>
                        @else 
                            {{-- <option value="{{$category->id}}">{{$category->name}}</option> --}}
                        @endif  
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Tạo chuyên mục</button>
        </div>
    </div>
</form>
</div>
@endsection