@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="pull-left">
      <h4>Quản lý thành viên</h4>
    </div>
    <div class="pull-right mb-2">
      <a class="btn btn-success" href="{{ route('users.create') }}">Tạo thành viên mới</a>
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
    <th>Họ tên</th>
    <th>Email</th>
    <th>Vai trò</th>
    <th width="280px">Thao tác</th>
  </tr>
  @foreach ($data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
      @foreach($user->getRoleNames() as $v)
      <label class="badge badge-success">{{ $v }}</label>
      @endforeach
      @endif
    </td>
    <td>
      <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Xem</a>
      <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Sửa</a>
      {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
      {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
      {!! Form::close() !!}
    </td>
  </tr>
  @endforeach
</table>
{!! $data->render() !!}
<p class="text-center text-primary"><small>Develop by MyNguyen</small></p>
@endsection