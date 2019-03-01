<!DOCTYPE html><html lang="en">

<!-- Mirrored from foxythemes.net/preview/products/maisonnette/page-login.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Aug 2018 01:21:39 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="favicon.png">
    <title>Login: TalisayMedSys</title>
    <link rel="stylesheet" type="text/css" href="assets/lib/stroke-7/style.css"/>
    <link rel="stylesheet" type="text/css" href="assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/lib/theme-switcher/theme-switcher.min.css"/><link type="text/css" href="assets/css/app.css" rel="stylesheet">  </head>
<body class="mai-splash-screen">
<div class="mai-wrapper mai-login">
    <div class="main-content container">
        <div class="splash-container row">
            <div class="col-md-6 user-message"><span class="splash-message text-right">{{ $greetings->phrase }}<br /><small style="font-size:0.8em;font-weight: 100;">~ {{ $greetings->author }}</small></span></div>
            <div class="col-md-6 form-message"><img src="img/logo.png" alt="logo" width="120" class="logo-img mb-2">
                <span class="splash-description text-center mt-2 mb-5">Login to your account</span>
                @if(\Illuminate\Support\Facades\Input::get('q')=='error')
                    <div class="text-center text-danger mt-3 mb-3">
                        Incorrect Username/Password!
                    </div>
                @endif

                @if(\Illuminate\Support\Facades\Input::get('q')=='empty')
                    <div class="text-center text-danger mt-3 mb-3">
                        Username doesn't exist!
                    </div>
                @endif
                <form method="post" action="{{ asset('login') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend"><i class="icon s7-user"></i></div>
                            <input id="username" type="text" placeholder="Username" name="username" autocomplete="off" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend"><i class="icon s7-lock"></i></div>
                            <input id="password" type="password" placeholder="Password" name="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group login-submit">
                        <button data-dismiss="modal" type="submit" class="btn btn-lg btn-primary btn-block">Login</button>
                    </div>
                    <div class="form-group row login-tools">
                        <div class="col-sm-6 login-remember">

                        </div>
                        <div class="col-sm-6 pt-2 text-sm-right login-forgot-password"><a href="#">Forgot Password?</a></div>
                    </div>
                </form>
                <div class="out-links"><a href="#">© 2018 TalisayMedSys</a></div>
            </div>
        </div>
    </div>
</div>
<script src="assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
<script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<script src="assets/lib/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="assets/js/app.js" type="text/javascript"></script>
<script src="assets/lib/theme-switcher/theme-switcher.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //initialize the javascript
        App.init();
    });

</script>
<script type="text/javascript">
    $(document).ready(function(){
        App.livePreview();
    });

</script>
</body>

<!-- Mirrored from foxythemes.net/preview/products/maisonnette/page-login.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Aug 2018 01:21:43 GMT -->
</html>