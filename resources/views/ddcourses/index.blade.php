@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Quản lý khóa học</h2>
        </div>
        <div class="pull-right">
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
        <th>Nội dung</th>
        <th width="280px">Thao tác</th>
    </tr>
    @foreach ($ddcourses as $ddcourse)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $ddcourse->dd_title }}</td>
        <td>{{ $ddcourse->body}}</td>
        <td>
            <form action="{{ route('ddcourses.destroy',$ddcourse->id) }}" method="POST">
                <a class="btn btn-info" href="{{ route('ddcourses.show',$ddcourse->id) }}">Xem chi tiết</a>
                <a class="btn btn-primary" href="{{ route('ddcourses.edit',$ddcourse->id) }}">Cập Nhật</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Xóa</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
{!! $ddcourses->links() !!}
<p class="text-center text-primary"><small>Develop by MyNguyen</small></p>
@endsection