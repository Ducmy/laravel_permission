@extends('layouts.admin')
@push('css')
<link href="{{ asset('css/admin/index.css') }}" rel="stylesheet" />
@endpush
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right mb-3 float-right">
            <a class="btn btn-success" href="{{ route('courses.create') }}"> Tạo khóa học mới</a>
        </div>
    </div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Tiêu đề</th>
        <th>Miêu tả</th>
        <th>Giá</th>
        <th width="280px">Thao tác</th>
    </tr>
    @foreach ($courses as $course)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $course->title }}</td>
        <td> <div class=""> {!! nl2br($course->summary) !!}</div></td>
        <td>{{ $course->price }}</td>
        <td>
            <form action="{{ route('courses.destroy',$course->id) }}" method="POST">
                {{-- <a class="btn btn-info" href="{{ route('courses.show',$course->id) }}">Xem chi tiết</a> --}}
                <a class="btn btn-primary" href="{{ route('courses.edit',$course->id) }}">Cập Nhật</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Xóa</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
{!! $courses->links() !!}
@endsection