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
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-divider">
                    CHARGE SLIP (Out-Patient Department)<small class="text-danger"> <br />[Updated: {{ $last_update }}]</small>
                    <div class="tools">
                        <div class="form-group form-inline">
                            <input placeholder="Search items here..." autofocus type="text" id="search" class="form-control form-control-sm mr-2" />
                            <a href="#add_item" data-toggle="modal" class="btn btn-success btn-sm">
                                <i class="icon s7-plus" style="color: #fff;"></i> Add Item
                            </a>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="panel-body">
                    <div class="row">
                        @if(count($charges) > 0)
                        <div class="col-md-6">
                            <table border="1" width="100%">
                                <thead class="bg-gray">
                                <tr>
                                    <th width="50%">OPD CHARGES</th>
                                    <th width="30%">AMOUNT</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($charges as $row)
                                    <tr class="search_item">
                                        <td>
                                            <a href="#delete_item" data-toggle="modal" data-id="{{ $row->id }}" class="text-danger"><strong>x</strong></a>
                                            <a href="#edit_item" data-toggle="modal" class="editable" data-id="{{ $row->id }}">{{ $row->name }}</a>
                                        </td>
                                        <td>{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>

                        <div class="col-md-6">
                            <table border="1" width="100%">
                                <thead class="bg-gray">
                                <tr>
                                    <th width="50%">OTHER CHARGES</th>
                                    <th width="30%">AMOUNT</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($others as $row)
                                    <tr class="search_item">
                                        <td>
                                            <a href="#delete_item" data-toggle="modal" data-id="{{ $row->id }}" class="text-danger"><strong>x</strong></a>
                                            <a href="#edit_item" data-toggle="modal" class="editable" data-id="{{ $row->id }}">{{ $row->name }}</a>
                                        </td>
                                        <td>{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                        @else
                            <div class="col-md-12">
                                <div class="alert alert-warning">
                                    <div role="alert" class="alert alert-info">
                                        <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="s7-close"></span></button>
                                        <div class="icon"><span class="s7-wallet"></span></div>
                                        <div class="message"><strong>Oppsss! </strong> No item found.</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div id="add_item" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <form method="post" action="{{ url('item/save') }}">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <h3>Add Item</h3>
                        <hr />
                        <div class="form-group mt-1">
                            <label>Item Name</label>
                            <input name="name" autofocus type="text" required class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Section</label>
                            <select name="section" class="form-control custom-select">
                                <option @if(\Illuminate\Support\Facades\Session::get('section')=='opdcharges') selected @endif value="opdcharges">OPD Charges</option>
                                <option @if(\Illuminate\Support\Facades\Session::get('section')=='opdothers') selected @endif value="opdothers">Other Charges</option>
                            </select>
                        </div>
                        <div class="form-group mt-1">
                            <label>Amount/Cost</label>
                            <input name="amount" value="0" data-parsley-type="number" type="text" required="" class="form-control" autocomplete="off">
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
    <div id="edit_item" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="s7-close"></span></button>
                </div>
                <form method="post" action="{{ url('item/update') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="" id="id" />
                    <div class="modal-body">
                        <h3>Update Item</h3>
                        <hr />
                        <div class="form-group mt-1">
                            <label>Item Name</label>
                            <input name="name" id="name" autofocus type="text" required class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Section</label>
                            <select name="section" class="form-control custom-select">
                                <option value="opdcharges">OPD Charges</option>
                                <option value="opdothers">Other Charges</option>
                            </select>
                        </div>

                        <div class="form-group mt-1">
                            <label>Amount/Cost</label>
                            <input name="amount" id="amount" value="0" data-parsley-type="number" type="text" required="" class="form-control" autocomplete="off">
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
        $('a[href="#edit_item"]').on('click',function () {
            $('#loader').css('visibility','visible');
            var id = $(this).data('id');
            $("#id").val(id);
            $.ajax({
                url: "{{ url('item/edit/') }}/"+id,
                type: "GET",
                success: function (data) {
                    $('#name').val(data.name);
                    $('#section').val(data.section);
                    $('#amount').val(data.amount);
                    console.log(data.section);
                    var type = data.type;
                    if(type=='day')
                        $('input[value="day"]').prop('checked',true);
                    else if(type=='use')
                        $('input[value="use"]').prop('checked',true);
                    else if(type=='pc')
                        $('input[value="pc"]').prop('checked',true);
                    else
                        $('#default').prop('checked',true);

                    $('#loader').css('visibility','hidden');
                }
            });
        });

        $('a[href="#delete_item"]').on('click',function () {
            var id = $(this).data('id');
            $('#delete_link').prop('href',"{{ url('item/delete') }}/"+id);
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });


        $('#search').on('keyup', function () {
            searchFunction();
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
    </script>
@endsection