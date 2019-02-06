@extends('app')

@section('css')
    <link rel="stylesheet" href="{{ url('assets/lib/daterange/daterangepicker.css') }}" />
    <style>
        .bg-gray {
            background: #cccccc;
        }
        table {
            margin-bottom: 20px;
        }
        tbody td,table th {
            padding: 5px 5px !important;
        }
        thead th {
            text-align: center;
        }
        .editable {
            text-decoration: none;
            border-bottom: dashed 1px #0357cc;
            color: #0357cc;
        }
    </style>
@endsection

@section('body')
    <div id="loader-wrapper">
        <div id="loader"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-divider">
                    ACTIVITY LOGS
                    <div class="tools">
                        <form action="{{ url('logs/filter') }}" method="post">
                            {{ csrf_field() }}
                        <div class="form-group form-inline">
                            <input placeholder="Date Range" type="text" id="daterange" name="date" class="form-control form-control-sm mr-2" />

                            <button type="submit" class="btn btn-info btn-sm">
                                <i class="s7-search"></i> Filter
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="panel-body">
                    @if(count($logs)>0)
                        <div class="table-responsive">
                            <table border="1" width="100%">
                                <thead class="bg-gray">
                                <tr>
                                    <th>Date</th>
                                    <th>User</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($logs as $row)
                                    <tr>
                                        <td>{{ date('F d, Y h:i A',strtotime($row->created_at)) }}</td>
                                        <td>{{ $row->user }}</td>
                                        <td>{{ $row->action }}</td>
                                        <td>{{ $row->activity }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr />
                        <div class="text-center">
                            {{ $logs->links("pagination::bootstrap-4") }}
                        </div>
                    @else
                        <div role="alert" class="alert alert-info alert-dismissible">
                            <div class="icon"><span class="s7-info"></span></div>
                            <div class="message"><strong>Opps!</strong> No activity log in this filter.</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')

@endsection

@section('js')
    <script src="{{ url('assets/lib/daterange/moment.min.js') }}"></script>
    <script src="{{ url('assets/lib/daterange/daterangepicker.js') }}"></script>
    <script type="text/javascript">
        <?php
            $start = \Illuminate\Support\Facades\Session::get('start_filter');
            if(!$start)
                $start = date('m/d/Y');
            else
                $start = date('m/d/Y',strtotime($start));

            $end = \Illuminate\Support\Facades\Session::get('end_filter');
            if(!$end)
                $end = date('m/d/Y');
            else
                $end = date('m/d/Y',strtotime($end));
        ?>

        $('#daterange').daterangepicker({
            "opens": "left",
            "startDate": "{{ $start }}",
            "endDate": "{{ $end }}"
        });
    </script>
@endsection