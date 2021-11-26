@extends('admin.layout')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Cập nhật quyền hạn</h6>
        </div>
        <div class="card-body">
            <form  action="{{ route('permission.update',$permission->id)}}" method="post">
            @method('PUT')
            @csrf
            @php
                $per = explode("-", $permission->name);
            @endphp     
            <div class="form-group">
                <label for="fe">Tên quyền hạn</label>
                <input type="text" class="form-control" name="name" id="fe" value="{{$per[0]}}" >
              
                @if($errors->first('name'))    
                    <span class="text-danger">{{$errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput2">Mô tả quyền hạn</label>
                <input type="text" class="form-control" name="display_name" id="exampleFormControlInput2" value="{{$permission->display_name}}"  >
                @if($errors->first('display_name'))    
                    <span class="text-danger">{{$errors->first('display_name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput2">Quyền hạn cha</label>
                <select name="parent_id[]" class="multiple form-control" multiple=""> 
                    @foreach($all_permission as $list)
                    @if(empty($list->parent_id) && $list->id !=$permission->id)
                        <option value="{{$list->id}}" {{in_array($list->id,$parent_permission) ? "selected='selected'" : '' }}>{{$list->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary">Thêm quyền hạn</button>
        </form>
    </div>
</div>
</div>
@endsection