<?php
    $profile = \Illuminate\Support\Facades\Session::get('profile');
    $avatar = (strlen($profile->picture) > 0) ? $profile->picture : 'logo.png';
    $user = \Illuminate\Support\Facades\Session::get('user');
    $host = request()->getHttpHost();
    $admin_url = "http://$host/tdh/admin/";
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from foxythemes.net/preview/products/maisonnette/page-blank.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Aug 2018 01:27:51 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('/') }}/assets/img/favicon.html">
    <title>
        {{ (isset($title)) ? $title: 'TalisayMedSys' }}
    </title>

    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/lib/stroke-7/style.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/lib/theme-switcher/theme-switcher.min.css"/>
    @yield('css')
    <link type="text/css" href="{{ asset('/') }}/assets/css/app.css" rel="stylesheet">

    <style>
        body {
            background: url("{{ url('img/backdrop.png') }}"), -webkit-gradient(radial, center center, 0, center center, 460, from(#ccc), to(#ddd));
        }
    </style>
<body>
<nav class="navbar navbar-expand navbar-dark mai-top-header">
    <div class="container"><a href="#" class="navbar-brand"></a>
        <!--Left Menu-->
        <ul class="nav navbar-nav mai-top-nav">
            <li class="nav-item"><a href="#" class="nav-link">Portal</a></li>
            <li class="nav-item dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">Other Systems <span class="angle-down s7-angle-down"></span></a>
                <div role="menu" class="dropdown-menu">
                    <a href="#" class="dropdown-item">DTS</a>
                    <a href="#" class="dropdown-item">HRIS</a>
                    <a href="#" class="dropdown-item">Inventory System</a>
                    <a href="#" class="dropdown-item">IT Reservation System</a>
                    <a href="#" class="dropdown-item">Calendar Event</a>
                </div>
            </li>
        </ul>
        <!--Icons Menu-->

        <!--User Menu-->
        <ul class="nav navbar-nav float-lg-right mai-user-nav">
            <li class="dropdown nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle nav-link"> <img src="{{ $admin_url.'/upload/thumbs/'.$avatar }}"><span class="user-name">{{ $profile->fname }} {{ $profile->lname }}</span><span class="angle-down s7-angle-down"></span></a>
                <div role="menu" class="dropdown-menu">
                    <a href="#" class="dropdown-item"><span class="icon s7-lock"> </span>Change Password</a>
                    <a href="{{ url('logout') }}" class="dropdown-item"><span class="icon s7-power"> </span>Log Out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<div class="mai-wrapper">
    <nav class="navbar navbar-expand-lg mai-sub-header">
        <div class="container">
            <!-- Mega Menu structure-->
            <nav class="navbar navbar-expand-md">
                <button type="button" data-toggle="collapse" data-target="#mai-navbar-collapse" aria-controls="#mai-navbar-collapse" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler hidden-md-up collapsed">
                    <div class="icon-bar"><span></span><span></span><span></span></div>
                </button>
                <div id="mai-navbar-collapse" class="navbar-collapse collapse mai-nav-tabs">
                    <ul class="nav navbar-nav">
                        <li class="nav-item parent"><a href="#" role="button" aria-expanded="false" class="nav-link"><span class="icon s7-home"></span><span>Home</span></a>
                            <ul class="mai-nav-tabs-sub mai-sub-nav nav">
                                <li class="nav-item">
                                    <a href="{{ url('/home') }}" class="nav-link">
                                        <span class="icon s7-graph"></span><span class="name">Dashboard</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/summary') }}" class="nav-link">
                                        <span class="icon s7-display1"></span><span class="name">Summary of Charges</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item parent"><a href="#" role="button" aria-expanded="false" class="nav-link"><span class="icon s7-ribbon"></span><span>Manage</span></a>
                            <ul class="mai-nav-tabs-sub mai-sub-nav nav">
                                <li class="nav-item">
                                    <a href="{{ url('patients') }}" class="nav-link">
                                        <span class="icon s7-users"></span><span class="name">Patients</span>
                                    </a>
                                </li>
                                @if($user->level==1)
                                <li class="nav-item">
                                    <a href="{{ url('charges') }}" class="nav-link">
                                        <span class="icon s7-cash"></span><span class="name">ER/DR Charges</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('orcharges') }}" class="nav-link">
                                        <span class="icon s7-cash"></span><span class="name">OR Charges</span>
                                    </a>
                                </li>
                                    <li class="nav-item">
                                    <a href="{{ url('opdcharges') }}" class="nav-link">
                                        <span class="icon s7-cash"></span><span class="name">OPD Charges</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @if($user->level==1)
                        <li class="nav-item parent"><a href="#" role="button" aria-expanded="false" class="nav-link"><span class="icon s7-tools"></span><span>Settings</span></a>
                            <ul class="mai-nav-tabs-sub mai-sub-nav nav">
                                <li class="nav-item">
                                    <a href="{{ url('logs') }}" class="nav-link">
                                        <span class="icon s7-search"></span><span class="name">View Logs</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('users') }}" class="nav-link">
                                        <span class="icon s7-unlock"></span><span class="name">User Access</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </nav>
            <!--Search input-->
            @if(isset($post))
                <form method="post" action="{{ url($post) }}">
                    {{ csrf_field() }}
                    <div class="search">
                        <input type="text" value="{{ $keyword }}" placeholder="Search..." name="search"><span class="s7-search"></span>
                    </div>
                </form>
            @endif
        </div>
    </nav>
    <div class="main-content container">
        @yield('body')
    </div>
</div>
@yield('modal')
<script src="{{ asset('/') }}/assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
<script src="{{ asset('/') }}/assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<script src="{{ asset('/') }}/assets/lib/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="{{ asset('/') }}/assets/js/app.js" type="text/javascript"></script>
<script src="{{ asset('/') }}/assets/lib/theme-switcher/theme-switcher.min.js" type="text/javascript"></script>
@yield('js')
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

<script>
    var url = window.location.href;
    var parts = url.split('/');
    var filename = parts[0]+'//'+parts[2]+'/'+parts[3]+'/'+parts[4]+'/'+parts[5];
    if(parts.length > 6)
    {
        filename += '/'+parts[6];
    }
    $('a[href="'+filename+'"]').addClass('active');
    $('a[href="'+filename+'"]').parent().parent().parent().addClass('open');

    $(".loading").show();
</script>
</body>

</html>