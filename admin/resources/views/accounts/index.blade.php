@extends('app')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/lib/datatables/datatables.net-bs4/css/dataTables.bootstrap4.css"/>
@endsection

@section('body')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default panel-table">
                <div class="panel-heading">{{ $title }}
                    <div class="tools">
                        <a href="{{ url('accounts/add') }}" class="btn btn-success btn-sm">
                            <i class="icon s7-add-user" style="color: #fff;"></i> Add Account
                        </a>

                    </div>
                </div>
                <div class="panel-body">
                    <table id="table1" class="table table-striped table-hover table-fw-widget">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>ID #</th>
                                <th>Date of Birth</th>
                                <th>Contact</th>
                                <th>Designation</th>
                                <th>Section</th>
                                <th>Division</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($data as $row)
                            <tr>
                                <td>
                                    <a href="{{ url('accounts/update/').'/'.$row->id }}">
                                        {{ $row->lname }}, {{ $row->fname }} {{ $row->mname[0] }}. {{ $row->ext }}
                                    </a>
                                </td>
                                <td>{{ $row->hospital_id }}</td>
                                <td>{{ date('M d, Y',strtotime($row->dob)) }}</td>
                                <td>{{ $row->contact }}</td>
                                <td>{{ $row->designation }}</td>
                                <td title="{{ $row->section }}">
                                    @if(strlen($row->section) > 30)
                                        {{ substr($row->section,0,30) }}...
                                    @else
                                        {{ $row->section }}
                                    @endif
                                </td>
                                <td title="{{ $row->division }}">
                                    @if(strlen($row->division) > 30)
                                        {{ substr($row->division,0,30) }}...
                                    @else
                                        {{ $row->division }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ url('/') }}/assets/lib/datatables/datatables.net/js/jquery.dataTables.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/lib/datatables/datatables.net-bs4/js/dataTables.bootstrap4.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/lib/datatables/datatables.net-buttons/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/lib/datatables/datatables.net-buttons/js/buttons.html5.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/lib/datatables/datatables.net-buttons/js/buttons.flash.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/lib/datatables/datatables.net-buttons/js/buttons.print.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/lib/datatables/datatables.net-buttons/js/buttons.colVis.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/lib/datatables/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js" type="text/javascript"></script>
    <script>
        App.dataTables();
    </script>
@endsection