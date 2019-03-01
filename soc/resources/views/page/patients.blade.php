<?php
    $user = \Illuminate\Support\Facades\Session::get('user');
    $sort = \Illuminate\Support\Facades\Session::get('sort');

    $class1 = '';
    $icon1 = '';

    $class2 = '';
    $icon2 = '';

    $class3 = '';
    $icon3 = '';

    $class4 = '';
    $icon4 = '';

    $class5 = '';
    $icon5 = '';

    $class6 = '';
    $icon6 = '';

    if($sort){
        if($sort->name=='hospital_no')
        {
            $class1 = 'bg-highlight';
            if($sort->order=='asc')
                $icon1 = 's7-bottom-arrow';
            else
                $icon1 = 's7-up-arrow';
        }else if($sort->name=='lname'){
            $class2 = 'bg-highlight';
            if($sort->order=='asc')
                $icon2 = 's7-bottom-arrow';
            else
                $icon2 = 's7-up-arrow';
        }else if($sort->name=='age'){
            $class3 = 'bg-highlight';
            if($sort->order=='asc')
                $icon3 = 's7-bottom-arrow';
            else
                $icon3 = 's7-up-arrow';
        }else if($sort->name=='sex'){
            $class4 = 'bg-highlight';
            if($sort->order=='asc')
                $icon4 = 's7-bottom-arrow';
            else
                $icon4 = 's7-up-arrow';
        }else if($sort->name=='phic'){
            $class5 = 'bg-highlight';
            if($sort->order=='asc')
                $icon5 = 's7-bottom-arrow';
            else
                $icon5 = 's7-up-arrow';
        }else if($sort->name=='created_at'){
            $class6 = 'bg-highlight';
            if($sort->order=='asc')
                $icon6 = 's7-bottom-arrow';
            else
                $icon6 = 's7-up-arrow';
        }
    }
?>

