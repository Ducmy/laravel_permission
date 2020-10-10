@extends('layouts.admin')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 margin-tb">
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

  <div class="row mt-4">
    <div class="col-lg-12 margin-tb d-flex justify-content-between">
      <a href="{{url('admin/users')}}" class="btn btn-primary list_btn">Xem toàn bộ danh sách</a>
      <form action="{{url('admin/users')}}" method="get" class="form-search-course d-flex">
        <div class="form-group">
          <input type="text" name="filter[email]" class="form-control" placeholder="Nhập emai,..." />
        </div>
        <button type="submit" class="btn btn-primary ml-3">Tìm kiếm</button>
      </form>
    </div>
  </div>

  <table class="table table-bordered">
    <tr>
      <th>No</th>
      <th>Họ tên</th>
      <th>Email</th>
      <th>Thành viên</th>
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
        @if($v == 'user')
        @endif
        <label class="badge badge-dark">
          @if($v == 'user')
          Học viên
          @elseif($v == 'teacher')
          Giáo viên
          @elseif($v == 'admin')
          Admin
          @elseif($v == 'super-admin')
          Super Admin
          @endif
        </label>

        @endforeach
        @endif
      </td>
      <td>
        {{-- <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Xem</a> --}}
        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Cập nhật</a>
        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
        {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
      </td>
    </tr>
    @endforeach
  </table>
  {!! $data->render() !!}
</div>

<style>

  .form-search-course .form-group {
    width: 400px;
    flex: 0 0 400px;
  }

  .btn:not(:disabled):not(.disabled) {
    margin-bottom: 1em;
  }

  .list_btn {
    height: 38px;
  }

</style>
@endsection