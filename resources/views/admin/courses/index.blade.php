@extends('layouts.admin')
@push('css')
<link href="{{ asset('css/admin/index.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
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
        <th>Ảnh mô tả</th>
        <th>Tiêu đề</th>
        <th>Miêu tả</th>
        <th>Trạng thái</th>
        <th>Giá</th>
        <th width="280px">Thao tác</th>
    </tr>
    @foreach ($courses as $course)
    <tr>
        <td>{{ ++$i }}</td>
        <th>
            <div class="course_thumb"  style="max-width: 100px;">
                @if($course->thumb == 'not_found.png')
                    <img class="img-fluid img-thumbnail" src="{{ asset('images/not_found.png') }}" alt="{{ $course->title }}">
                @else
                    {!! $course->thumb !!}
                @endif
            </div>
        </th>
        <td>{{ $course->title }}</td>
        <td>

            <div class=""> {!! nl2br($course->summary) !!}</div>
        </td>
        <td>
            <input type="hidden" id="course_{{$course->id}}" name="id" value="{{$course->id}}">
            <input class="toggle" id="toggle-event-{{$course->id}}" type="checkbox" @if($course->active)
            checked
            @endif
            data-toggle="toggle">


        </td>
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
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script>
    $(function() {

        @foreach($courses as $course)
        $('#toggle-event-{{$course->id}}').change(function(e) {
            var active = ($(this).prop('checked')) ? 1 : 0;
            var id = $("#course_{{$course->id}}").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault();
            var formData = {
                active,
                id,
            };
            var type = "POST";
            var ajaxurl = "{{ route('courseStatus', ['id' => $course->id]) }}";

        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                
            },
            error: function (data) {
                console.log(data);
            }
            });
        })
        @endforeach


    });
</script>
@endsection