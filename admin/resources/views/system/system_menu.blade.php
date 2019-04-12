<div class="col-md-3 email-aside">
    <div class="aside-content">
        <div class="content">
            <div class="aside-header navbar-expand-sm">
                <button data-target=".aside-nav" data-toggle="collapse" type="button" class="navbar-toggler"><span class="icon s7-angle-down"></span></button><span class="title">Main Menu</span>
            </div>
            <div class="aside-nav navbar-collapse collapse">
                <ul class="navbar-nav">
                    <li class="nav-item @if(isset($system)) active @endif"><a href="{{ url('report/systems') }}" class="nav-link"><i class="icon s7-cloud-upload"></i> System Request</a></li>
                    <li class="nav-item @if(isset($backup)) active @endif"><a href="{{ url('report/systems/backup') }}" class="nav-link"><i class="icon s7-server"></i> Backup Monitoring</a></li>
                    <li class="nav-item @if(isset($maintenance)) active @endif"><a href="{{ url('report/systems/maintenance') }}" class="nav-link"><i class="icon s7-display2"></i> Maintenance Monitoring</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>