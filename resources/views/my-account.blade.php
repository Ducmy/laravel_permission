@extends('layouts.app')

@section('content')
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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thông tin cá nhân</div>

                <div class="card-body">
                    <div class="card-body-name">Name:  {{$user->name}}</div>
                   <div class="card-body-credit">Số credit: {{$user->credit}}</div>
                   {!! Form::open(array('route' => 'my-account-buy','method'=>'POST')) !!}
                   <div class="card-body-try-charge">
                        Khóa học 1: -200 credit
                        {!! Form::text('product_id', null, array('placeholder' => 'Mã sản phẩm','class' => 'form-control')) !!}
                        <button type="submit" class="btn btn-primary">Mua thử</button>
                   </div>
                   {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
