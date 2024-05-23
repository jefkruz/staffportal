<?php
$dash_menu = (isset($dash_menu) && $dash_menu == true) ? 'active' : '';
$profile_menu = (isset($profile_menu) && $profile_menu == true) ? 'active' : '';
$meet_menu = (isset($meet_menu) && $meet_menu == true) ? 'active' : '';
$live_menu = (isset($live_menu) && $live_menu == true) ? 'active' : '';
$videos_menu = (isset($videos_menu) && $videos_menu == true) ? 'active' : '';
$back = (isset($back) && $back == true) ? 'true' : '';
$isDirector = session('user')->isDirector();
$isDeptHead = session('user')->isDepartmentHead();
?>
<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
          content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>{{$page_title}}</title>
    <meta name="description" content="LW Staff Portal">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <meta name="keywords" content="{{$page_title}} ,staff portal, blw staff portal, staff portal" />
    <link rel="icon" type="image/png" href="{{url('favicon.png')}}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{url('assets/img/icon/192x192.png')}}">
    <!-- BOOTSTRAP CSS -->

    @yield('styles')

    <link id="style" href="{{url('assets/css/bootstrap.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
    <link rel="manifest" href="{{url('__manifest.json')}}">
</head>

    <body>

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
<!-- * loader -->

    <!-- App Header -->
    <div class="appHeader bg-primary scrolled">
        @if($back==true)
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        @else

        <div class="left">
            <a href="#" class="headerButton" data-bs-toggle="offcanvas" data-bs-target="#sidebarPanel">
                <ion-icon name="menu-outline"></ion-icon>
            </a>
        </div>
        @endif
        <div class="pageTitle">
            {{ucwords($page_title)}}
        </div>
        <div class="right">
            <a href="#" class="headerButton toggle-searchbox">
                <ion-icon name="search-outline"></ion-icon>
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- Search Component -->
    <div id="search" class="appHeader">
        <form class="search-form">
            @csrf
            <div class="form-group searchbox">
                <input type="text" class="form-control" placeholder="Search...">
                <i class="input-icon">
                    <ion-icon name="search-outline"></ion-icon>
                </i>
                <a href="#" class="ms-1 close toggle-searchbox">
                    <ion-icon name="close-circle"></ion-icon>
                </a>
            </div>
        </form>
    </div>
    <!-- * Search Component -->


    @yield('content')


        <!-- App Sidebar -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarPanel">
            <div class="offcanvas-body">
                <!-- profile box -->
                <div class="profileBox">
                    <div class="image-wrapper">
                        <img src="{{url(Session::get('user')->picturePath)}}" alt="image" class="imaged rounded">
                    </div>
                    <div class="in">
                        <strong>{{ucwords(Session::get('user')->fullname())}}</strong>
                        <div class="text-muted">
                            {{--                        <ion-icon name="location"></ion-icon>--}}
                            {{ucwords(Session::get('user')->department->deptName)}}
                        </div>
                    </div>
                    <a href="#" class="close-sidebar-button" data-bs-dismiss="offcanvas">
                        <ion-icon name="close"></ion-icon>
                    </a>
                </div>
                <!-- * profile box -->

                <ul class="listview flush transparent no-line image-listview mt-2 mb-2">
                    <br>
                    <li>
                        <a href="{{route('home')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="home-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Home
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('profile')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="person-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Profile
                            </div>
                        </a>
                    </li>


                    <li>
                        <a href="{{route('posts')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="megaphone-outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Information Center</div>
                                {{--                            <span class="badge badge-danger">5</span>--}}
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('meetings')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="film-outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Live Meetings</div>
                            </div>

                        </a>
                    </li>
                    <li>
                        <a href="{{route('videos')}}" class="item" >
                            <div class="icon-box bg-primary">
                                <ion-icon name="play-circle-outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Videos</div>
                            </div>

                        </a>
                    </li>
                    <li>
                        <a href="{{route('stdl')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="newspaper-outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>STDL</div>
                                {{--                            <span class="badge badge-danger">5</span>--}}
                            </div>

                        </a>
                    </li>

                    <li>
                        <div class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="moon-outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Dark Mode</div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input dark-mode-switch" type="checkbox" id="darkmodesidebar">
                                    <label class="form-check-label" for="darkmodesidebar"></label>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="{{route('logout')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="log-out-outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Log out</div>
                                {{--                            <span class="badge badge-danger">5</span>--}}
                            </div>
                        </a>
                    </li>
                </ul>



            </div>
            <!-- sidebar buttons -->
            <div class="sidebar-buttons">
                {{--            <a href="#" class="button">--}}
                {{--                <ion-icon name="person-outline"></ion-icon>--}}
                {{--            </a>--}}
                {{--            <a href="#" class="button">--}}
                {{--                <ion-icon name="archive-outline"></ion-icon>--}}
                {{--            </a>--}}
                {{--            <a href="#" class="button">--}}
                {{--                <ion-icon name="settings-outline"></ion-icon>--}}
                {{--            </a>--}}
                {{--            <a href="{{route('logout')}}" class="button">--}}
                {{--                <ion-icon name="log-out-outline"></ion-icon>--}}
                {{--            </a>--}}
            </div>
            <!-- * sidebar buttons -->
        </div>
        <!-- * App Sidebar -->



        <!-- App Bottom Menu -->
        <div class="appBottomMenu d-lg-none  infinite-menu" >
            <a href="{{route('home')}}" class="item {{$dash_menu}}">
                <div class="col">
                    <ion-icon name="home-outline"></ion-icon>
                    <strong>Home</strong>
                </div>
            </a>
            <a href="{{route('posts')}}" class="item">
                <div class="col">
                    <ion-icon name="megaphone-outline"></ion-icon>
                    <strong>Info</strong>
                </div>
            </a>
            <a href="{{route('meetings')}}" class="item" {{$meet_menu}}>
                <div class="col">
                    <ion-icon name="film-outline"></ion-icon>
                    <strong>live</strong>
                </div>
            </a>
            <a href="{{route('profile')}}" class="item {{$profile_menu}}" >
                <div class="col">
                    <ion-icon name="person-outline"></ion-icon>
                    <strong>Profile</strong>
                </div>
            </a>
            {{--        <a href="#" class="item" {{$meet_menu}}>--}}
            {{--            <div class="col">--}}
            {{--                <ion-icon name="tv-outline"></ion-icon>--}}
            {{--                <strong>BE TV</strong>--}}
            {{--            </div>--}}
            {{--        </a>--}}

            <a href="{{route('videos')}}" class="item" {{$videos_menu}}>
                <div class="col">
                    <ion-icon name="play-circle-outline"></ion-icon>
                    <strong>videos</strong>
                </div>
            </a>
            <a href="{{route('stdl')}}" class="item">
                <div class="col">
                    <ion-icon name="newspaper-outline"></ion-icon>
                    <strong>STDL</strong>
                </div>
            </a>

            <a href="#sidebarPanel" class="item" data-bs-toggle="offcanvas">
                <div class="col">
                    <ion-icon name="menu-outline"></ion-icon>
                    <strong>Menu</strong>
                </div>
            </a>
        </div>
        <!-- * App Bottom Menu -->

