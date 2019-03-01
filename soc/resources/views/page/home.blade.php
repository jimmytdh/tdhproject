@extends('app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/lib/morrisjs/morris.css"/>
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/css/loader.css"/>
@endsection

@section('body')
<div id="loader-wrapper">
    <div id="loader"></div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-divider">
                <div class="tools"><span class="icon mdi mdi-chevron-down"></span><span class="icon mdi mdi-refresh-sync"></span><span class="icon mdi mdi-close"></span></div>
                <span class="title">Incoming Patients</span>
                <span class="panel-subtitle">Line Chart of patients per area within 7 days</span>
            </div>
            <div class="panel-body">
                <div id="line-chart" style="height: 250px;"></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-divider">
                <div class="tools"><span class="icon mdi mdi-chevron-down"></span><span class="icon mdi mdi-refresh-sync"></span><span class="icon mdi mdi-close"></span></div>
                <span class="title">Peak Hours</span>
                <span class="panel-subtitle">Count patients visited per hour for the month of {{ date('F') }}</span>
            </div>
            <div class="panel-body">
                <div id="bar-chart" style="height: 250px;"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-divider">
                <div class="tools"><span class="icon mdi mdi-chevron-down"></span><span class="icon mdi mdi-refresh-sync"></span><span class="icon mdi mdi-close"></span></div>
                <span class="title">Area Percentage</span>
                <span class="panel-subtitle">Percentage of patients visited per area</span>
            </div>
            <div class="panel-body">
                <div id="donut-chart" style="height: 250px;"></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-divider">
                <div class="tools"><span class="icon mdi mdi-chevron-down"></span><span class="icon mdi mdi-refresh-sync"></span>
                    <span class="icon mdi mdi-close"></span></div>
                    <span class="title">Patients ({{ date('Y') }})</span>
                    <span class="panel-subtitle">Patients visited to hospital for the year of {{ date('Y') }}</span>
            </div>
            <div class="panel-body">
                <div id="area-chart" style="height: 250px;"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('modal')

@endsection

@section('js')
    <script src="{{ url('/') }}/assets/lib/raphael/raphael.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/lib/morrisjs/morris.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/js/chartsmorris.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            //initialize the javascript
            App.init();
            var data = ['jimmy','von'];
            App.chartsMorris(data);
        });
    </script>
@endsection