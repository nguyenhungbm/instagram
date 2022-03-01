@extends('admin.layout')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Cập nhật quyền hạn</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('role.update', $role->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleFormControlInput2">Tên quyền hạn</label>
                    <input type="text" class="form-control" value="{{ $role->name}}" name="name"
                        id="exampleFormControlInput2">
                    @if($errors->first('name'))
                    <span class="text-danger">{{$errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput2">Mô tả quyền hạn</label>
                    <input type="text" class="form-control" value="{{ $role->display_name}}" name="display_name"
                        id="exampleFormControlInput2">
                    @if($errors->first('display_name'))
                    <span class="text-danger">{{$errors->first('display_name') }}</span>
                    @endif
                </div>
                <div class="card-body text-primary col-md-3">
                    <h5 class="card-title">
                        <input type="checkbox" id="de" name="" value="" class="checkbox_all">
                        <label for="de">Thêm tất cả quyền</label>
                    </h5>
                </div>
                <div class="card-body">
                    @foreach($permissionParent as $list)
                    <div class="card border-primary mb-3 col-md-12  ">
                        <div class="card-header ">
                            <input type="checkbox" name="" id="fe" value="" class="checkbox_parent">
                            <label for="fe">{{$list->name}}</label>
                            <hr>
                        </div>
                        <div class="row">
                            @foreach(\App\Models\Permission::where('parent_id', $list->id)->get() as $val)
                            @php
                            $per = explode("-", $val->name);
                            @endphp
                            <div class="card-body text-primary col-md-3">
                                <h5 class="card-title">
                                    <input type="checkbox" id="{{$val->id}}" name="permission_id[]"
                                        {{$permissionChecked->contains('id', $val->id) ?'checked':''}}
                                        value="{{$val->id}}" class="checkbox_children">
                                    <label for="{{$val->id}}">{{$per[0]}} </label>
                                </h5>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                    <button class="btn btn-primary">Cập nhật quyền hạn</button>
            </form>
        </div>
    </div>
</div>
@endsection