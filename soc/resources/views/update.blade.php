<!DOCTYPE html><html lang="en">

<!-- Mirrored from foxythemes.net/preview/products/maisonnette/page-sign-up.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Aug 2018 01:24:13 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="favicon.png">
    <title>TalisayMedSys</title>
    <link rel="stylesheet" type="text/css" href="assets/lib/stroke-7/style.css"/>
    <link rel="stylesheet" type="text/css" href="assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/lib/theme-switcher/theme-switcher.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/lib/font-awesome/css/font-awesome.min.css"/><link type="text/css" href="assets/css/app.css" rel="stylesheet">  </head>
<body class="mai-splash-screen">
<div class="mai-wrapper mai-sign-up">
    <div class="main-content container">
        <div class="splash-container row">
            <div class="col-md-6 form-message"><span class="splash-description text-center mt-4 mb-4">Update Administrator Account</span>
                <form class="sign-up-form" method="post" action="{{ asset('system/update') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend"><i class="icon s7-check"></i></div>
                            <input type="text" placeholder="First Name" name="fname" autocomplete="off" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend"><i class="icon s7-check"></i></div>
                            <input type="text" placeholder="Middle Name" name="mname" autocomplete="off" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend"><i class="icon s7-check"></i></div>
                            <input type="text" placeholder="Last Name" name="lname" autocomplete="off" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend"><i class="icon s7-check"></i></div>
                            <input type="text" placeholder="Designation" name="designation" autocomplete="off" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend"><i class="icon s7-user"></i></div>
                            <input id="username" type="text" placeholder="Username" autocomplete="off" name="username" class="form-control">
                        </div>
                    </div>

                    <div class="form-group inline row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><i class="icon s7-lock"></i></div>
                                <input id="pass1" type="password" name="password" placeholder="Password" class="form-control" required data-parsley-minlength="6">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><i class="icon s7-lock"></i></div>
                                <input type="password" placeholder="Confirm" class="form-control" required data-parsley-equalto="#pass1">
                            </div>
                        </div>
                    </div>
                    <div class="form-group sign-up-submit">
                        <button data-dismiss="modal" type="submit" class="btn btn-lg btn-primary btn-block">Update</button>
                    </div>
                </form>
                <div class="out-links"><a href="#">© 2018 TalisayMedSys</a></div>
            </div>
            <div class="col-md-6 user-message">
                <span class="splash-message text-left">Welcome to<br> TalisayMedSys</span>
                <span class="alternative-message text-right">Already have an account? <a href="{{ url('/login') }}">Sign In</a></span>
            </div>
        </div>
    </div>
</div>
<script src="assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
<script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<script src="assets/lib/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="assets/js/app.js" type="text/javascript"></script>
<script src="assets/lib/parsley/parsley.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //initialize the javascript
        App.init();
        $('form').parsley();
    });

</script>
<script type="text/javascript">
    $(document).ready(function(){
        App.livePreview();
    });

</script>
</body>

<!-- Mirrored from foxythemes.net/preview/products/maisonnette/page-sign-up.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Aug 2018 01:24:17 GMT -->
</html>