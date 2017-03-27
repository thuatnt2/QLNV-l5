<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BP3-QB</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ URL::asset('css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ URL::asset('css/_all-skins.min.css') }}">
    
    {{-- Select2 --}}
    <link rel="stylesheet" href="{{ URL::asset('css/plugins/select2.min.css') }}">
    @yield('css')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="#" class="navbar-brand"><b>&nbsp;</b>&nbsp;</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/') }}"><i class="fa fa-home fa-lg"></i></a></li>
                        <li class="dropdown">
                            <a href="{{ url('orders') }}">Đăng ký&nbsp;&nbsp;</a>
                            
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Giao yêu cầu&nbsp;&nbsp;<span class="fa fa-caret-down"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('ship/news') }}">Giao tin</a></li>
                                <li><a href="{{ url('ship/list') }}">List</a></li>
                                <li><a href="{{ url('ship/xmctb') }}">XMCTB</a></li>
                                <li><a href="{{ url('ship/imei') }}">Quét Imei</a></li>
                             </ul>
                        </li>
                        {{-- <li ><a href="{{ url('statistics') }}">Thống kê</a></li> --}}
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Thống kê&nbsp;&nbsp;<span class="fa fa-caret-down"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('statistics-report') }}">Báo cáo Tuần/Tháng</a></li>
                                <li><a href="{{ url('statistics-action') }}">Số TB đang thực hiện</a></li>
                                <li><a href="{{ url('statistics-unit') }}">Theo từng đơn vị</a></li>
                                <li><a href="{{ url('statistics-advance') }}">Nâng cao</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Cấu hình&nbsp;&nbsp;<span class="fa fa-caret-down"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('register') }}">Người dùng</a></li>
                                <li><a href="{{ url('manager') }}">Phân công giám sát</a></li>
                                <li><a href="{{ url('units') }}">Đơn vị yêu cầu</a></li>
                                <li><a href="{{ url('categories') }}">Loại đối tượng</a></li>
                                <li><a href="{{ url('kinds') }}">Tính chất đối tượng</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <select class="form-control" id="search" allowClear="disable" data-placeholder="Tìm kiếm...." data-ajax--url="{{ route('search') }}" data-ajax--cache="true" style="-webkit-appearance: none;-moz-appearance: none;"></select>
                        </div>
                    </form>
                </div><!-- /.navbar-collapse -->


                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="{{URL::asset('img/avatar.png')}}" class="user-image" alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{{ Auth::user()->username }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="{{URL::asset('img/avatar.png')}}" class="img-circle" alt="User Image">
                                    <p>
                                        {{ Auth::user()->fullname }}
                                        <small>Member {{ Auth::user()->created_at->format('d/m/Y') }}</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ route('user.show', Auth::user()->id) }}" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ url('logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                    <div class="pull-right" style="margin-right: 10px">
                                        <a href="{{ route('user.edit', Auth::user()->id) }}" class="btn btn-default btn-flat">Change pass</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-custom-menu -->
            </div><!-- /.container-fluid -->
        </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>

        </div><!-- /.container-fluid -->
    </div><!-- /.content-wrapper -->

</div><!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src="{{ URL::asset('js/jQuery-2.1.4.min.js') }}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
{{-- Select2 4.0.1 --}}
<script src="{{ URL::asset('js/plugins/select2.min.js') }}"></script>
{{-- Table sorter --}}
<script src="{{ URL::asset('js/plugins/jquery.tablesorter.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $("#sortTable").tablesorter();
    }
    );
</script>
@yield('javascript')
</body>
</html>
