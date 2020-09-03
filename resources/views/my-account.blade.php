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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thông tin cá nhân</div>
                <div class="card-message">
                </div>
                <div class="card-body">
                    <div class="card-body-name">Name:  {{$user->name}}</div>
                   <div class="card-body-credit">Số credit: {{$user->credit}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
