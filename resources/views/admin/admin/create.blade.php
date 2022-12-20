@extends('admin.layout')
@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Thêm quản trị viên</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Tên</label>
                        <input type="text" class="form-control" name="name" id="exampleFormControlInput2">
                        @if($errors->first('name'))
                            <span class="text-danger">{{$errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email</label>
                        <input type="text" name="email" class="form-control" id="exampleFormControlInput1"
                               placeholder="name@example.com">
                        @if($errors->first('email'))
                            <span class="text-danger">{{$errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput3">Mật khẩu</label>
                        <input type="password" class="form-control" name="password" id="exampleFormControlInput3">
                        @if($errors->first('password'))
                            <span class="text-danger">{{$errors->first('password') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput3">Vai trò</label>
                        <select class="multiple form-control" name="roles[]" multiple="multiple"
                                placeholder="Chọn vai trò">
                            @foreach($role as $list)
                                <option value="{{ $list->id}}">{{ $list->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->first('roles'))
                            <span class="text-danger">{{$errors->first('roles') }}</span>
                        @endif
                    </div>
                    <button class="btn btn-primary">Thêm quản trị viên</button>
                </form>
            </div>
        </div>
    </div>
@endsection