{{--    @endif--}}




    <!-- Bootstrap -->
{{--<script src="{{url('assets/js/lib/bootstrap.min.js')}}"></script>--}}
    <!-- JQUERY JS -->
    <script src="{{url('assets/js/jquery.min.js')}}"></script>

    <script src="{{url('assets/js/popper.min.js')}}"></script>
    <script src="{{url('assets/js/bootstrap.js')}}"></script>

@yield('scripts')

    <script>
        (function(global){
            global.$_Tawk_AccountKey='65d8b72d8d261e1b5f647fb9';
            global.$_Tawk_WidgetId='1hnb8n349';
            global.$_Tawk_Unstable=false;
            global.$_Tawk = global.$_Tawk || {};
            (function (w){
                function l() {
                    if (window.$_Tawk.init !== undefined) {
                        return;
                    }

                    window.$_Tawk.init = true;

                    var files = [
                        'https://embed.tawk.to/_s/v4/app/65cc2ba794a/js/twk-main.js',
                        'https://embed.tawk.to/_s/v4/app/65cc2ba794a/js/twk-vendor.js',
                        'https://embed.tawk.to/_s/v4/app/65cc2ba794a/js/twk-chunk-vendors.js',
                        'https://embed.tawk.to/_s/v4/app/65cc2ba794a/js/twk-chunk-common.js',
                        'https://embed.tawk.to/_s/v4/app/65cc2ba794a/js/twk-runtime.js',
                        'https://embed.tawk.to/_s/v4/app/65cc2ba794a/js/twk-app.js'
                    ];

                    if (typeof Promise === 'undefined') {
                        files.unshift('https://embed.tawk.to/_s/v4/app/65cc2ba794a/js/twk-promise-polyfill.js');
                    }

                    if (typeof Symbol === 'undefined' || typeof Symbol.iterator === 'undefined') {
                        files.unshift('https://embed.tawk.to/_s/v4/app/65cc2ba794a/js/twk-iterator-polyfill.js');
                    }

                    if (typeof Object.entries === 'undefined') {
                        files.unshift('https://embed.tawk.to/_s/v4/app/65cc2ba794a/js/twk-entries-polyfill.js');
                    }

                    if (!window.crypto) {
                        window.crypto = window.msCrypto;
                    }

                    if (typeof Event !== 'function') {
                        files.unshift('https://embed.tawk.to/_s/v4/app/65cc2ba794a/js/twk-event-polyfill.js');
                    }

                    if (!Object.values) {
                        files.unshift('https://embed.tawk.to/_s/v4/app/65cc2ba794a/js/twk-object-values-polyfill.js');
                    }

                    if (typeof Array.prototype.find === 'undefined') {
                        files.unshift('https://embed.tawk.to/_s/v4/app/65cc2ba794a/js/twk-arr-find-polyfill.js');
                    }

                    var s0=document.getElementsByTagName('script')[0];

                    for (var i = 0; i < files.length; i++) {
                        var s1 = document.createElement('script');
                        s1.src= files[i];
                        s1.charset='UTF-8';
                        s1.setAttribute('crossorigin','*');
                        s0.parentNode.insertBefore(s1,s0);
                    }
                }
                if (document.readyState === 'complete') {
                    l();
                } else if (w.attachEvent) {
                    w.attachEvent('onload', l);
                } else {
                    w.addEventListener('load', l, false);
                }
            })(window);

        })(window);
        $(function(){
            $("video[controlsList='nodownload']").bind("contextmenu", function(){
                return false;
            });
        });
    </script>
    <!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<!-- Splide -->
<script src="{{url('assets/js/plugins/splide/splide.min.js')}}"></script>
<!-- ProgressBar js -->
<script src="{{url('assets/js/plugins/progressbar-js/progressbar.min.js')}}"></script>
<!-- Base Js File -->
<script src="{{url('assets/js/base.js')}}"></script>

</body>

</html>
