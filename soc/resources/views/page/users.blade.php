@extends('app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/lib/Lobibox/lobibox.css"/>
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
        <div class="col-md-3">
            <div class="panel panel-default">
                @if($edit)
                <div class="panel-heading panel-heading-divider">Update User</div>
                <div class="panel-body">
                    <form action="{{ url('users/update/'.$info->id) }}" method="post" data-parsley-validate="" novalidate="">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>First Name</label>
                            <input class="form-control" value="{{ $info->fname }}" type="text" name="fname" placeholder="First Name" autocomplete="none" required>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" value="{{ $info->lname }}" type="text" name="lname" placeholder="Last Name" autocomplete="none" required>
                        </div>
                        <div class="form-group">
                            <label>Access Level</label>
                            <select class="form-control custom-select" name="level">
                                <option value="0" @if($info->level==0) selected @endif>Standard</option>
                                <option value="1" @if($info->level==1) selected @endif>Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Area</label>
                            <select class="form-control custom-select" name="area">
                                <option value="all" @if($info->level=="all") selected @endif>All Access</option>
                                <option value="er" @if($info->level=="er") selected @endif>Emergency Room</option>
                                <option value="dr" @if($info->level=="dr") selected @endif>Delivery Room</option>
                                <option value="or" @if($info->level=="or") selected @endif>Operating Room</option>
                                <option value="opd" @if($info->level=="opd") selected @endif>Out-Patient Department</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" value="{{ $info->username }}" type="text" name="username" placeholder="Username" autocomplete="none" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" type="password" name="password" placeholder="Unchanged Password">
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-space btn-block btn-primary">Update</button>
                                    <a href="#delete_user" data-toggle="modal" data-id="{{ $info->id }}" class="btn btn-space btn-block btn-danger">Delete</a>
                                    <a href="{{ url('/users') }}" class="btn btn-space btn-block btn-secondary">Add User</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
                @else
                <div class="panel-heading panel-heading-divider">Add User</div>
                <div class="panel-body">
                    <form action="{{ url('users/save') }}" method="post" data-parsley-validate="" novalidate="">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" name="fname" placeholder="First Name" autocomplete="none" required>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" name="lname" placeholder="Last Name" autocomplete="none" required>
                        </div>
                        <div class="form-group">
                            <label>Access Level</label>
                            <select class="form-control custom-select" name="level">
                                <option value="0">Standard</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Area</label>
                            <select class="form-control custom-select" name="area">
                                <option value="all">All Access</option>
                                <option value="er">Emergency Room</option>
                                <option value="dr">Delivery Room</option>
                                <option value="or">Operating Room</option>
                                <option value="opd">Out-Patient Department</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" type="text" name="username" placeholder="Username" autocomplete="none" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" id="pass1" type="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input data-parsley-equalto="#pass1" type="password" required="" placeholder="Confirm Password" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-space btn-block btn-primary">Save</button>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-divider">
                    LIST OF USERS
                </div>
                <div class="panel-body">
                @if(count($logins) > 0)
                <div class="table-responsive">
                    <table border="1" width="100%">
                        <thead class="bg-gray">
                        <tr>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Username</th>
                            <th>Area</th>
                            <th>Access Level</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($logins as $row)
                        <tr>
                            <td>
                                <a href="{{ url('/users/edit/'.$row->id) }}" class="editable">
                                   {{ $row->lname }}
                                </a>
                            </td>
                            <td>{{ $row->fname }}</td>
                            <td>{{ $row->username }}</td>
                            <td class="text-center">{{ strtoupper($row->area) }}</td>
                            <td>
                                @if($row->level==0)
                                    <span class="text-danger">Standard</span>
                                @else
                                    <span class="text-success">Administrator</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <div role="alert" class="alert alert-info alert-dismissible">
                        <div class="icon"><span class="s7-info"></span></div>
                        <div class="message"><strong>Opps!</strong> No user found.</div>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div id="delete_user" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h4 class="mb-3">Delete Confirmation</h4>
                        <p>Are you sure you want to delete this user?</p>
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

        @if(session('status')=='saved')
        lobibox('success','Added','User successfully added!');
        @endif

        @if(session('status')=='updated')
        lobibox('success','Updated','User successfully updated!');
        @endif

        @if(session('status')=='duplicate' || session('status')=='denied')
        lobibox('warning','Duplicate','Username is already in use. Please select different username!');
        @endif

        @if(session('status')=='deleted')
        lobibox('info','Deleted','User successfully deleted!');
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

        $('a[href="#delete_user"]').on('click',function () {
            var id = $(this).data('id');
            $('#delete_link').prop('href',"{{ url('users/delete') }}/"+id);
        });
    </script>

@endsection