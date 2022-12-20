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
                            <th>STT</th>
                            <th>Bài viết</th>
                            <th>Hình ảnh</th>
                            <th>Người đăng</th>
                            <th>Thông tin</th>
                            <th>Thời gian đăng</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($post as $key => $list)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td><a target="blank"
                                       href="{{ route('post.view', $list->p_slug) }}">{{$list->p_content}}</a></td>
                                <td><a target="blank" href="{{ route('post.view', $list->p_slug) }}"><img
                                                src="{{ pare_url_file($list->p_image, 'profile/img_small') }}"
                                                style="width:100px;height:100px;object-fit:cover"></a></td>
                                <td><a target="blank"
                                       href="{{ route('get.home-page', $list->user)}}">{{$list->c_name}}</a></td>
                                <td>
                                    <i class="fa fa-eye"></i>{{$list->p_view}}
                                    <i class="fa fa-heart"></i>{{$list->p_favourite}}
                                    <i class="fa fa-comments"></i>{{$list->p_comment}}
                                </td>
                                <td>{{$list->created_at}}</td>
                                <td>
                                    <a href="javascript:" wire:click="destroy({{$list->id}})"
                                       class="text-danger">Xoá</a>
                                </td>
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