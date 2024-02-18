<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'PT Sans', sans-serif;
        }

        @page {
            size: 2.8in 11in;
            margin-top: 0cm;
            margin-left: 0cm;
            margin-right: 0cm;
        }

        table {
            width: 100%;
        }

        tr {
            width: 100%;

        }

        h1 {
            text-align: center;
            vertical-align: middle;
        }

        #logo {
            width: 60%;
            text-align: center;
            -webkit-align-content: center;
            align-content: center;
            padding: 5px;
            margin: 2px;
            display: block;
            margin: 0 auto;
        }

        header {
            width: 100%;
            text-align: center;
            -webkit-align-content: center;
            align-content: center;
            vertical-align: middle;
        }

        .items thead {
            text-align: center;
        }

        .center-align {
            text-align: center;
        }

        .bill-details td {
            font-size: 12px;
        }

        .receipt {
            font-size: medium;
        }

        .items .heading {
            font-size: 12.5px;
            text-transform: uppercase;
            border-top: 1px solid black;
            margin-bottom: 4px;
            border-bottom: 1px solid black;
            vertical-align: middle;
        }

        .items thead tr th:first-child,
        .items tbody tr td:first-child {
            width: 47%;
            min-width: 47%;
            max-width: 47%;
            word-break: break-all;
            text-align: left;
        }

        .items td {
            font-size: 12px;
            text-align: right;
            vertical-align: bottom;
        }

        .price::before {
            font-family: Arial;
            text-align: right;
        }

        .sum-up {
            text-align: right !important;
        }

        .total {
            font-size: 13px;
            border-top: 1px dashed black !important;
            border-bottom: 1px dashed black !important;
        }

        .total.text,
        .total.price {
            text-align: right;
        }

        .total.price::before {}

        .line {
            border-top: 1px solid black !important;
        }

        .heading.rate {
            width: 20%;
        }

        .heading.amount {
            width: 25%;
        }

        .heading.qty {
            width: 5%
        }

        p {
            padding: 1px;
            margin: 0;
        }

        section,
        footer {
            font-size: 12px;
        }
    </style>
</head>

<body  >

    <table class="bill-details" style="margin-bottom: 0px">
        <tbody>
            <tr>
                <td>{{ date('j/m/Y H:i', strtotime($sales_summary->created_at)) }}</td>
                <td style="text-align: end"><b>Sales Receipt </b> #{{ $sales_summary->id }}</td>
            </tr>
        </tbody>
    </table>
    <center>
        <h5 style="margin-bottom: 5px">{{ $org->name }}</h5>
        <small>
            {{ $org->address }} {{ $org->phone }}
        </small>
    </center>


    <table class="items">
        <thead>
            <tr>
                <th class="heading name">Item</th>
                <th class="heading qty">Qty</th>
                <th class="heading rate">Rate</th>
                <th class="heading amount">Amount</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($sales_summary->sales as $sale)
                <tr>
                    <td> {{ $sale->item->name }} </td>
                    <td>{{ $sale->quantity }}</td>
                    <td> {{ money($sale->price / $sale->quantity) }} </td>
                    <td> {{ money($sale->price) }} </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" class="sum-up line">Subtotal</td>
                <td class="line price">{{ money($sales_summary->total) }}</td>
            </tr>

            <tr>
                <th colspan="3" class="total text">Total</th>
                <th class="total price">{{ money($sales_summary->total) }}</th>
            </tr>
        </tbody>
    </table>
    {{-- <section>
        <p>
            Paid by : <span>CASH</span>
        </p>
    </section> --}}
    <footer style="text-align:center">
        <center>
            <p class="legal">
                <strong style="font-size: smaller; display: block ">Thank you for your patronage!</strong>
                <hr>
            </p>
            <p style="font-size: 9px;">
                Opening Hours
                <span style="display: block; margin-top: 3px">Mon - Sat 8:00am - 8:00pm</span>
            </p>
        </center>
    </footer>
</body>


<script type="text/javascript">
    window.print();
    window.onafterprint = window.close;   
  </script>

</html>
