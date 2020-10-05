@extends('layouts.app') @push('css')
<link href="{{ asset('css/top/index.css') }}" rel="stylesheet" />
@endpush @section('content')

<div id="wrap">

    <section class="banner-top">
        <div class="tim-kiem-khoa-hoc">
            <form action="/" method="get" class="form-search-course">
                <div class="form-group">
                    <input type="text" name="filter[title]" class="form-control" placeholder="Nhập tên khóa học" />
                </div>
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </form>
        </div>
    </section>

    <section class="course-list mt-5">
        <div class="container">
            <section id="danh-sach-khoa-hoc">
                <h5 class="alert alert-primary">Danh sách khóa học</h5>
                <ul class="list-group">
                    @foreach($courses as $key =>$course)
                    <li class="list-group-item">
                        <a href="{{ route('khoahoc', [ 'course_id' => $course->id]) }}" class="">{{$course->title}}</a>
                    </li>
                    @endforeach
                </ul>
            </section>
        </div>
    </section>
</div>
@endsection