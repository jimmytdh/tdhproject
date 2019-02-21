<?php
    use App\Http\Controllers\ItemController as Item;
    $opd = 0;
    $supply = 0;
?>
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
        .custom-control {
            margin-bottom: 0px !important;
            margin-top: 2px;
        }
    </style>
@endsection

@section('body')
    <div id="loader-wrapper">
        <div id="loader"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <a href="{{ url('patients') }}" class="btn btn-space btn-secondary"><i class="s7-back-2"></i> Back</a>
            </div>
            <form method="POST" action="{{ url('charges/print/'.$id) }}" id="formSubmit">
                {{ csrf_field() }}
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-divider">
                        GENERATE SOA <small class="text-danger">[ TOTAL: <span class="total">0</span>]</small>
                        <div class="tools">
                            <div class="form-group form-inline">
                                <input placeholder="Search items here..." autofocus type="text" id="search" class="form-control form-control-sm mr-2" />

                                <button type="submit" class="btn btn-info btn-sm">
                                    <i class="s7-print"></i> Print
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table border="1" width="100%">
                                    <thead class="bg-gray">
                                    <tr>
                                        <th width="70%">OPD Charges</th>
                                        <th width="30%">AMOUNT</th>
                                    </tr>
                                    </thead>
                                    <tbody id="fixed_data">
                                    @foreach($opdcharges as $row)
                                        @if((strtolower($row->name))==='supplies')
                                            <?php continue; ?>
                                        @endif
                                        <?php
                                            $check = Item::checkItem($id,$row->id);
                                            if($check > -1)
                                                $opd += $row->amount;
                                        ?>
                                        <tr class="search_item">
                                            <td>
                                                <label class="custom-control custom-checkbox custom-control-inline select-item">
                                                    <input type="checkbox"
                                                           @if($check > -1) checked="" @endif
                                                           name="items[{{ $row->id }}]"
                                                           data-amount="{{ $row->amount }}"
                                                           data-id="{{ $row->id }}"
                                                           class="custom-control-input">
                                                    <span class="custom-control-label">
                                                    {{ $row->name }}
                                                </span>
                                                </label>
                                            </td>
                                            <td class="charges-{{ $row->id }}">@if($check > -1) {{ $row->amount }} @endif</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <table border="1" width="100%">
                                    <thead class="bg-gray">
                                    <tr>
                                        <th width="70%">OTHER CHARGES</th>
                                        <th width="30%">AMOUNT</th>
                                    </tr>
                                    </thead>
                                    <tbody id="fixed_data">
                                    @foreach($opdothers as $row)
                                        <?php
                                            $check = Item::checkItem($id,$row->id);
                                            if($check > -1)
                                                $opd += $row->amount;
                                        ?>
                                        <tr class="search_item">
                                            <td>
                                                <label class="custom-control custom-checkbox custom-control-inline select-item">
                                                    <input type="checkbox"
                                                           @if($check > -1) checked="" @endif
                                                           name="items[{{ $row->id }}]"
                                                           data-amount="{{ $row->amount }}"
                                                           data-id="{{ $row->id }}"
                                                           class="custom-control-input">
                                                    <span class="custom-control-label">
                                                    {{ $row->name }}
                                                </span>
                                                </label>
                                            </td>
                                            <td class="charges-{{ $row->id }}">@if($check > -1) {{ $row->amount }} @endif</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <table border="1" width="100%">
                                    <thead class="bg-gray">
                                    <tr>
                                        <th width="70%"></th>
                                        <th width="30%">AMOUNT</th>
                                    </tr>
                                    </thead>
                                    <tbody id="fixed_data">
                                    @foreach($opdcharges as $row)
                                        @if((strtolower($row->name))==='supplies')
                                            <?php
                                                $check = Item::checkItem($id,$row->id);
                                                if($check > -1)
                                                    $supply += $row->amount;
                                            ?>
                                            <tr class="search_item">
                                                <td>{{ $row->name }}</td>
                                                <td>
                                                    <input type="number"
                                                           class="supply-select"
                                                           value="{{ $row->amount }}" min="0" placeholder="0.00"
                                                           name="items[{{ $row->id }}]"
                                                           data-id="{{ $row->id }}"
                                                           step="any"
                                                           style="width:100%" />
                                                </td>
                                            </tr>
                                            <?php continue; ?>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('modal')

@endsection

@section('js')
    <script type="text/javascript">
        var opdcharges = parseFloat("{{ $opd }}");
        var supply = parseFloat("{{ $supply }}");
        totalAmount();

        $('input[type="checkbox"]').change(function () {
            var amount = $(this).data('amount');
            var id = $(this).data('id');
            if(this.checked){
                $('.charges-'+id).html(decimal(amount));
                opdcharges = opdcharges + parseInt(amount);

            }else{
                $('.charges-'+id).html(decimal(''));
                opdcharges = opdcharges - parseInt(amount);
            }
            totalAmount();
        });

        $('.supply-select').on('keyup change',function () {
            var amount = parseFloat($(this).val());
            if(amount){
                supply = amount;

            }else{
                supply = 0;
            }
            totalAmount();
        });

        function totalAmount()
        {
            var total = opdcharges + supply;
            $('.total').html(decimal(total));
        }

        function decimal(number) {
            var parts = number.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join(".");
        }
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