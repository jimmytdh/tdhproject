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
                        <a href="{{ url('sections/add') }}" class="btn btn-success btn-sm">
                            <i class="icon s7-plus" style="color: #fff;"></i> Add Section
                        </a>

                    </div>
                </div>
                <div class="panel-body">
                    <table id="table1" class="table table-striped table-hover table-fw-widget">
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Head</th>
                            <th># of Personnel</th>
                            <th>Division</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($data as $row)
                            <tr>
                                <td>
                                    <a href="{{ url('sections/update/').'/'.$row->id }}">
                                        {{ $row->code }}
                                    </a>
                                </td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->lname }}, {{ $row->fname }}</td>
                                <td>{{ \App\Http\Controllers\SectionController::countPersonnel($row->id) }}</td>
                                <td>{{ $row->division }}</td>
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