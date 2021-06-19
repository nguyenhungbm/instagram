@extends('admin.layout')
@section('content') 
<style>
a{text-decoration:none}</style>
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Quyền hạn</h1>
    <small>@if(!$role_count) Hiện tại bạn chỉ có thể xem trang này. Liên hệ admin để thêm quyền hạn @endif</small>
  </div>

  <div class="row">
    <div class="col-lg-12 mb-4">
      <!-- Simple Tables -->
      <div class="card">
        <a href="{{ route('permission.create')}}">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Thêm quyền hạn</h6>
        </div>
        </a>
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th>ID</th>
                <th>Quyền hạn</th> 
                <th>Mô tả quyền hạn</th> 
                <th>Quyền hạn gốc</th> 
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                       
                      @foreach($permission as $list)
              <tr>
                <td>{{$list->id}}</td>
                <td>{{$list->name}}</td> 
                <td>{{$list->display_name}}</td> 
                <td>
                        @foreach(\App\Models\permission::where('name',$list->name)->get() as $val)
                        {{$val->parent_id}}
                        @endforeach
                </td> 
                <td>
                <a href="{{ route('permission.edit',$list->id)}}" class="btn btn-sm btn-primary">Sửa</a> 
                <form action="{{ route('permission.destroy',$list->id)}}" method="post">
                  @method('DELETE')
                  @csrf
                  <button class="btn btn-sm btn-danger">  Xoá</button>
                </form></td>
              </tr>
                      @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer"></div>
      </div>
    </div>
  </div>
  <!--Row-->
  <div class="box-footer">
                  {!! $permission->links() !!}
          </div>
        

</div>
@endsection