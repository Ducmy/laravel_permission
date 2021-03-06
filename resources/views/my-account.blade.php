@extends('layouts.app')

@section('content')
<div class="container">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    @if ($message = Session::get('failure'))
    <div class="alert alert-danger">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Thông tin cá nhân</div>
                <div class="card-body">
                    <div class="card-body-name">Name: {{$user->name}}</div>
                    <div class="card-body-credit">Số credit: {{$user->credit}}</div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Khóa học bạn đã mua</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($myCourses as $course)
                        <li class="list-group-item"><a href="{{route('khoahoc', $course->id)}}" class="">{{$course->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection