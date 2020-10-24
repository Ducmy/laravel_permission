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
    <section class="introduce p-5">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h4 class="text-danger text-center">
                        Giới thiệu
                    </h4>
                    <p class="pt-3">
                        Đội ngũ giáo viên ICFix trẻ trung, năng động đầy nhiệt huyết.<br>
                        Cung cấp các khóa học trực tuyến để sửa chữa iPhone, iPad, Watch...<br>
                        Được giáo viên truyền thụ võ công, lành tày nghề trước khi áp dụng vào thực tế sửa chữa cho máy khách.<br>
                        Bạn cũng có thể đăng ký làm giáo viên cho khóa học!<br>
                        Hãy đến với EduICFix!!!<br>
                        <br><br>

                        <a href="#all_course" class="btn btn-danger">Học ngày nào!</a>
                    </p>
                </div>
                <div class="col-6">
                    <iframe width="420" height="315" src="https://www.youtube.com/embed/vQ29aWBOB9Q">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <section id="all_course" class="course-list mt-5">
        <div class="container">
            <section id="danh-sach-khoa-hoc">
                <h5 class="tieu_de">Danh sách khóa học</h5>
                @foreach($categories as $c)
                <div class="mt-5 mb-5">
                    <h5 class="alert alert-warning ml-5">{{$c->name}}</h5>
                    <ul class="dskhoahoc d-flex flex-wrap">
                        @foreach($courses as $key =>$course)
                        @if($course->cat_id == $c->id)
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
                                        <div class="price badge badge-success">
                                            @if($course->price == 0)
                                            Miễn phí
                                            @else
                                            {{$course->price}} Xu
                                            @endif
                                        </div>
                                        <div class="detail badge badge-danger">
                                            <a href="{{ route('khoahoc', [ 'course_id' => $course->id]) }}" class="">Mua</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
                @endforeach

            </section>
        </div>
    </section>
    <section class="doi_ngu_giao_vien pt-3 pb-5">
        <div class="container">
            <h4 class="text-center text-danger">Đội ngũ giáo viên IC Fix</h4>
            <div class="row">
                <ul class="form-group teacher_list">
                    @foreach($teachers as $teacher)
                    <li class="">
                        {{$teacher->name}}
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <!-- <section class="doi_ngu_giao_vien">
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
    </section> -->
</div>
@endsection