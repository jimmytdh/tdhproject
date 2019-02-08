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
        table th {
            text-align: center;
        }
        .editable {
            text-decoration: none;
            border-bottom: dashed 1px #0357cc;
            color: #0357cc;
        }
        .tdh_logo {
            width: 120px;
            position: absolute;
            left: 90px;
        }
        .doh_logo {
            width: 110px;
            position: absolute;
            right: 90px;
        }
        .photo {
            border-top:dashed 1px #313131;
            margin-top: 30px;
        }

        @media print {
            body * {
                visibility: hidden;
            }
            #print, #print * {
                visibility: visible;
            }
            #print {
                margin-top: -300px;
            }
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
                <a href="{{ url('charges/update/'.$id) }}" class="btn btn-space btn-secondary"><i class="s7-back-2"></i> Update Charges</a>
                <a href="{{ url('patients') }}" class="btn btn-space btn-secondary"><i class="s7-users"></i> Patients</a>
                <a href="#" onclick="window.print()" class="btn btn-space btn-secondary"><i class="s7-print"></i> Print</a>
            </div>


            <div class="panel panel-default" id="print">
                <div class="panel-heading text-center panel-heading-divider">
                    <img src="{{ url('img/logo.png') }}" class="tdh_logo">
                    <img src="{{ url('img/doh.png') }}" class="doh_logo">
                    <div style="visibility: visible" class="header">
                        Republic of the Philippines <br />
                        Department of Health - Regional Office No. VII <br />
                        <strong>TALISAY DISTRICT HOSPITAL</strong> <br />
                        San Isidro, Talisay City, Cebu<br /><br />
                    </div>
                    <strong>SUMMARY OF CHARGES</strong>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <table style="width:100%">
                                <tr>
                                    <td width="30%">Hospital Number : <strong>{{ $patient->hospital_no }}</strong></td>
                                    <td width="30%" colspan="2">Date : <strong>{{ date('F d, Y',strtotime($patient->created_at)) }}</strong></td>
                                    <td>
                                        [@if($patient->phic=='PHIC') <i class="s7-check"></i>@endif ] PHIC&nbsp;
                                        [@if($patient->phic=='Non-PHIC') <i class="s7-check"></i>@endif ] Non-PHIC&nbsp;
                                        [@if($patient->phic=='Private/Paying') <i class="s7-check"></i>@endif ] Private/Paying
                                    </td>
                                </tr>

                                <tr>
                                    <td width="37%">Patient Name : <strong>{{ $patient->lname }}, {{ $patient->fname }}</strong></td>
                                    <td>Age : <strong>{{ $patient->age }}</strong></td>
                                    <td>Sex : <strong>{{ $patient->sex }}</strong></td>
                                    <td>Area:
                                        <strong>
                                            @if($patient->area=='ER')
                                                Emergency Room
                                            @elseif($patient->area=='DR')
                                                Delivery Room
                                            @elseif($patient->area=='OR')
                                                Operating Room
                                            @endif
                                        </strong>
                                    </td>
                                </tr>
                            </table>
                            <table border="1" width="100%">
                            {{-- fixed price --}}
                            @if(count($fixed) > 0)
                                <tr class="bg-gray">
                                    <th width="40%">FIXED CHARGES</th>
                                    <th width="20%">COST</th>
                                    <th width="20%" class="text-center">QTY</th>
                                    <th></th>
                                </tr>
                                @foreach($fixed as $row)
                                    <tr>
                                        <td>{{ $row->name }}</td>
                                        <td class="text-right">{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                        <td class="text-center">1</td>
                                        <td class="text-right">{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                        <?php $total += $row->amount; ?>
                                    </tr>
                                @endforeach
                            @endif

                            {{-- room price --}}
                            @if(count($room) > 0)
                                <tr class="bg-gray">
                                    <th width="40%">ROOM & BOARD</th>
                                    <th width="20%">COST</th>
                                    <th width="20%" class="text-center">QTY</th>
                                    <th></th>
                                </tr>
                                @foreach($room as $row)
                                    <tr>
                                        <td>{{ $row->name }}</td>
                                        <td class="text-right">{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                        <td class="text-center">{{ $row->final_qty }}</td>
                                        <td class="text-right">{{ number_format(($row->amount * $row->final_qty),2) }}</td>
                                        <?php $total += ($row->amount * $row->final_qty); ?>
                                    </tr>
                                @endforeach
                            @endif
                            {{--procedure--}}
                            @if(count($procedure) > 0)
                                <tr class="bg-gray">
                                    <th width="40%">PROCEDURES</th>
                                    <th width="20%">COST</th>
                                    <th width="20%">QTY</th>
                                    <th></th>
                                </tr>
                                @foreach($procedure as $row)
                                    <tr>
                                        <td>{{ $row->name }}</td>
                                        <td class="text-right">{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                        <td class="text-center">{{ $row->final_qty }}</td>
                                        <td class="text-right">{{ number_format(($row->amount * $row->final_qty),2) }}</td>
                                        <?php $total += ($row->amount * $row->final_qty); ?>
                                    </tr>
                                @endforeach
                            @endif

                            {{--supplies--}}
                            @if(count($supplies) > 0)
                                <tr class="bg-gray">
                                    <th width="40%">SUPPLIES</th>
                                    <th width="20%">SELLING PRICE</th>
                                    <th width="20%">QTY</th>
                                    <th></th>
                                </tr>
                                @foreach($supplies as $row)
                                    <tr>
                                        <td>{{ $row->name }}</td>
                                        <td class="text-right">{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                        <td class="text-center">{{ $row->final_qty }}</td>
                                        <td class="text-right">{{ number_format(($row->amount * $row->final_qty),2) }}</td>
                                        <?php $total += ($row->amount * $row->final_qty); ?>
                                    </tr>
                                @endforeach
                            @endif

                            {{--equipment--}}
                            @if(count($equipment) > 0)
                                <tr class="bg-gray">
                                    <th width="40%">EQUIPMENT USE</th>
                                    <th width="20%">UNIT PRICE</th>
                                    <th width="20%">QTY</th>
                                    <th></th>
                                </tr>
                                @foreach($equipment as $row)
                                    <tr>
                                        <td>{{ $row->name }}</td>
                                        <td class="text-right">{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                        <td class="text-center">{{ $row->final_qty }}</td>
                                        <td class="text-right">{{ number_format(($row->amount * $row->final_qty),2) }}</td>
                                        <?php $total += ($row->amount * $row->final_qty); ?>
                                    </tr>
                                @endforeach
                            @endif

                            {{--GAS--}}
                            @if(count($gas) > 0)
                                <tr class="bg-gray">
                                    <th colspan="2">MEDICAL GAS</th>
                                    <th>PSI RATE</th>
                                    <th></th>
                                </tr>
                                @foreach($gas as $row)
                                    <tr>
                                        <td colspan="2">{{ $row->name }}</td>
                                        <td class="text-center">{{ $row->final_qty }}</td>
                                        <td class="text-right">{{ number_format((.50 * $row->final_qty),2) }}</td>
                                        <?php $total += (.50 * $row->final_qty); ?>
                                    </tr>
                                @endforeach
                            @endif

                            {{--outsource--}}
                            @if(count($outsource) > 0)
                                <tr class="bg-gray">
                                    <th width="40%">OUTSOURCED PROCEDURE</th>
                                    <th width="20%">COST</th>
                                    <th width="20%" class="text-center">QTY</th>
                                    <th></th>
                                </tr>
                                @foreach($outsource as $row)
                                    <tr>
                                        <td>{{ $row->name }}</td>
                                        <td class="text-right">{{ number_format($row->final_qty,2) }}</td>
                                        <td class="text-center">1</td>
                                        <td class="text-right">{{ number_format($row->final_qty,2) }}</td>
                                        <?php $total += $row->final_qty; ?>
                                    </tr>
                                @endforeach
                            @endif

                            @if(count($others) > 0)
                                <tr class="bg-gray">
                                    <th width="40%">OTHERS</th>
                                    <th width="20%">COST</th>
                                    <th width="20%" class="text-center">QTY</th>
                                    <th></th>
                                </tr>
                                @foreach($others as $row)
                                    <tr>
                                        <td>{{ $row->name }}</td>
                                        <td class="text-right">{{ number_format($row->final_qty,2) }}</td>
                                        <td class="text-center">1</td>
                                        <td class="text-right">{{ number_format($row->final_qty,2) }}</td>
                                        <?php $total += $row->final_qty; ?>
                                    </tr>
                                @endforeach
                            @endif

                            {{--ancillary--}}
                            @if(count($ancillary) > 0)
                                <tr class="bg-gray">
                                    <th width="40%">OTHER CHARGES</th>
                                    <th width="20%">COST</th>
                                    <th width="20%" class="text-center">QTY</th>
                                    <th></th>
                                </tr>
                                @foreach($ancillary as $row)
                                    <tr>
                                        <td>{{ $row->name }}</td>
                                        <td class="text-right">{{ number_format($row->final_qty,2) }}</td>
                                        <td class="text-center">1</td>
                                        <td class="text-right">{{ number_format($row->final_qty,2) }}</td>
                                        <?php $total += $row->final_qty; ?>
                                    </tr>
                                @endforeach
                            @endif

                            @if(count($orcharge) > 0)
                                <tr class="bg-gray">
                                    <th width="40%">OPERATING ROOM CHARGES</th>
                                    <th width="20%">COST</th>
                                    <th width="20%" class="text-center">QTY</th>
                                    <th></th>
                                </tr>
                                @foreach($orcharge as $row)
                                    <tr>
                                        <td>{{ $row->name }}</td>
                                        <td class="text-right">{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                        <td class="text-center">1</td>
                                        <td class="text-right">{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                        <?php $total += $row->amount; ?>
                                    </tr>
                                @endforeach
                            @endif

                            @if(count($orprocedure) > 0)
                                <tr class="bg-gray">
                                    <th width="40%">PROCEDURES</th>
                                    <th width="20%">CHARGE</th>
                                    <th width="20%" class="text-center">QTY</th>
                                    <th></th>
                                </tr>
                                @foreach($orprocedure as $row)
                                    <tr>
                                        <td>{{ $row->name }}</td>
                                        <td class="text-right">{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                        <td class="text-center">1</td>
                                        <td class="text-right">{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                        <?php $total += $row->amount; ?>
                                    </tr>
                                @endforeach
                            @endif

                            @if(count($orsupply) > 0)
                                <tr class="bg-gray">
                                    <th width="40%">SUPPLIES</th>
                                    <th width="20%">UNIT PRICE</th>
                                    <th width="20%" class="text-center">QTY</th>
                                    <th></th>
                                </tr>
                                @foreach($orsupply as $row)
                                    <tr>
                                        <td>{{ $row->name }}</td>
                                        <td class="text-right">{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                        <td class="text-center">1</td>
                                        <td class="text-right">{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                        <?php $total += $row->amount; ?>
                                    </tr>
                                @endforeach
                            @endif

                            @if(count($orsuture) > 0)
                                <tr class="bg-gray">
                                    <th width="40%">SUTURES</th>
                                    <th width="20%">UNIT PRICE</th>
                                    <th width="20%" class="text-center">QTY</th>
                                    <th></th>
                                </tr>
                                @foreach($orsuture as $row)
                                    <tr>
                                        <td>{{ $row->name }}</td>
                                        <td class="text-right">{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                        <td class="text-center">1</td>
                                        <td class="text-right">{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                        <?php $total += $row->amount; ?>
                                    </tr>
                                @endforeach
                            @endif

                            @if(count($orfluid) > 0)
                                <tr class="bg-gray">
                                    <th width="40%">IV FLUIDS</th>
                                    <th width="20%">UNIT PRICE</th>
                                    <th width="20%" class="text-center">QTY</th>
                                    <th></th>
                                </tr>
                                @foreach($orfluid as $row)
                                    <tr>
                                        <td>{{ $row->name }}</td>
                                        <td class="text-right">{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                        <td class="text-center">1</td>
                                        <td class="text-right">{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                        <?php $total += $row->amount; ?>
                                    </tr>
                                @endforeach
                            @endif

                            @if(count($ormedicine) > 0)
                                <tr class="bg-gray">
                                    <th width="40%">MEDICINES</th>
                                    <th width="20%">UNIT PRICE</th>
                                    <th width="20%" class="text-center">QTY</th>
                                    <th></th>
                                </tr>
                                @foreach($ormedicine as $row)
                                    <tr>
                                        <td>{{ $row->name }}</td>
                                        <td class="text-right">{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                        <td class="text-center">1</td>
                                        <td class="text-right">{{ number_format($row->amount,2) }}@if(strlen($row->type)>1)/{{ $row->type }} @endif</td>
                                        <?php $total += $row->amount; ?>
                                    </tr>
                                @endforeach
                            @endif


                            <tr class="bg-gray">
                                <td colspan="3" class="text-right" style="font-size: 1.2em;"><strong>TOTAL BILL</strong></td>
                                <td class="text-right" style="font-size: 1.2em;"><strong>{{ number_format($total,2) }}</strong></td>
                            </tr>
                            </table>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="mb-4"></div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <img src="{{ url('img/signature.jpg') }}" width="100%" />
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-1"></div>
                        <div class="col-md-10 text-right">
                            NSD-FM-19 REV.1<br />
                            21 January 2019
                        </div>
                    </div>
                    <div class="photo">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <img src="{{ url('img/signature2.jpg') }}" width="100%" />
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
<script type="text/javascript">
//    window.print();
</script>
@endsection