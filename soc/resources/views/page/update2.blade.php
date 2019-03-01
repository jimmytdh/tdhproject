<?php
    use App\Http\Controllers\ItemController as Item;
    $sub_orcharges = 0;
    $sub_orprocedure = 0;
    $sub_orsupply = 0;
    $sub_orfluid = 0;
    $sub_orsuture = 0;
    $sub_ormedicine = 0;
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
                        <h4 style="color:#2a2a2a;">Patient Name: <font style="color:#7171c5">{{ ucwords($patient->lname) }}, {{ ucwords($patient->fname) }}</font></h4>
                        <div class="row">
                            <div class="col-md-6">
                                <table border="1" width="100%">
                                    <thead class="bg-gray">
                                    <tr>
                                        <th width="60%">OPERATING ROOM CHARGES</th>
                                        <th width="20%">AMOUNT</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orcharge as $row)
                                        <?php
                                            $check = Item::checkItem($id,$row->id);
                                            if($check > -1)
                                                $sub_orcharges += $row->amount;
                                        ?>
                                        <tr class="search_item">
                                            <td>
                                                <label class="custom-control custom-checkbox custom-control-inline select-item">
                                                    <input type="checkbox"
                                                           @if($check > -1) checked="" @endif
                                                           name="items[{{ $row->id }}]"
                                                           data-amount="{{ $row->amount }}"
                                                           data-class="fixed-{{ $row->id }}"
                                                           class="custom-control-input">
                                                    <span class="custom-control-label">
                                                    {{ $row->name }}
                                                </span>
                                                </label>
                                            </td>
                                            <td>{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                            <td class="charges-{{ $row->id }}">@if($check > -1) {{ number_format($row->amount,2) }} @endif</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th class="text-right" colspan="2">SUBTOTAL</th>
                                        <th class="charges-sub">{{ number_format($sub_orcharges,2) }}</th>
                                    </tr>
                                    </tbody>
                                </table>

                                <table border="1" width="100%">
                                    <thead class="bg-gray">
                                    <tr>
                                        <th width="40%">PROCEDURES</th>
                                        <th width="20%">CHARGE</th>
                                        <th width="20%">QUANTITY</th>
                                        <th width="20%">AMOUNT</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orprocedure as $row)
                                        <?php
                                            $check = Item::checkItem($id,$row->id);
                                            $amount = 0;
                                            $qty = 0;
                                            if($check){
                                                $amount = $row->amount * $check;
                                                $sub_orprocedure += $amount;
                                                $qty = $check;
                                            }
                                        ?>
                                        <tr class="search_item">
                                            <td>{{ $row->name }}</td>
                                            <td>{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                            <td>
                                                <input type="number"
                                                       class="procedure-select"
                                                       value="{{ $qty }}" min="0"
                                                       name="items[{{ $row->id }}]"
                                                       data-amount="{{ $row->amount }}"
                                                       data-id="{{ $row->id }}"
                                                       style="width:100%" />
                                            </td>
                                            <td class="procedure-{{ $row->id }}">{{ number_format($amount,2) }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th class="text-right" colspan="3">SUBTOTAL</th>
                                        <th class="procedure-sub">{{ number_format($sub_orprocedure,2) }}</th>
                                    </tr>
                                    </tbody>
                                </table>

                                <table border="1" width="100%">
                                    <thead class="bg-gray">
                                    <tr>
                                        <th width="40%">SUPPLIES</th>
                                        <th width="20%">UNIT PRICE</th>
                                        <th width="20%">QUANTITY</th>
                                        <th>AMOUNT</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orsupply as $row)
                                        <?php
                                            $check = Item::checkItem($id,$row->id);
                                            $amount = 0;
                                            $qty = 0;
                                            if($check){
                                                $amount = $row->amount * $check;
                                                $sub_orsupply += $amount;
                                                $qty = $check;
                                            }
                                        ?>
                                        <tr class="search_item">
                                            <td>{{ $row->name }}</td>
                                            <td>{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                            <td>
                                                <input type="number"
                                                       class="supply-select"
                                                       value="{{ $qty }}" min="0"
                                                       name="items[{{ $row->id }}]"
                                                       data-amount="{{ $row->amount }}"
                                                       data-id="{{ $row->id }}"
                                                       style="width:100%" />
                                            </td>
                                            <td class="supply-{{ $row->id }}">{{ number_format($amount,2) }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th class="text-right" colspan="3">SUBTOTAL</th>
                                        <th class="supply-sub">{{ number_format($sub_orsupply,2) }}</th>
                                    </tr>
                                    </tbody>
                                </table>

                                <table border="1" width="100%">
                                    <thead class="bg-gray">
                                    <tr>
                                        <th width="40%">IV FLUIDS</th>
                                        <th width="20%">UNIT PRICE</th>
                                        <th width="20%">QUANTITY</th>
                                        <th>AMOUNT</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orfluid as $row)
                                        <?php
                                            $check = Item::checkItem($id,$row->id);
                                            $amount = 0;
                                            $qty = 0;
                                            if($check){
                                                $amount = $row->amount * $check;
                                                $sub_orfluid += $amount;
                                                $qty = $check;
                                            }
                                        ?>
                                        <tr class="search_item">
                                            <td>{{ $row->name }}</td>
                                            <td>{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                            <td>
                                                <input type="number"
                                                       class="fluid-select"
                                                       value="{{ $qty }}" min="0"
                                                       name="items[{{ $row->id }}]"
                                                       data-amount="{{ $row->amount }}"
                                                       data-id="{{ $row->id }}"
                                                       style="width:100%" />
                                            </td>
                                            <td class="fluid-{{ $row->id }}">{{ number_format($amount,2) }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th class="text-right" colspan="3">SUBTOTAL</th>
                                        <th class="fluid-sub">{{ number_format($sub_orfluid,2) }}</th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table border="1" width="100%">
                                    <thead class="bg-gray">
                                    <tr>
                                        <th width="40%">SUTURES</th>
                                        <th width="20%">UNIT PRICE</th>
                                        <th width="20%">QUANTITY</th>
                                        <th>AMOUNT</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orsuture as $row)
                                        <?php
                                            $check = Item::checkItem($id,$row->id);
                                            $amount = 0;
                                            $qty = 0;
                                            if($check){
                                                $amount = $row->amount * $check;
                                                $sub_orsuture += $amount;
                                                $qty = $check;
                                            }
                                        ?>
                                        <tr class="search_item">
                                            <td>{{ $row->name }}</td>
                                            <td>{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                            <td>
                                                <input type="number"
                                                       class="suture-select"
                                                       value="{{ $qty }}" min="0"
                                                       name="items[{{ $row->id }}]"
                                                       data-amount="{{ $row->amount }}"
                                                       data-id="{{ $row->id }}"
                                                       style="width:100%" />
                                            </td>
                                            <td class="suture-{{ $row->id }}">{{ number_format($amount,2) }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th class="text-right" colspan="3">SUBTOTAL</th>
                                        <th class="suture-sub">{{ number_format($sub_orsuture,2) }}</th>
                                    </tr>
                                    </tbody>
                                </table>

                                <table border="1" width="100%">
                                    <thead class="bg-gray">
                                    <tr>
                                        <th width="40%">MEDICINES</th>
                                        <th width="20%">UNIT PRICE</th>
                                        <th width="20%">QUANTITY</th>
                                        <th>AMOUNT</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ormedicine as $row)
                                        <?php
                                            $check = Item::checkItem($id,$row->id);
                                            $amount = 0;
                                            $qty = 0;
                                            if($check){
                                                $amount = $row->amount * $check;
                                                $sub_ormedicine += $amount;
                                                $qty = $check;
                                            }
                                        ?>
                                        <tr class="search_item">
                                            <td>{{ $row->name }}</td>
                                            <td>{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                            <td>
                                                <input type="number"
                                                       class="medicine-select"
                                                       value="{{ $qty }}" min="0"
                                                       name="items[{{ $row->id }}]"
                                                       data-amount="{{ $row->amount }}"
                                                       data-id="{{ $row->id }}"
                                                       style="width:100%" />
                                            </td>
                                            <td class="medicine-{{ $row->id }}">{{ number_format($amount,2) }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th class="text-right" colspan="3">SUBTOTAL</th>
                                        <th class="medicine-sub">{{ number_format($sub_ormedicine,2) }}</th>
                                    </tr>
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
        var sub_charges = parseFloat("{{ $sub_orcharges }}");
        var sub_procedure = parseFloat("{{ $sub_orprocedure }}");
        var sub_supply = parseFloat("{{ $sub_orsupply }}");
        var sub_fluid = parseFloat("{{ $sub_orfluid }}");
        var sub_suture = parseFloat("{{ $sub_orsuture }}");
        var sub_medicine = parseFloat("{{ $sub_ormedicine }}");

        totalAmount();

        $('input[type="checkbox"]').change(function () {
            var amount = $(this).data('amount');
            var cl = $(this).data('class');
            if(this.checked){
                $('.'+cl).html(decimal(amount));
                sub_charges = sub_charges + parseInt(amount);

            }else{
                $('.'+cl).html(decimal(''));
                sub_charges = sub_charges - parseInt(amount);
            }
            $('.charges-sub').html(decimal(sub_charges));
            totalAmount();
        });


        $('.procedure-select').on('keyup change',function () {
            sub_procedure = 0;
            getData('procedure');
        });

        $('.supply-select').on('keyup change',function () {
            sub_supply = 0;
            getData('supply');
        });

        $('.fluid-select').on('keyup change',function () {
            sub_fluid = 0;
            getData('fluid');
        });

        $('.suture-select').on('keyup change',function () {
            sub_suture = 0;
            getData('suture');
        });

        $('.medicine-select').on('keyup change',function () {
            sub_medicine = 0;
            getData('medicine');
        });


        function totalAmount() {
            var total = sub_charges + sub_procedure + sub_supply + sub_fluid + sub_suture + sub_medicine;
            $('.total').html(decimal(total));
        }

        function decimal(number) {
            var parts = number.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join(".");
        }

        function getData(section)
        {
            var loop = "."+section+"-select";
            $(loop).each(function() {
                var qty = $(this).val();
                var amount = $(this).data('amount');
                var total = amount * qty;
                var id = $(this).data('id');

                if(section=='procedure'){
                    sub_procedure += total;
                    $('.procedure-'+id).html(decimal(total));
                    $('.procedure-sub').html(decimal(sub_procedure));
                }else if(section=='supply'){
                    sub_supply += total;
                    $('.supply-'+id).html(decimal(total));
                    $('.supply-sub').html(decimal(sub_supply));
                }else if(section=='fluid'){
                    sub_fluid += total;
                    $('.fluid-'+id).html(decimal(total));
                    $('.fluid-sub').html(decimal(sub_fluid));
                }else if(section=='suture'){
                    sub_suture += total;
                    $('.suture-'+id).html(decimal(total));
                    $('.suture-sub').html(decimal(sub_suture));
                }else if(section=='medicine'){
                    sub_medicine += total;
                    $('.medicine-'+id).html(decimal(total));
                    $('.medicine-sub').html(decimal(sub_medicine));
                }
            });
            totalAmount();
        }

        function getData2(section){
            var loop = "."+section+"-select";
            $(loop).each(function() {
                var amount = $(this).val();
                var id = $(this).data('id');
                amount = parseFloat(amount);
                if(section=='outsource'){
                    sub_outsource += amount;
                    $('.outsource-'+id).html(decimal(amount));
                    $('.outsource-sub').html(decimal(sub_outsource));
                }else if(section=='others'){
                    sub_others += amount;
                    $('.others-'+id).html(decimal(amount));
                    $('.others-sub').html(decimal(sub_others));
                }
            });
            totalAmount();
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