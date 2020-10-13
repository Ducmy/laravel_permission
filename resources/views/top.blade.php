@extends('layouts.app') @push('css')
<link href="{{ asset('css/top/index.css') }}" rel="stylesheet" />
@endpush @section('content')

<div id="wrap">

    <section class="banner-top">
        <div class="tim-kiem-khoa-hoc">
            <form action="/" method="get" class="form-search-course">
                <div class="form-group">
                    <input type="text" name="filter[title]" class="form-control" placeholder="Tìm khóa học" />
                </div>
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </form>
        </div>
    </section>

    <section class="course-list mt-5">
        <div class="container">
            <section id="danh-sach-khoa-hoc">
                <h5 class="tieu_de">Danh sách khóa học</h5>
                <ul class="dskhoahoc d-flex flex-wrap">
                    @foreach($courses as $key =>$course)
                    <li class="col-12 col-md-4 item_kh">
                        <div class="wrap">
                            <a href="javascript:void(0)" class="mb-3 text-center">{{$course->title}}</a>
                            <div class="preview-pic tab-content">
                                <div class="tab-pane active" id="pic-1"><img src="https://dummyimage.com/150x150/0099ff/000" /></div>
                            </div>
                            <div class="mo_ta_bai_hoc">
                                <div class="mo-ta-ngan text-primary">Mô tả ngắn:</div>
                                <div class="mo_ta_text"> {!! nl2br($course->summary) !!}</div>

                            </div>
                            <div class="link col-12">
                                <div class="row">
                                    <div class="price badge badge-success"> {{$course->price}} Xu</div>
                                    <div class="detail badge badge-danger">
                                        <a href="{{ route('khoahoc', [ 'course_id' => $course->id]) }}" class="">Chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </section>
        </div>
    </section>

    <section class="introduce">
        <div class="container">
            <div class="row">
                YOUTUBE VIDEO
            </div>
        </div>
    </section>
    <section class="doi_ngu_giao_vien">
        <div class="container">
            <div class="row">
                Đội ngũ giáo viên IC Fix
            </div>
        </div>
    </section>
   
    <section class="doi_ngu_giao_vien">
        <div class="container">
            <div class="row">
                Đăng ký thành viên
            </div>
        </div>
    </section>
    <section class="lien_he">
        <div class="container">
            <div class="row">
                Đăng ký liên hệ
            </div>
        </div>
    </section>
</div>
@endsection