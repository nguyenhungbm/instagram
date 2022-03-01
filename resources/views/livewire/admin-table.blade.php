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
                <th>STT</th>
                <th>Admin</th>
                <th>Email</th> 
                <th>Vai trò</th> 
                <th>Hành động</th>
              </tr>
            </thead>
            <tbody>
              @foreach($admin as $key => $list)
                <tr>
                  <td>{{ ++$key }}</td>
                  <td>{{ $list->name}}</td>
                  <td>{{ $list->email}}</td>
                  <td>
                    @foreach($list->roles as $val)
                      <a class="btn btn-success text-light" style="cursor:pointer"> {{$val->name}}</a>
                    @endforeach
                  </td>
                  <td class="d-flex">
                    <a data-title="Cảnh báo !" href="{{ route('admin.edit', $list->id)}}" class="btn btn-sm btn-primary mr-4 twitter">Cập nhật</a>
                    
                    <form action="{{ route('admin.destroy', $list->id)}}" method="post">
                      @method('DELETE')
                      @csrf
                      <button class="twitter btn btn-sm btn-danger">Xoá</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div> 
    <div class="box-footer d-flex">
            <select wire:model="perPage" class="form-control mr-4" style="width:20%">
                <option selected>10</option>
                <option>15</option>
                <option>20</option>
            </select>
            {{ $admin->links() }}
        </div>
</div>
  <!--Row-->
</div>