@extends('app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/lib/Lobibox/lobibox.css"/>
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/css/loader.css"/>
    <style>
        .bg-gray {
            background: #000;
        }
        .bg-highlight {
            background: #f1f1f1;
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
                        @if($user->area <> "opd")
                        <div class="table-responsive">
                            <table border="1" width="100%">
                                <thead class="bg-gray">
                                <tr>
                                    <th colspan="2"><a href="{{ url('/patients/sort/hospital_no') }}">Hospital Number <i class="{{ $icon1 }}"></i></a></th>
                                    <th><a href="{{ url('/patients/sort/lname') }}">Patient Name <i class="{{ $icon2 }}"></i></a></th>
                                    <th><a href="{{ url('/patients/sort/age') }}">Age <i class="{{ $icon3 }}"></i></a></th>
                                    <th><a href="{{ url('/patients/sort/sex') }}">Sex <i class="{{ $icon4 }}"></i></a></th>
                                    <th><a href="#">Area</a></th>
                                    <th><a href="{{ url('/patients/sort/phic') }}">Status <i class="{{ $icon5 }}"></i></a></th>
                                    <th><a href="{{ url('/patients/sort/created_at') }}">Date Added <i class="{{ $icon6 }}"></i></a></th>
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
                                                        <a href="{{ url('charges/generate/'.$p->id) }}" title="Generate Charges" class="dropdown-item"><i class="s7-next-2 text-success"></i> Generate SOA</a>
                                                    @else
                                                        <a href="{{ url('charges/update/'.$p->id) }}" title="Update charges" class="dropdown-item"><i class="s7-note text-success"></i> Update SOA</a>
                                                        <a href="{{ url('charges/print/'.$p->id) }}" title="Print Charges" class="dropdown-item"><i class="s7-print text-success"></i> Print SOA</a>
                                                    @endif
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#delete_patient" data-toggle="modal" data-id="{{ $p->id }}" class="dropdown-item"><i class="s7-close text-danger"></i> Delete Patient</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="{{ $class1 }}">
                                            <a href="#edit_patient" data-toggle="modal" class="editable" data-id="{{ $p->id }}">
                                                @if($p->hospital_no)
                                                    {{ $p->hospital_no }}
                                                @else
                                                    <span class="text-danger">- Empty -</span>
                                                @endif
                                            </a>
                                        </td>
                                        <td class="{{ $class2 }}">{{ $p->lname }}, {{ $p->fname }}</td>
                                        <td class="text-center {{ $class3 }}">
                                            <?php
                                                $age = $p->age;
                                                $ext = '';
                                                if($age < 0)
                                                {
                                                    $age = $age * -1;
                                                    $ext = ' m/o';
                                                }
                                            ?>
                                            {{ $age }} {{ $ext }}
                                        </td>
                                        <td class="{{ $class4 }}">{{ $p->sex }}</td>
                                        <td class="text-center">{{ $p->area }}</td>
                                        <td class="{{ $class5 }}">{{ $p->phic }}</td>
                                        <td class="{{ $class6 }}">{{ date('F d, Y h:i A', strtotime($p->created_at)) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr />
                        <div class="text-center">
                            {{ $patients->links("pagination::bootstrap-4") }}
                        </div>
                        @else
                        <div class="table-responsive">
                            <table border="1" width="100%">
                                <thead class="bg-gray">
                                <tr>
                                    <td></td>
                                    <th><a href="{{ url('/patients/sort/lname') }}">Patient Name <i class="{{ $icon2 }}"></i></a></th>
                                    <th width="30%"><a href="{{ url('/patients/sort/created_at') }}">Date <i class="{{ $icon6 }}"></i></a></th>
                                    <th width="30%"><a href="{{ url('/patients/sort/created_at') }}">Time <i class="{{ $icon6 }}"></i></a></th>
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
                                                        <a href="{{ url('charges/generate/'.$p->id) }}" title="Generate Charges" class="dropdown-item"><i class="s7-next-2 text-success"></i> Generate SOA</a>
                                                    @else
                                                        <a href="{{ url('charges/update/'.$p->id) }}" title="Update charges" class="dropdown-item"><i class="s7-note text-success"></i> Update SOA</a>
                                                        <a href="{{ url('charges/print/'.$p->id) }}" title="Print Charges" class="dropdown-item"><i class="s7-print text-success"></i> Print SOA</a>
                                                    @endif
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#edit_patient" data-toggle="modal" data-id="{{ $p->id }}" class="dropdown-item"><i class="s7-note text-success"></i> Update Patient</a>
                                                    <a href="#delete_patient" data-toggle="modal" data-id="{{ $p->id }}" class="dropdown-item"><i class="s7-close text-danger"></i> Delete Patient</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="{{ $class2 }}">{{ $p->lname }}, {{ $p->fname }}</td>
                                        <td class="{{ $class6 }}">{{ date('F d, Y', strtotime($p->created_at)) }}</td>
                                        <td class="{{ $class6 }}">{{ date('h:i A', strtotime($p->created_at)) }}</td>
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
                    @else
                        <div class="alert alert-warning">
                            <div role="alert" class="alert alert-info">
                                <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="s7-close"></span></button>
                                <div class="icon"><span class="s7-users"></span></div>
                                <div class="message"><strong>Oppsss! </strong> No patient found.</div>
                            </div>
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
                        @if($user->area!="opd")
                        <div class="form-group mt-1">
                            <label>Hospital Number</label>
                            <input name="hospital_no" autofocus type="text" class="form-control" autocomplete="off">
                        </div>
                        @else
                            <input type="hidden" value="000000" name="hospital_no" />
                            <input type="hidden" value="0" name="age" />
                            <input type="hidden" value="N/A" name="sex" />
                            <input type="hidden" value="N/A" name="phic" />
                        @endif
                        <div class="form-group mt-1">
                            <label>Last Name</label>
                            <input name="lname" type="text" required class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group mt-1">
                            <label>First Name</label>
                            <input name="fname" type="text" required class="form-control" autocomplete="off">
                        </div>
                        @if($user->area!="opd")
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
                        @endif
                        <div class="form-group">
                            <label>Area</label>
                            <select name="area"
                                    @if($user->area!='all')
                                        disabled
                                    @endif
                                    class="form-control custom-select">
                                <option value="ER" @if($user->area=='er') selected @endif>Emergency Room</option>
                                <option value="OR" @if($user->area=='or') selected @endif>Operating Room</option>
                                <option value="DR" @if($user->area=='dr') selected @endif>Delivery Room</option>
                                <option value="OPD" @if($user->area=='opd') selected @endif>Out-Patient Department</option>
                            </select>
                        </div>
                        @if($user->area!='all')
                            <input type="hidden" value="{{ strtoupper($user->area) }}" name="area" />
                        @endif
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
                        <h3>Update Patient</h3>
                        <hr />
                        @if($user->area <> "opd")
                        <div class="form-group mt-1">
                            <label>Hospital Number</label>
                            <input name="hospital_no" id="hospital_no" autofocus type="text" class="form-control" autocomplete="off">
                        </div>
                        @endif
                        <div class="form-group mt-1">
                            <label>Last Name</label>
                            <input name="lname" id="lname" type="text" required class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group mt-1">
                            <label>First Name</label>
                            <input name="fname" id="fname" type="text" required class="form-control" autocomplete="off">
                        </div>
                        @if($user->area!="opd")
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
                        @endif
                        <div class="form-group">
                            <label>Area</label>
                            <select name="area"
                                    @if($user->area!='all')
                                    disabled
                                    @endif
                                    class="form-control custom-select">
                                <option value="ER" @if($user->area=='er') selected @endif>Emergency Room</option>
                                <option value="OR" @if($user->area=='or') selected @endif>Operating Room</option>
                                <option value="DR" @if($user->area=='dr') selected @endif>Delivery Room</option>
                                <option value="OPD" @if($user->area=='opd') selected @endif>Out-Patient Department</option>
                            </select>
                        </div>
                        @if($user->area!='all')
                            <input type="hidden" value="{{ strtoupper($user->area) }}" name="area" />
                        @endif
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
        lobibox('success','Added','Patient successfully added!');
        @endif

        @if(session('status')=='updated')
        lobibox('success','Updated','Patient successfully updated!');
        @endif

        @if(session('status')=='deleted')
        lobibox('info','Deleted','Patient successfully deleted!');
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