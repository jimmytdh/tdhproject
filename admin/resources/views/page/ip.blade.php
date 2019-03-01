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
        table td,table th {
            padding: 2px 5px;
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
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-divider">
                    STATIC IP USER
                    <div class="tools">
                        <div class="form-group form-inline">
                            <input placeholder="Search items here..." autofocus type="text" id="search" class="form-control form-control-xs mr-2" />
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="panel-body">
                    <table border="1" width="100%">
                        <thead class="bg-gray">
                        <tr>
                            <th>IP ADDRESS</th>
                            <th>USER</th>
                            <th>SECTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($static as $row)
                        <?php
                            $name = $row->lname.", ".$row->fname;
                        ?>
                        <tr class="search_item">
                            <td>
                                <a href="#update" data-toggle="modal"
                                   data-id="{{ $row->id }}"
                                   class="editable">
                                    192.168.5.{{ $row->ip_address }}
                                </a>
                            </td>
                            <td>@if(strlen($name)>2) {{ $name }} @endif</td>
                            <td>{{ $row->section }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-divider">
                    IHOMIS IP USER
                    <div class="tools">
                        <div class="form-group form-inline">
                            <input placeholder="Search items here..." autofocus type="text" id="search2" class="form-control form-control-xs mr-2" />
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="panel-body">
                    <table border="1" width="100%">
                        <thead class="bg-gray">
                        <tr>
                            <th>IP ADDRESS</th>
                            <th>USER</th>
                            <th>SECTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($homis as $row)
                            <?php
                            $name = $row->lname.", ".$row->fname;
                            ?>
                            <tr class="search_item2">
                                <td>
                                    <a href="#update" data-toggle="modal"
                                       data-id="{{ $row->id }}"
                                       class="editable">
                                        192.168.10.{{ $row->ip_address }}
                                    </a>
                                </td>
                                <td>@if(strlen($name)>2) {{ $name }} @endif</td>
                                <td>{{ $row->section }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div id="update" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <form method="post" action="{{ url('ipuser/update') }}">
                    {{ csrf_field() }}
                    <input type="hidden" id="ip_id" name="id" value="" />
                    <div class="modal-body">
                        <h3>Update IP User</h3>
                        <hr />
                        <div class="form-group mt-1">
                            <label>IP Address</label>
                            <input id="ip_address" disabled value="" class="form-control">
                        </div>
                        <div class="form-group mt-1">
                            <label>First Name</label>
                            <input id="fname" name="fname" value="" class="form-control">
                        </div>
                        <div class="form-group mt-1">
                            <label>Last Name</label>
                            <input id="lname" name="lname" value="" class="form-control">
                        </div>
                        <div class="form-group mt-1">
                            <label>Section</label>
                            <input id="section" name="section" value="" class="form-control">
                        </div>

                        <div class="text-center">
                            <hr />
                            <div class="mt-2">
                                <button type="button" data-dismiss="modal" class="btn btn-sm btn-secondary">&nbsp;&nbsp;&nbsp;Close&nbsp;&nbsp;&nbsp;</button>
                                <button type="submit" class="btn btn-sm btn-primary">&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="delete_item" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h4 class="mb-3">Delete Confirmation</h4>
                        <p>Are you sure you want to delete this item?</p>
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
    <script src="{{ url('/') }}/assets/lib/Lobibox/Lobibox.js" type="text/javascript"></script>
    <script type="text/javascript">

        @if(session('status')=='updated')
        lobibox('success','Updated','Item successfully updated!');
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
        $('a[href="#update"]').on('click',function () {
            var id = $(this).data('id');
            $.ajax({
                url: "{{ url('ipuser/edit/') }}/"+id,
                type: "GET",
                success: function (data) {
                    var ip = "";
                    if(data.ip_type=='static')
                        ip = '192.168.5.'+data.ip_address;
                    else
                        ip = '192.168.10.'+data.ip_address;

                    $("#ip_address").val(ip);
                    $("#fname").val(data.fname);
                    $("#lname").val(data.lname);
                    $("#section").val(data.section);
                    $("#ip_id").val(data.id);
                }
            });
        });

        $('#search').on('keyup', function () {
            searchFunction();
        });

        $('#search2').on('keyup', function () {
            searchFunction2();
        });

        function searchFunction() {
            // Declare variables
            var input, filter, td, tr, a, i;
            input = document.getElementById('search');
            filter = input.value.toUpperCase();
            td = document.getElementsByTagName('td');
            tr = document.getElementsByClassName('search_item');

            for(i=0; i < tr.length; i++){
                a = tr[i].innerHTML;
                if(a.toUpperCase().indexOf(filter) > -1){
                    tr[i].style.display = "";
                }else{
                    tr[i].style.display = "none";
                }
            }

        }

        function searchFunction2() {
            // Declare variables
            var input, filter, td, tr, a, i;
            input = document.getElementById('search2');
            filter = input.value.toUpperCase();
            td = document.getElementsByTagName('td');
            tr = document.getElementsByClassName('search_item2');

            for(i=0; i < tr.length; i++){
                a = tr[i].innerHTML;
                if(a.toUpperCase().indexOf(filter) > -1){
                    tr[i].style.display = "";
                }else{
                    tr[i].style.display = "none";
                }
            }

        }
    </script>

@endsection