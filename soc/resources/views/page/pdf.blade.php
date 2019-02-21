<?php
    use App\Http\Controllers\ItemController as Item;
?>
<html>
<head>
    <title>OPD Charge Slip</title>
    <style>
        thead {
            background: #0d3625;
            color: #fff;
        }

        @page { margin: 15px; }
        body {
            margin: 9px 12px;
            font-family: "Helvetica";
            font-size: 10px;
            line-height: 10px;
        }

        .header { text-align: center; }
        .info { margin-top: 20px; }
        h3 { margin-bottom: 3px; font-size: 1.4em; }
        .table-charge {
            border: 1px solid #000;
        }
        .table-charge .underline { text-align: center; }
        td,th {
            font-size: 9px;
            padding:3px 5px;
        }
        td.underline {
            border-bottom: 0.3px dashed #000;
        }
        .doh_logo, .tdh_logo { position: absolute; }
        .doh_logo {  width:55px; left: -5px; }
        .tdh_logo {  width:58px; right: -5px; top:3px; }
    </style>
</head>
<body>
    <img class="doh_logo" src="{{ url('img/doh.png') }}" />
    <img class="tdh_logo" src="{{ url('img/logo.png') }}" />
    <div class="header">
        Republic of the Philippines<br />
        Department of Health<br />
        Central Visayas Center for Health Development<br />
        TALISAY DISTRICT HOSPITAL<br />
        San Isidro, Talisay City, Cebu<br />
    </div>

    <div class="info">
        <table width="100%" cellspacing="0">
            <tr>
                <td width="15%">NAME</td>
                <td width="3px">:</td>
                <td class="underline" colspan="4">{{ $patient->fname }} {{ $patient->lname }}</td>
            </tr>
            <tr>
                <td width="15%">DATE</td>
                <td width="3px">:</td>
                <td class="underline">{{ date('F d, Y') }}</td>
                <td width="15%">TIME</td>
                <td width="3px">:</td>
                <td class="underline">{{ date('h:i A') }}</td>
            </tr>
        </table>
    </div>

    <center><h3>CHARGE SLIP</h3></center>
    <table width="100%" class="table-charge" cellspacing="0">
        <?php $total = 0;?>
        @foreach($charges as $row)
            <tr>
                <td width="50%">{{ strtoupper($row->name) }}</td>
                <td width="3px">:</td>
                <td class="underline">
                    <?php $amount = \App\Http\Controllers\ItemController::getAmount($id,$row->id); ?>
                    @if($amount > 0)
                        {{ number_format($amount,2) }}
                    @endif
                    <?php $total += $amount; ?>
                </td>
            </tr>
        @endforeach
        @if($others)
        <tr>
            <td>{{ strtoupper($others->name) }}</td>
            <td>:</td>
            <td class="underline">
                {{ number_format($others->amount,2) }}
                <?php $total += $others->amount; ?>
            </td>
        </tr>
        @endif
        <tr style="background: #ccc;">
            <th >TOTAL</th>
            <td width="3px">:</td>
            <th class="underline">{{ number_format($total,2) }}</th>
        </tr>
    </table>
    <br />
    <table width="100%">
        <tr>
            <td width="50%">Prepared by:</td>
            <td style="text-align: right;">OR # __________________________</td>
        </tr>
        <tr>
            <td style="vertical-align: bottom">
                _______________________<br />
                &nbsp;&nbsp;&nbsp;&nbsp;NAME & SIGNATURE
            </td>
            <td>
                <center>Social Welfare Section</center>
                <table width="100%" cellspacing="0" border="1">
                    <tr>
                        <td>Discounted Amount: P</td>
                    </tr>
                    <tr>
                        <td><br /><br /></td>
                    </tr>
                    <tr>
                        <td style="font-size: 0.9em">Social Worker's Name & Signature</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>