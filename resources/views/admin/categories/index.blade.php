@extends('layouts.admin')
@push('css')
<link href="{{ asset('css/admin/index.css') }}" rel="stylesheet" />
<link href="{{ asset('admin/css/categories.css') }}" rel="stylesheet" />
@endpush
@section('content')
<h5 class="alert alert-info">Danh sách chuyên mục</h5>
<div class="cat_list">
<ul class="list-group">
    @foreach ($categories as $category)
        <li class="list-group-item">{{ $category->name }} <span class="float-right">
            
        @if($category->id !== 1)
        <form action="{{route('destroy_cat', ['cat_id'=> $category->id])}}" method="POST">
        @csrf
        @method('DELETE')
        <a href="{{route('edit_cat', ['cat_id'=> $category->id])}}" class="ml-auto btn btn-primary">Sửa</a>
        
  
            <button type="submit" class="btn btn-danger">Xóa</button>
        </form>
        </form>
        @endif
    </span></li>
        <ul class="list-group ml-5">
        @foreach ($category->childrenCategories as $childCategory)
            @include('admin.categories.subcategory', ['child_category' => $childCategory])
        @endforeach
        </ul>
    @endforeach
</ul>
</div>
@endsection