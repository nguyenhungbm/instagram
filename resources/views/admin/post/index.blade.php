@extends('admin.layout')
@section('content') 
<style>
a{text-decoration:none}</style>
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Bài viết</h1>
          </div>

          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>ID</th>
                        <th>Bài viết</th> 
                        <th>Hình ảnh</th> 
                        <th>Người đăng</th>
                        <th>Thông tin</th>
                        <th>Thời gian đăng</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                       
                      @foreach($post as $list)
                      <tr>
                        <td>{{$list->id}}</td>
                        <td><a target="blank" href="{{ route('post.view',$list->p_slug) }}">{{$list->p_content}}</a></td> 
                        <td><a target="blank" href="{{ route('post.view',$list->p_slug) }}"><img src="{{ pare_url_file($list->p_image,$list->p_type)}}" style="width:100px;height:100px;object-fit:cover"></a></td> 
                        <td><a target="blank" href="{{ route('get.home-page',$list->user)}}">{{$list->c_name}}</a></td>
                        <td>
                        <i class="fa fa-lg fa-eye"></i>{{$list->p_view}}
                        <i class="fa fa-lg fa-heart"></i>{{$list->p_favourite}}
                        <i class="fa fa-lg fa-comments"></i>{{$list->p_comment}}
                        </td>
                        <td>{{$list->created_at}}</td>
                        <td>
                        <a href="{{ route('admin.post.delete',$list->id)}}" class="btn btn-sm btn-danger">Xoá</a></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="box-footer">
                  {{ $post->links() }}
                  </div>
              </div>
            </div>
          </div>
          <!--Row-->
 

        </div>
@endsection