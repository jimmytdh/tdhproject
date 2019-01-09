@extends('app')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/lib/datatables/datatables.net-bs4/css/dataTables.bootstrap4.css"/>
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/lib/Lobibox/lobibox.css"/>
@endsection

@section('body')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default panel-table">
                <div class="panel-heading">{{ $title }}
                    <div class="tools">
                        <a href="{{ url('divisions/add') }}" class="btn btn-success btn-sm">
                            <i class="icon s7-plus" style="color: #fff;"></i> Add Division
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
                            <th># of Sections/Departments</th>
                            <th># of Personnel</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($data as $row)
                        <tr>
                            <td>
                                <a href="{{ url('divisions/update/').'/'.$row->id }}">
                                    {{ $row->code }}
                                </a>
                            </td>
                            <td title="{{ $row->name }}">
                                @if(strlen($row->name) > 30)
                                    {{ substr($row->name,0,30) }}...
                                @else
                                    {{ $row->name }}
                                @endif
                            </td>
                            <td>
                                @if(strlen($row->lname) > 0)
                                    {{ $row->lname }}, {{ $row->fname }}
                                @else
                                    <span class="text-danger">-- None --</span>
                                @endif
                            </td>
                            <td>{{ \App\Http\Controllers\DivisionController::countSection($row->id) }}</td>
                            <td>{{ \App\Http\Controllers\DivisionController::countPersonnel($row->id) }}</td>
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
    <script src="{{ url('/') }}/assets/lib/Lobibox/Lobibox.js" type="text/javascript"></script>
    <script>
        App.dataTables();
    </script>
    <script type="text/javascript">

        @if(session('status')=='deleted')
        lobibox('success','Deleted','Section/Department deleted successfully!');
        @endif

        function lobibox(status,title,msg)
        {
            Lobibox.notify(status, {
                delay: false,
                title: title,
                msg: msg,
                img: "{{ url('img/logo.png') }}",
                sound: false
            });
        }
    </script>
@endsection