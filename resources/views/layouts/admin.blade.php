<?php
$dash_menu = isset($dash_menu) ? 'active' : '';
$notif_menu = isset($notif_menu) ? 'active' : '';
$job_fam_menu = isset($job_fam_menu) ? 'active' : '';
$regions_menu = isset($regions_menu) ? 'active' : '';
$slides_menu = isset($slides_menu) ? 'active' : '';
$events_menu = isset($events_menu) ? 'active' : '';
$announcements_menu = isset($announcements_menu) ? 'active' : '';
$meet_menu = isset($meet_menu) ? 'active' : '';
$live_menu = isset($live_menu) ? 'active' : '';
$birthday_menu = isset($birthday_menu) ? 'active' : '';
$assess_menu = isset($assess_menu) ? 'active' : '';
$post_menu = isset($post_menu) ? 'active' : '';
$forum_menu = isset($forum_menu) ? 'active' : '';
$resource_menu = isset($resource_menu) ? 'active' : '';
$staff_menu = isset($staff_menu) ? 'active' : '';
$dept_menu = isset($dept_menu) ? 'active' : '';
$director_menu = isset($director_menu) ? 'active' : '';
$enrollments_menu = isset($enrollments_menu) ? 'active' : '';
$analytics_menu = isset($analytics_menu) ? 'active' : '';
$video_menu = isset($video_menu) ? 'active' : '';
$stream_menu = isset($stream_menu) ? 'active' : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$page_title}} .:. LWSP Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('admin_assets/css/adminlte.min.css')}}">

    @yield('style')
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>


        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user-circle"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">{{session('admin')->name}}</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-key mr-2"></i> Security Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{route('logout')}}" class="dropdown-item dropdown-footer">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{route('adminDashboard')}}" class="brand-link">
            <img src="{{url('images/logo.png')}}" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">LW Staff Portal Admin</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{url('images/default.png')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{session('admin')->name}}</a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{route('adminDashboard')}}" class="nav-link {{$dash_menu}}">
                            <i class="nav-icon fa fa-tachometer"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas nav-icon fa fa-users"></i>
                            <p>
                                Staff management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="{{route('staff.index')}}" class="nav-link {{$staff_menu}}">
                                    <i class="fa fa-users nav-icon"></i>
                                    <p> Staff Members</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('birthdays')}}" class="nav-link {{$birthday_menu}}">
                                    <i class="fas fa-birthday-cake nav-icon"></i>
                                    <p>Staff Birthdays</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('staff.deptHeads')}}" class="nav-link {{$dept_menu}}">
                                    <i class="fas fa-person-chalkboard nav-icon"></i>
                                    <p>Departmental Heads</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('staff.directors')}}" class="nav-link {{$director_menu}}">
                                    <i class="fas fa-person-military-pointing nav-icon"></i>
                                    <p>Directors</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('regions.index')}}" class="nav-link {{$regions_menu}}">
                            <i class="nav-icon fa fa-globe"></i>
                            <p>
                                Regions
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('meetings.index')}}" class="nav-link {{$meet_menu}}">
                            <i class="nav-icon fa fa-tv"></i>
                            <p>
                                Live Meetings
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('streams.index')}}" class="nav-link {{$stream_menu}}">
                            <i class="nav-icon fa fa-play"></i>
                            <p>
                                Stream Links
                            </p>
                        </a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('interactions.index')}}" class="nav-link {{$live_menu}}">--}}
{{--                            <i class="nav-icon fa fa-blog"></i>--}}
{{--                            <p>--}}
{{--                                Live Interactions--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}

{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('events.index')}}" class="nav-link {{$events_menu}}">--}}
{{--                            <i class="nav-icon fa fa-tasks"></i>--}}
{{--                            <p>--}}
{{--                                Events--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}

{{--                    <li class="nav-item">--}}
{{--                        <a href="#" class="nav-link">--}}
{{--                            <i class="nav-icon fas nav-icon fa fa-book"></i>--}}
{{--                            <p>--}}
{{--                                Course Management--}}
{{--                                <i class="right fas fa-angle-left"></i>--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                        <ul class="nav nav-treeview" style="display: none;">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('courses.index')}}" class="nav-link {{$courses_menu}}">--}}
{{--                                    <i class="fas fa-book nav-icon"></i>--}}
{{--                                    <p> Courses</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('enrollments.index')}}" class="nav-link {{$enrollments_menu}}">--}}
{{--                                    <i class="fas fa-graduation-cap nav-icon"></i>--}}
{{--                                    <p>Course Enrollment</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('assessment.index')}}" class="nav-link {{$assess_menu}}">--}}
{{--                                    <i class="fas fa-pen-nib nav-icon"></i>--}}
{{--                                    <p>Assessments</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}

{{--                        </ul>--}}
{{--                    </li>--}}


{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('posts.index')}}" class="nav-link {{$post_menu}}">--}}
{{--                            <i class="nav-icon fa fa-scroll"></i>--}}
{{--                            <p>--}}
{{--                                Blog--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}

                    <li class="nav-item">
                        <a href="{{route('jobFamily.index')}}" class="nav-link {{$job_fam_menu}}">
                            <i class="nav-icon fa fa-people-roof"></i>
                            <p>
                                Job Families
                            </p>
                        </a>
                    </li>



{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('resources.index')}}" class="nav-link {{$resource_menu}}">--}}
{{--                            <i class="nav-icon fa fa-sitemap"></i>--}}
{{--                            <p>--}}
{{--                                Resource Center--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}

{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('forums.create')}}" class="nav-link {{$forum_menu}}">--}}
{{--                            <i class="nav-icon fa fa-commenting"></i>--}}
{{--                            <p>--}}
{{--                                Forums--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}

                    <li class="nav-item">
                        <a href="{{route('slides.index')}}" class="nav-link {{$slides_menu}}">
                            <i class="nav-icon fa fa-image"></i>
                            <p>
                                Slides
                            </p>
                        </a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('videos.index')}}" class="nav-link {{$video_menu}}">--}}
{{--                            <i class="nav-icon fa fa-video"></i>--}}
{{--                            <p>--}}
{{--                                Video Sliders--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="" class="nav-link {{$announcements_menu}}">--}}
{{--                            <i class="nav-icon fa fa-bullhorn"></i>--}}
{{--                            <p>--}}
{{--                                Announcements--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('analytics.index')}}" class="nav-link {{$analytics_menu}}">--}}
{{--                            <i class="nav-icon fa fa-chart-bar"></i>--}}
{{--                            <p>--}}
{{--                                Analytics--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('adminNotification')}}" class="nav-link {{$notif_menu}}">--}}
{{--                            <i class="nav-icon fa fa-signal"></i>--}}
{{--                            <p>--}}
{{--                                Push Notification--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{$page_title}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
                            <li class="breadcrumb-item active">{{$page_title}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        @if(session('message'))
                            <div class="alert alert-info dismissAlert">{{session('message')}}</div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger dismissAlert">{{session('error')}}</div>
                        @endif
                    </div>
                </div>
                @yield('content')
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.0
        </div>
        <strong> &copy; {{date('Y')}} <a href="{{url('')}}"> LW STAFF PORTAL</a></strong>
    </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.bundle.min.js" integrity="sha512-mULnawDVcCnsk9a4aG1QLZZ6rcce/jSzEGqUkeOLy0b6q0+T6syHrxlsAGH7ZVoqC93Pd0lBqd6WguPWih7VHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- AdminLTE App -->
<script src="{{url('admin_assets/js/adminlte.min.js')}}"></script>

<script>
    let dismissAlert = $('.dismissAlert');
    if(dismissAlert){
        setTimeout(function(){
            dismissAlert.hide(500);
        }, 3000);
    }
</script>


@yield('script')
</body>
</html>
