<?php
    $profile = \Illuminate\Support\Facades\Session::get('profile');
    $avatar = (strlen($profile->picture) > 0) ? $profile->picture : 'logo.png';
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
    @yield('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/lib/stroke-7/style.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/lib/theme-switcher/theme-switcher.min.css"/>

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
            <li class="nav-item"><a href="{{ url('portal') }}" class="nav-link">Portal</a></li>
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
        <ul class="navbar-nav float-lg-right mai-icons-nav">
            <li class="dropdown nav-item mai-messages"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span class="icon s7-comment"></span></a>
                <ul class="dropdown-menu">
                    <li>
                        <div class="title">Messages</div>
                        <div class="mai-scroller">
                            <div class="content">
                                <ul>
                                    <li><a href="#">
                                            <div class="img"><img src="{{ asset('/') }}/assets/img/avatars/img1.jpg"></div>
                                            <div class="content"><span class="date">16 Sept</span><span class="name">Victor Jara</span><span class="desc">The song that has been brave, will always be the new song. </span></div></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer"> <a href="#">View all messages</a></div>
                    </li>
                </ul>
            </li>
            <li class="dropdown nav-item mai-notifications"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span class="icon s7-bell"></span><span class="indicator"></span></a>
                <ul class="dropdown-menu">
                    <li>
                        <div class="title">Notifications</div>
                        <div class="mai-scroller">
                            <div class="content">
                                <ul>
                                    <li><a href="#">
                                            <div class="icon"><span class="s7-check"></span></div>
                                            <div class="content"><span class="desc">This is a new message for my dear friend <strong>Rob</strong>.</span><span class="date">10 minutes ago</span></div></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer"> <a href="#">View all notifications</a></div>
                    </li>
                </ul>
            </li>
            <li class="dropdown nav-item mai-settings"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span class="icon s7-settings"></span></a>
                <ul class="dropdown-menu">
                    <li>
                        <div class="title">Settings</div>
                        <div class="content">
                            <ul>
                                <li><span>Enable Notifications</span>
                                    <div class="float-right">
                                        <div class="switch-button switch-button-sm">
                                            <input type="checkbox" checked="" name="check" id="switch1"><span>
                                            <label for="switch1"></label></span>
                                        </div>
                                    </div>
                                </li>

                                <li><span>Full-width Layout</span>
                                    <div class="float-right">
                                        <div class="switch-button switch-button-sm">
                                            <input type="checkbox" checked="" name="check4" id="switch4"><span>
                                            <label for="switch4"></label></span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
        <!--User Menu-->
        <ul class="nav navbar-nav float-lg-right mai-user-nav">
            <li class="dropdown nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle nav-link"> <img src="{{ asset('/') }}img/{{ $avatar }}"><span class="user-name">{{ $profile->fname }} {{ $profile->lname }}</span><span class="angle-down s7-angle-down"></span></a>
                <div role="menu" class="dropdown-menu">
                    <a href="#" class="dropdown-item"><span class="icon s7-home"></span>My Account</a>
                    <a href="#" class="dropdown-item"> <span class="icon s7-tools"> </span>Settings</a>
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
                                    <a href="{{ url('home') }}" class="nav-link">
                                        <span class="icon s7-monitor"></span><span class="name">Dashboard</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('home/chart') }}" class="nav-link">
                                        <span class="icon s7-display1"></span><span class="name">Chart</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item parent"><a href="#" role="button" aria-expanded="false" class="nav-link"><span class="icon s7-ribbon"></span><span>Manage</span></a>
                            <ul class="mai-nav-tabs-sub mai-sub-nav nav">
                                <li class="nav-item">
                                    <a href="{{ url('accounts') }}" class="nav-link">
                                        <span class="icon s7-users"></span><span class="name">Accounts</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('units') }}" class="nav-link">
                                        <span class="icon s7-science"></span><span class="name">Units</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('sections') }}" class="nav-link">
                                        <span class="icon s7-science"></span><span class="name">Sections</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('divisions') }}" class="nav-link">
                                        <span class="icon s7-network"></span><span class="name">Divisions</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('systems') }}" class="nav-link">
                                        <span class="icon s7-news-paper"></span><span class="name">Systems</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('ipuser') }}" class="nav-link">
                                        <span class="icon s7-monitor"></span><span class="name">IP Address User</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item parent"><a href="#" role="button" aria-expanded="false" class="nav-link"><span class="icon s7-print"></span><span>Reports</span></a>
                            <ul class="mai-nav-tabs-sub mai-sub-nav nav">
                                <li class="nav-item">
                                    <a href="{{ url('report/accounts') }}" class="nav-link">
                                        <span class="icon s7-users"></span><span class="name">Accounts</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item parent"><a href="#" role="button" aria-expanded="false" class="nav-link"><span class="icon s7-tools"></span><span>Parameters</span></a>
                            <ul class="mai-nav-tabs-sub mai-sub-nav nav">
                                <li class="nav-item">
                                    <a href="form-elements.html" class="nav-link">
                                        <span class="name">Elements</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!--Search input-->
            <div class="search">
                <input type="text" placeholder="Search..." name="q"><span class="s7-search"></span>
            </div>
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

<!-- Mirrored from foxythemes.net/preview/products/maisonnette/page-blank.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Aug 2018 01:27:55 GMT -->
</html>