@extends('layouts.app')
@push('js')
@endpush
@push('css')
<link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Quản lý khóa học</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('courses.index') }}"> Back</a>
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

<form action="{{ route('courses.update',$course->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tiêu đề:</strong>
                <input type="text" name="title" value="{{ $course->title }}" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Mô tả:</strong>
                <textarea class="form-control" style="height:150px" name="summary" placeholder="Detail">{{ $course->summary }}</textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Giáo viên:</strong>
                <input type="text" name="teacher_id" value="{{ $course->teacher_id }}" class="form-control" placeholder="Credit">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Giá:</strong>
                <input type="text" name="price" value="{{ $course->price }}" class="form-control" placeholder="Credit">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="ddcourse-lists">
            Danh sách bài học
            <ul id="ddcourse_lists" class="ddcourses">
                @foreach($ddcourses as $key => $ddcourse)
                @if($ddcourse->course_id == $course->id)
                <li class="d-flex mb-2 list-group-item" data-id="{{$ddcourse->id}}">
                    <form action="{{ route('ddcourses.destroy',$ddcourse->id) }}" method="POST">
                        <a href="{{ route('ddcourses.show',$ddcourse->id) }}">{{$ddcourse->dd_title}}</a>
                        <a href="{{ route('ddcourses.edit',$ddcourse->id) }}" class="btn btn-success ml-3">Sửa</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </li>
                @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <a class="btn btn-success" href="{{ route('ddcourses.create', ['course_id' => $course->id]) }}">Tạo bài học mới</a>
    </div>
</div>
<p class="text-center text-primary"><small>Develop by MyNguyen</small></p>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
<script type="text/javascript">
    $(function() {
        $(".ddcourse-lists").DataTable();

        $("#ddcourse_lists").sortable({
            items: "li",
            cursor: 'move',
            opacity: 0.6,
            update: function() {
                sendOrderToServer();
            }
        });

        function sendOrderToServer() {
            var order = [];
            var token = $('meta[name="csrf-token"]').attr('content');
            $('li').each(function(index, element) {
                order.push({
                    id: $(this).attr('data-id'),
                    position: index + 1
                });
            });

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('update-order') }}",
                data: {
                    order: order,
                    _token: token
                },
                success: function(response) {
                    if (response.status == "success") {
                        console.log(response);
                        console.log("Vo a")
                    } else {
                        console.log(response);
                        console.log("Vo b")
                    }
                }
            });
        }
    });
</script>
@endsection