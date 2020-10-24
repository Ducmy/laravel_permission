@extends('layouts.admin')
@push('css')
<link href="{{ asset('css/admin/index.css') }}" rel="stylesheet" />
@endpush
@section('content')
<ul>
    @foreach ($categories as $category)
        <li>{{ $category->name }}</li>
        <ul>
        @foreach ($category->childrenCategories as $childCategory)
            @include('admin.categories.subcategory', ['child_category' => $childCategory])
        @endforeach
        </ul>
    @endforeach
</ul>
@endsection