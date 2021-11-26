<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('favicon.ico')}}" rel="icon">
    <title>{{ $title ?? "Admin"}}</title>
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/css/ruang-admin.min.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <style>
        a{text-decoration:none}
    </style>
    @livewireStyles
</head>
<body id="page-top">
    <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home.index')}}" style="background:white">
            <div class="sidebar-brand-icon">
            <img src="{{ asset('img/logo.png')}}">
            </div>
        </a>
        <hr class="sidebar-divider my-0">
        <div class="sidebar-heading">
                Features
        </div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.index')}}">
            <i class="far fa-user"></i>
            <span>Admin</span>
            </a> 
        </li>
            
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.user')}}">
            <i class="fas fa-fw fa-palette"></i>
            <span>Nguời dùng</span>
            </a> 
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true"
                aria-controls="collapseTable">
            <i class="fas fa-fw fa-table"></i>
            <span>Quyền hạn</span>
            </a>
            <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('permission.index')}}">Quyền hạn chung</a>
                <a class="collapse-item" href="{{ route('role.index')}}">Phân quyền</a>
            </div>
            </div>
        </li> 
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
                Other
        </div>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('post.index')}}">
            <i class="fas fa-fw fa-columns"></i>
            <span>Post</span>
            </a> 
        </li>
        <hr class="sidebar-divider">
        <div class="version" id="version-ruangadmin"></div>
    </ul>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <!-- TopBar -->
            <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
            <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
            </button>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                            aria-labelledby="searchDropdown">
                        <form class="navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-1 small" placeholder="What do you want to look for?"
                                    aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <span class="badge badge-danger badge-counter">3+</span>
                    </a>
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Alerts Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">December 12, 2019</div>
                            <span class="font-weight-bold">A new monthly report is ready to download!</span>
                        </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-success">
                                <i class="fas fa-donate text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">December 7, 2019</div>
                                $290.29 has been deposited into your account!
                        </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-warning">
                                <i class="fas fa-exclamation-triangle text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">December 2, 2019</div>
                                Spending Alert: We've noticed unusually high spending for your account.
                        </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                    </div>
                </li>
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-envelope fa-fw"></i>
                    <span class="badge badge-warning badge-counter">2</span>
                    </a>
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                            Message Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="{{ asset('admin/img/man.png')}}" style="max-width: 60px" alt="">
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div class="font-weight-bold">
                            <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been
                                    having.
                            </div>
                            <div class="small text-gray-500">Udin Cilok · 58m</div>
                        </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="{{ asset('admin/img/girl.png')}}" style="max-width: 60px" alt="">
                            <div class="status-indicator bg-default"></div>
                        </div>
                        <div>
                            <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people
                                    say this to all dogs, even if they aren't good...
                            </div>
                            <div class="small text-gray-500">Jaenab · 2w</div>
                        </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                    </div>
                </li>
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-tasks fa-fw"></i>
                    <span class="badge badge-success badge-counter">3</span>
                    </a>
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                            Task
                        </h6>
                        <a class="dropdown-item align-items-center" href="#">
                        <div class="mb-3">
                            <div class="small text-gray-500">
                                    Design Button
                                <div class="small float-right"><b>50%</b></div>
                            </div>
                            <div class="progress" style="height: 12px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        </a>
                        <a class="dropdown-item align-items-center" href="#">
                        <div class="mb-3">
                            <div class="small text-gray-500">
                                    Make Beautiful Transitions
                                <div class="small float-right"><b>30%</b></div>
                            </div>
                            <div class="progress" style="height: 12px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        </a>
                        <a class="dropdown-item align-items-center" href="#">
                        <div class="mb-3">
                            <div class="small text-gray-500">
                                    Create Pie Chart
                                <div class="small float-right"><b>75%</b></div>
                            </div>
                            <div class="progress" style="height: 12px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">View All Taks</a>
                    </div>
                </li>
                <div class="topbar-divider d-none d-sm-block"></div>
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                    <img class="img-profile rounded-circle" src="{{ asset('admin/img/girl.png')}}" style="max-width: 60px">
                    <span class="ml-2 d-none d-lg-inline text-white small">{{ \Auth::guard('admins')->user()->name}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>
                        <a class="dropdown-item" href="#">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
            </nav>
                @yield('content')
            <!-- Modal Logout -->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
                aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to logout?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                        <a href="{{ route('get.logout.admin')}}" class="btn btn-primary">Logout</a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
    </a>
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('admin/js/ruang-admin.min.js')}}"></script>
    <script src="{{ asset('admin/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{ asset('admin/js/demo/chart-area-demo.js')}}"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script>
            $('a.twitter').confirm({
            content: "Bạn có muốn thay đổi thông tin admin không ? ",
            });
            $('a.twitter').confirm({
            buttons: {
                hey: function(){
                    location.href = this.$target.attr('href');
                }
            }
            }); 
            $(document).ready(function() { 
                $('.multiple').select2({
                    placeholder:'Có thể để trống',
                }); 
            });
            
    $('.checkbox_parent').on('click',function(){
        $(this).parents('.col-md-12').find('.checkbox_children').prop('checked',$(this).prop('checked'));
    })
    $('.checkbox_all').on('click',function(){
        $(this).parents('form').find('input').prop('checked',$(this).prop('checked'));
    })
    
    </script>
       @livewireScripts
</body>
</html>