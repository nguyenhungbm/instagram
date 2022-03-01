<div class="container-fluid" id="container-wrapper">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Người dùng</h1>
</div>
<div class="row">
    <div class="col-lg-12 mb-4">
        <!-- Simple Tables -->
        <div class="card"> 
        <div class="table-responsive">
        <form class="row g-3">
        <div class="col-auto">
            <input wire:model="search" type="search" class="form-control" id="inputPassword2" placeholder="Search">
        </div>   
        <div class="col-auto">
            <select wire:model="orderBy" class="form-control mr-4">
                <option value="id">Id</option>
                <option value="c_name">Tên</option>
                <option value="phone">Số điện thoại</option>
                <option value="email">Email</option>
            </select>
        </div>
        <div class="col-auto">
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
                <th>Name</th>
                <th>Số điện thoại</th>
                <th>Email</th> 
                <th>Liên kết</th>
                <th>Trạng thái</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($user as $key => $list)
                    <tr>
                    <td>{{ ++$key }}</td>
                        <td><a href="{{route('get.home-page', $list->user)}}">{{ $list->c_name}}</a></td>
                        <td>{{ $list->phone ?? 'Không có'}}</td>
                        <td>{{ $list->email}}</td>
                        <td>{{ $list->provider ?? 'Trực tiếp'}}</td>
                        <td>
                        @if($list->is_active==0)
                            <span>Chưa kích hoạt</span>
                        @elseif($list->is_active==1)
                            <a href="javascript:;" wire:click="block_user({{$list->id}})">Đã kích hoạt</a>
                        @else
                            <a href="javascript:;"  class="text-danger" wire:click="block_user({{$list->id}})">Đã bị khóa</a>
                        @endif
                        </td>  
                        <td>
                        <a href="javascript:;" wire:click="delete({{$list->id}})" class="text-danger">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
                    
        </div><br>
        <div class="box-footer d-flex">
            <select wire:model="perPage" class="form-control mr-4" style="width:7%">
                <option>10</option>
                <option>15</option>
                <option>20</option>
            </select>
            {{ $user->links() }}
        </div>
    </div>
    </div>
    <!--Row-->
</div>