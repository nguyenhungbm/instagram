<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Quản trị viên</h1>
    <small>@if(!$role_count) Hiện tại bạn chỉ có thể xem trang này. Liên hệ permission để thêm quyền hạn @endif</small>
  </div>

  <div class="row">
    <div class="col-lg-12 mb-4">
      <!-- Simple Tables -->
      <div class="card">
        <a href="{{ route('permission.create')}}">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Thêm quản trị viên</h6>
          </div>
        </a>
        <div class="table-responsive">
        <form class="row g-5">
        <div class="col-auto d-flex">
        Tìm kiếm:
            <input wire:model="search" type="search" class="form-control" id="inputPassword2" placeholder="Search">
        </div>   
        <div class="col-auto d-flex">
        Lọc theo :
            <select wire:model="orderBy" class="form-control mr-4">
                <option value="id">Id</option>
                <option value="name">Tên</option>
                <option value="email">Email</option>
            </select>
        </div>
        <div class="col-auto ">
            <select wire:model="orderAsc" class="form-control mr-4">
                <option value="1">Tăng dần</option>
                <option value="0">Giảm dần</option>
            </select>
        </div>
        </form>
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
            @foreach($permission as $list)
                <tr>
                    <td>{{$list->id}}</td>
                    <td>{{$list->name}}</td> 
                    <td>{{$list->display_name}}</td> 
                    <td>
                            @foreach(\App\Models\Permission::where('name',$list->name)->get() as $val)
                            {{$val->parent_id}}
                            @endforeach
                    </td> 
                    <td class="d-flex">
                        <a href="{{ route('permission.edit',$list->id)}}" class="btn btn-sm btn-primary mr-4">Sửa</a> 
                        <a href="javascript:;" wire:click="destroy({{$list->id}})" class="text-danger">Xóa</a>
                            
                    </td>
                </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div> 
    <div class="box-footer d-flex">
            <select wire:model="perPage" class="form-control mr-4" style="width:30%">
                <option selected>10</option>
                <option>15</option>
                <option>20</option>
            </select>
            {{ $permission->links() }}
        </div>
</div>
  <!--Row-->
</div>