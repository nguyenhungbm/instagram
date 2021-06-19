@extends('admin.layout')
@section('content') 

<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Quản trị viên</h1>
    <small>@if(!$role_count) Hiện tại bạn chỉ có thể xem trang này. Liên hệ admin để thêm quyền hạn @endif</small>
  </div>

  <div class="row">
    <div class="col-lg-12 mb-4">
      <!-- Simple Tables -->
      <div class="card">
        <a href="{{ route('admin.create')}}">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Thêm quản trị viên</h6>
          </div>
        </a>
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th>ID</th>
                <th>Admin</th>
                <th>Email</th> 
                <th>Vai trò</th> 
                <th>Hành động</th>
              </tr>
            </thead>
            <tbody>
              @foreach($admin as $list)
                <tr>
                  <td>{{ $list->id}}</td>
                  <td>{{ $list->name}}</td>
                  <td>{{ $list->email}}</td>
                  <td>
                    @foreach($list->roles as $val)
                      <a class="btn btn-success text-light" style="cursor:pointer"> {{$val->name}}</a>
                    @endforeach
                  </td>
                  <td>
                    <a href="{{ route('admin.edit',$list->id)}}" class="btn btn-sm btn-primary">Cập nhật</a>
                    <form action="{{ route('admin.destroy',$list->id)}}" method="post">
                      @method('DELETE')
                      @csrf
                      <button data-title="Bạn có muốn xóa không ?"  class="twitter btn btn-sm btn-danger">Xoá</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div> 
    <div class="box-footer">
      {{ $admin->links() }}
    </div>
</div>
  <!--Row-->
</div>

@endsection