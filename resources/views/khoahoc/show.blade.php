@extends('layouts.app')

@push('css')
<link href="{{ asset('css/khoahoc/index.css') }}" rel="stylesheet" />
<!-- <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 mt-sm-5 d-flex flex-wrap">
            <div class="row w-100 m-auto">
                <div class="title col-12">
                    <div class="row">
                        <h4 class="alert-danger pt-2 pb-2 pl-3 pr-3 text-danger mb-5 w-100 text-uppercase">{{ $course->title }}</h4>
                    </div>
                </div>
                <div class="form-group col-12 col-md-6 pl-3">
                    <div class="row">

                        <div class="col-6">
                            <div class="row">
                                <div class="preview-pic tab-content">
                                    <div class="tab-pane active" id="pic-1"><img src="https://dummyimage.com/150x150/0099ff/000" /></div>
                                </div>
                            </div>

                        </div>
                        <div class="col-6">
                            <form action="{{ route('my-account-buy') }}" method="post">
                                @csrf
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <input type="hidden" name="course_id" class="form-control" value="{{$course->id}}">
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="row flex-wrap">
                                        @auth
                                        @if($isPurchased)
                                        <h4 class=""><span class="badge badge-success">Đã mua</span></h4>
                                        @else
                                        <h4 class="w-100"><span class="badge badge-success">{{ $course->price }} Credit</span></h4>
                                        <button type="submit" class="btn btn-danger font-weight-bold">Mua khóa học</button>

                                        @endif

                                        @else
                                        <h4 class=""><span class="badge badge-success">{{ $course->price }} Xu</span></h4>
                                        <button type="submit" class="btn w-100 btn-danger font-weight-bold">Mua khóa học</button>
                                        @endauth
                                    </div>
                                </div>
                            </form>

                            <div class="mo_ta_bai_hoc">
                                <h5 class="mo-ta-ngan text-primary">Mô tả ngắn:</h5>
                                <div class=""> {!! nl2br($course->summary) !!}</div>
                            </div>

                            <div class="giao_vien mt-4">
                                <h5 class="mo-ta-ngan text-primary">Giáo viên</h5>
                                <div class="">{{ $teacher->name }}</div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="form-group col-12 col-md-6">
                    <form action="{{ route('danhgia') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="card">
                            <div class="container-fliud">
                                <div class="wrapper row">

                                    <div class="details col-md-9 w-30">
                                        <h5 class="product-title">Đánh giá khóa học</h5>
                                        <div class="rating">
                                            <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $course->averageRating }}" data-size="xs">
                                            <input type="hidden" name="id" required="" value="{{ $course->id }}"> <span> {{$course->usersRated()}} lượt Review</span>
                                            <br />
                                            @auth
                                            @if($isPurchased)
                                            <button class="btn btn-success btn_review_submit">Gửi</button>
                                            @endif
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5 mb-5"></div>
    @auth
    @if($isPurchased)
    <div class="row mt-5 mb-5">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <h5 class="alert-info text-primary text-uppercase p-3 mb-3">Danh sách bài học</h5>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <ul class="list-group">
                @foreach($ddcourses as $ddcourse)
                @if($ddcourse->course_id == $course->id)
                <li class="list-group-item">
                    <a href="{{ route('khdetail', [$course, $ddcourse->id] )}}" target="_blank">{{$ddcourse->dd_title}}</a>
                </li>
                @endif
                @endforeach
            </ul>
        </div>

    </div>
    @endif
    @endauth
</div>

<script type="text/javascript">
    $("#input-id").rating();
</script>

<!-- <div class="mt-5 mb-5 pt-5"></div> -->
<div class="mt-5 mb-5 pt-5"></div>
@endsection