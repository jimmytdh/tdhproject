@extends('app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/lib/Lobibox/lobibox.css"/>
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/css/loader.css"/>
    <style>
        .bg-gray {
            background: #f1f1f1;
        }
        table {
            margin-bottom: 20px;
        }
        table td,table th {
            padding: 2px 5px;
        }
        thead th {
            text-align: center;
            color: #000000;
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
                    SUMMARY OF CHARGES
                    <div class="tools">
                        <a href="#" data-toggle="modal" class="btn btn-info btn-sm">
                            Updated: {{ $last_update }}
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tab-container mb-5">
                                <ul role="tablist" class="nav nav-tabs nav-tabs-dark">
                                    <li class="nav-item"><a href="#d-home" data-toggle="tab" role="tab" class="nav-link active">Emergency/Delivery Room</a></li>
                                    <li class="nav-item"><a href="#d-profile" data-toggle="tab" role="tab" class="nav-link">Operating Room</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="d-home" role="tabpanel" class="tab-pane active">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <table border="1" width="100%">
                                                    <thead class="bg-gray">
                                                    <tr>
                                                        <th width="60%">FIXED CHARGES</th>
                                                        <th width="20%">AMOUNT</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="fixed_data">
                                                    @foreach($fixed as $row)
                                                        <tr>
                                                            <td>{{ $row->name }}</td>
                                                            <td>{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                                            <td></td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>

                                                <table border="1" width="100%">
                                                    <thead class="bg-gray">
                                                    <tr>
                                                        <th width="40%">ROOM & BOARD</th>
                                                        <th width="20%">COST</th>
                                                        <th width="20%">QTY/FR<br>EQ</th>
                                                        <th>AMT</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($room as $row)
                                                        <tr>
                                                            <td>{{ $row->name }}</td>
                                                            <td>{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>

                                                <table border="1" width="100%">
                                                    <thead class="bg-gray">
                                                    <tr>
                                                        <th width="40%">PROCEDURES</th>
                                                        <th width="20%">COST</th>
                                                        <th width="20%">QTY/FR<br>EQ</th>
                                                        <th>AMT</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($procedure as $row)
                                                        <tr>
                                                            <td>{{ $row->name }}</td>
                                                            <td>{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table border="1" width="100%">
                                                    <thead class="bg-gray">
                                                    <tr>
                                                        <th width="40%">EQUIPMENT USE</th>
                                                        <th width="20%">QTY</th>
                                                        <th width="20%">UNIT PRICE</th>
                                                        <th>AMOUNT</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($equipment as $row)
                                                        <tr>
                                                            <td>{{ $row->name }}</td>
                                                            <td>{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                                <table border="1" width="100%">
                                                    <thead class="bg-gray">
                                                    <tr>
                                                        <th width="60%">MEDICAL GAS</th>
                                                        <th width="20%">PSI RATE</th>
                                                        <th>AMOUNT</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($gas as $row)
                                                        <tr>
                                                            <td>{{ $row->name }}</td>
                                                            <td>{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                                            <td></td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                                <table border="1" width="100%">
                                                    <thead class="bg-gray">
                                                    <tr>
                                                        <th width="60%">OUTSOURCED PROCEDURE</th>
                                                        <th>AMOUNT</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($outsource as $row)
                                                        <tr>
                                                            <td>{{ $row->name }}</td>
                                                            <td>{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>

                                                <table border="1" width="100%">
                                                    <thead class="bg-gray">
                                                    <tr>
                                                        <th width="60%">OTHER CHARGES</th>
                                                        <th>AMOUNT</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($ancillary as $row)
                                                        <tr>
                                                            <td>{{ $row->name }}</td>
                                                            <td>{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="d-profile" role="tabpanel" class="tab-pane">
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
                                                        <tr class="search_item">
                                                            <td>{{ $row->name }}</td>
                                                            <td>{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                                            <td></td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>

                                                <table border="1" width="100%">
                                                    <thead class="bg-gray">
                                                    <tr>
                                                        <th width="40%">PROCEDURES</th>
                                                        <th width="20%">CHARGE</th>
                                                        <th width="20%">QUANTITY</th>
                                                        <th>AMOUNT</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($orprocedure as $row)
                                                        <tr class="search_item">
                                                            <td>{{ $row->name }}</td>
                                                            <td>{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    @endforeach

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
                                                        <tr class="search_item">
                                                            <td>{{ $row->name }}</td>
                                                            <td>{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    @endforeach

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
                                                        <tr class="search_item">
                                                            <td>{{ $row->name }}</td>
                                                            <td>{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    @endforeach

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
                                                        <tr class="search_item">
                                                            <td>{{ $row->name }}</td>
                                                            <td>{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    @endforeach

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
                                                        <tr class="search_item">
                                                            <td>{{ $row->name }}</td>
                                                            <td>{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')

@endsection

@section('js')

@endsection