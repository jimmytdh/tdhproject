@extends('app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/lib/morrisjs/morris.css"/>
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/css/loader.css"/>
@endsection

@section('body')
<div id="loader-wrapper" style="visibility: visible;">
    <div id="loader"></div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-divider">
                <div class="tools"><span class="icon mdi mdi-chevron-down"></span><span class="icon mdi mdi-refresh-sync"></span><span class="icon mdi mdi-close"></span></div>
                <span class="title">Incoming Patients (Last 7 Days)</span>
                <span class="panel-subtitle"></span>
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
                <span class="title">Peak Hours ({{ date('F') }})</span>
                <span class="panel-subtitle"></span>
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
                <span class="title">Area Percentage ({{ date('F') }})</span>
                <span class="panel-subtitle"></span>
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
                    <span class="panel-subtitle"></span>
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
    @include('js.home')
    <script type="text/javascript">
        $(document).ready(function(){
            //initialize the javascript
            App.init();

            var url = "{{ url('home/data') }}";
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    App.chartsMorris(data);
                    $("#loader-wrapper").css('visibility','hidden');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    window.location.replace("{{ url('summary') }}");
                }
            });
        });
    </script>
@endsection