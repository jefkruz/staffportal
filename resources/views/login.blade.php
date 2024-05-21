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
    <link id="style" href="{{url('assets/css/bootstrap.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
    <link rel="manifest" href="{{url('__manifest.json')}}">
</head>


<body class="bg-white">

        <!-- loader -->
        <div id="loader">
            <div class="spinner-border text-primary" role="status"></div>
        </div>
        <!-- * loader -->


        <!-- App Capsule -->
        <div id="appCapsule" class="pt-0">

            <div class="login-form mt-1">
                <div class="section">
                    <img src="{{url('assets/img/login.png')}}" alt="image" class="form-image">
                </div>
                <div class="section mt-1">
                    <h1>Welcome to LW Staff Portal</h1>
{{--                    <h4>Please put in your credentials to log in</h4>--}}
                </div>
                <div class="section mt-1 mb-5">
                    <form method="POST">
                        @csrf
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <input type="text" class="form-control" name="portal_id" required placeholder="Portal ID">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">

                                <input type="password" class="form-control" name="password"  required placeholder="Password" >
                                <i class="clear-input">
                                    <i class="ion ion-md-lock"></i>
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-links mt-2 float-end ">

                            <div><a href="#" class="text-muted">Forgot Password?</a></div>
                        </div>

                        <br>
                        <div class="button-group">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Log in</button>
                        </div>


                        <div class="form-button-group ">
                            <a  target="_blank" href="https://accounts.kingsch.at/?client_id=com.kingschat&scopes=[%22conference_calls%22]&post_redirect=true&redirect_uri={{route('authLogin')}}" class="btn btn-outline-primary btn-lg btn-block">
                                <img src="https://kingsch.at/h/css/images/favicon.ico" alt="" class="img-fluid">
                                    Login with KingsChat
                          </a>                        </div>

                            </form>
                        </div>
                    </div>


                </div>
                <!-- * App Capsule -->

        <!-- Bootstrap -->
        <script src="{{url('assets/js/lib/bootstrap.min.js')}}"></script>
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

