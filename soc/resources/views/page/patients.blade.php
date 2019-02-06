@extends('app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/lib/Lobibox/lobibox.css"/>
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/css/loader.css"/>
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
                    LIST OF PATIENTS
                    <div class="tools">
                        <div class="tools">
                            <a href="#add_patient" data-toggle="modal" class="btn btn-success btn-sm">
                                <i class="icon s7-plus" style="color: #fff;"></i> Add Patient
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    @if(count($patients)>0)
                        <div class="table-responsive">
                            <table border="1" width="100%">
                                <thead class="bg-gray">
                                <tr>
                                    <th colspan="2">Hospital Number</th>
                                    <th>Patient Name</th>
                                    <th>Age</th>
                                    <th>Sex</th>
                                    <th>Area</th>
                                    <th>Status</th>
                                    <th>Date Added</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($patients as $p)
                                    <tr>
                                        <td class="text-center" width="50px;">
                                            <div class="btn-hspace mx-auto">
                                                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn @if($p->status==1) btn-success @else btn-secondary @endif btn-xs d-block dropdown-toggle"><i class="s7-edit"></i> <span class="icon-dropdown s7-angle-down"></span></button>
                                                <div class="dropdown-menu">
                                                    @if($p->status==0)
                                                        <a href="{{ url('charges/generate/'.$p->id) }}" title="Generate Charges" class="dropdown-item"><i class="s7-next-2 text-success"></i> Generate Charges</a>
                                                    @else
                                                        <a href="{{ url('charges/update/'.$p->id) }}" title="Update charges" class="dropdown-item"><i class="s7-note text-success"></i> Update Charges</a>
                                                        <a href="{{ url('charges/print/'.$p->id) }}" title="Print Charges" class="dropdown-item"><i class="s7-print text-success"></i> Print</a>
                                                    @endif
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#delete_patient" data-toggle="modal" data-id="{{ $p->id }}" class="dropdown-item"><i class="s7-close text-danger"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#edit_patient" data-toggle="modal" class="editable" data-id="{{ $p->id }}">
                                                @if($p->hospital_no)
                                                    {{ $p->hospital_no }}
                                                @else
                                                    <span class="text-danger">- Empty -</span>
                                                @endif
                                            </a>
                                        </td>
                                        <td>{{ $p->lname }}, {{ $p->fname }}</td>
                                        <td class="text-center">{{ $p->age }}</td>
                                        <td>{{ $p->sex }}</td>
                                        <td class="text-center">{{ $p->area }}</td>
                                        <td>{{ $p->phic }}</td>
                                        <td>{{ date('F d, Y h:i A', strtotime($p->created_at)) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr />
                        <div class="text-center">
                            {{ $patients->links("pagination::bootstrap-4") }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div id="add_patient" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <form method="post" action="{{ url('patient/save') }}">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <h3>Add Patient</h3>
                        <hr />
                        <div class="form-group mt-1">
                            <label>Hospital Number</label>
                            <input name="hospital_no" autofocus type="text" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group mt-1">
                            <label>Last Name</label>
                            <input name="lname" type="text" required class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group mt-1">
                            <label>First Name</label>
                            <input name="fname" type="text" required class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group mt-1">
                            <label>Age</label>
                            <input name="age" data-parsley-type="number" type="number" required="" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Sex</label>
                            <select name="sex" class="form-control custom-select">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="phic" class="form-control custom-select">
                                <option>PHIC</option>
                                <option>Non-PHIC</option>
                                <option>Private/Paying</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Area</label>
                            <select name="area" class="form-control custom-select">
                                <option value="ER">Emergency Room</option>
                                <option value="OR">Operating Room</option>
                                <option value="DR">Delivery Room</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <hr />
                            <div class="mt-2">
                                <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-secondary">&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;&nbsp;</button>
                                <button type="submit" class="btn btn-sm btn-primary">&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="edit_patient" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <form method="post" action="{{ url('patient/update') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id" />
                    <div class="modal-body">
                        <h3>Add Patient</h3>
                        <hr />
                        <div class="form-group mt-1">
                            <label>Hospital Number</label>
                            <input name="hospital_no" id="hospital_no" autofocus type="text" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group mt-1">
                            <label>Last Name</label>
                            <input name="lname" id="lname" type="text" required class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group mt-1">
                            <label>First Name</label>
                            <input name="fname" id="fname" type="text" required class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group mt-1">
                            <label>Age</label>
                            <input name="age" id="age" data-parsley-type="number" type="number" required="" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Sex</label>
                            <select name="sex" id="sex" class="form-control custom-select">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="phic" id="phic" class="form-control custom-select">
                                <option>PHIC</option>
                                <option>Non-PHIC</option>
                                <option>Private/Paying</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Area</label>
                            <select name="area" id="area" class="form-control custom-select">
                                <option value="ER">Emergency Room</option>
                                <option value="OR">Operating Room</option>
                                <option value="DR">Delivery Room</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <hr />
                            <div class="mt-2">
                                <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-secondary">&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;&nbsp;</button>
                                <button type="submit" class="btn btn-sm btn-primary">&nbsp;&nbsp;&nbsp;Update&nbsp;&nbsp;&nbsp;</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="delete_patient" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h4 class="mb-3">Delete Confirmation</h4>
                        <p>Are you sure you want to delete this patient?</p>
                        <hr />
                        <div class="mt-2">
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-space btn-secondary">&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;&nbsp;</button>
                            <a href="#" id="delete_link" class="btn btn-sm btn-space btn-primary">&nbsp;&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ url('/') }}/assets/lib/parsley/parsley.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/lib/Lobibox/Lobibox.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('form').parsley();
        });

        @if(session('status')=='added')
        lobibox('success','Added','Item successfully added!');
        @endif

        @if(session('status')=='updated')
        lobibox('success','Updated','Item successfully updated!');
        @endif

        @if(session('status')=='deleted')
        lobibox('info','Deleted','Item successfully deleted!');
        @endif

        function lobibox(status,title,msg)
        {
            Lobibox.notify(status, {

                title: title,
                msg: msg,
                img: "{{ url('img/logo.png') }}",
                sound: false
            });
        }
    </script>
    <script type="text/javascript">
        $('a[href="#edit_patient"]').on('click',function () {
            $('#loader').css('visibility','visible');
            var id = $(this).data('id');
            $("#id").val(id);
            $.ajax({
                url: "{{ url('patient/edit/') }}/"+id,
                type: "GET",
                success: function (data) {
                    $('#hospital_no').val(data.hospital_no);
                    $('#lname').val(data.lname);
                    $('#fname').val(data.fname);
                    $('#age').val(data.age);
                    $('#sex').val(data.sex);
                    $('#phic').val(data.phic);
                    $('#area').val(data.area);
                    $('#id').val(data.id);
                    $('#loader').css('visibility','hidden');
                }
            });
        });

        $('a[href="#delete_patient"]').on('click',function () {
            var id = $(this).data('id');
            $('#delete_link').prop('href',"{{ url('patient/delete') }}/"+id);
        });
    </script>
@endsection