@extends('layout.app')
@section('page_title')
    Add Item
@endsection

@section('page_content')
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="card mb-4">
                <div class="card-body py-4">
                    <form action="" method="get">
                        <div class="form-group">
                            <label for="">Select Date</label>
                            <input type="date" name="date" class="form-control" onchange="submit()">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-12 col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                        <div>
                            <span class="fs-6 text-uppercase fw-semi-bold">Sales</span>
                        </div>
                        <div>
                            <span class=" fe fe-dollar-sign fs-3 text-primary"></span>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">
                        {{ $total_sales }}
                    </h2>
                </div>
            </div>
        </div>


        <div class="col-xl-4 col-lg-6 col-md-12 col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                        <div>
                            <span class="fs-6 text-uppercase fw-semi-bold">Total</span>
                        </div>
                        <div>
                            <span class=" fe fe-dollar-sign fs-3 text-primary"></span>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">
                        {{ money($amount) }}
                    </h2>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="fw-bold"> <i class="fe fe-list"> </i> Sales List (<?= $day ?>)</h4>

                        <select name="sales_period" id="" class="mb-2" >
                            <option value="morning">Morning Sales</option>
                            <option value="afternoon">Afternoon Sales</option>
                        </select>

                    </div>
                    @if ($sales->count() == 0)
                        <div class="alert alert-warning">
                            No sales has been made today <span class="fw-bold"> ( {{ date('D M j, Y', strtotime($day)) }}
                                )</span>
                            <br>
                            Your sales will appear here when they are logged!!
                        </div>
                    @else
                        <table class="table table-striped table-sm mt-2  ">
                            <tr>
                                <th>Receipt</th>
                                <th>items</th>
                                <th>Total</th>
                                <th>Payment Mode</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th></th>
                            </tr>

                            @php
                                $balance = 0;
                                $tot = 0;
                                $ad = 0;
                            @endphp

                            @foreach ($sales as $sum)
                                @php
                                    $tot += $sum['total'];
                                @endphp
                                <tr class="py-4">
                                    <td class="align-middle"> # {{ $sum->id }} </td>
                                    <td colspan="1" class="align-middle" style="white-space: wrap; width: 50%">
                                        @foreach ($sum->sales as $item)
                                            <b class="fw-bold">{{ $item->item->name }}</b> ({{ $item->quantity }} x
                                            {{ $item->price }} )
                                        @endforeach
                                    </td>
                                    <td class="align-middle">{{ money($sum->total) }}</td>
                                    <td class="align-middle">
                                        <span
                                            class="badge {{ $sum->payment_mode == 'cash' ? 'bg-info' : 'bg-warning' }} ">{{ $sum->payment_mode }}
                                        </span>
                                    </td>
                                    <td class="align-middle">{{ $sum->customer->phone }}</td>
                                    <td class="align-middle">
                                        {{ formatDate($sum->created_at) }}
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-end ">
                                            <button class="btn btn-xs me-2 px-1 print_here py-0 btn-primary"
                                                data-id="{{ $sum->id }}">
                                                <i class="fe fe-printer"> </i> </button>

                                            @if (date('ymd', strtotime($sum->created_at)) == date('ymd'))
                                                <a class="btn btn-xs px-1  py-0 btn-info" data-id="{{ $sum->id }}"
                                                    href="/pos?trno={{ rand(1111111111, 99999999999) }}&sales_id={{ $sum->id }}&action=edit_sales">
                                                    <i class="fe fe-edit"> </i> </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                            <tr>
                                <th colspan="3"></th>
                                <th><?= money($tot) ?></th>
                                <th colspan="2"></th>
                                <th colspan="4"></th>
                            </tr>

                        </table>
                    @endif



                </div>
            </div>
        </div>


        @if ($returns->count() > 0)
            <div class="col-lg-12 col-md-12 col-12">
                <div class="card mt-3">
                    <div class="card-body">
                        <h4 class="fw-bold"> <i class="fe fe-list"> </i>Returns History (<?= $day ?>)</h4>
                        <table class="table table-sm mt-2  ">
                            <tr>
                                <th>Receipt</th>
                                <th>items</th>
                                <th></th>
                                <th>Total</th>
                                <th class="text-end">Date</th>
                            </tr>

                            @php
                                $balance = 0;
                                $tot = 0;
                                $ad = 0;
                            @endphp


                            @foreach ($returns as $ret)
                                @php
                                    $tot += $ret['total'];
                                @endphp
                                <tr class="py-4">
                                    <td class="align-middle"> # {{ $ret->id }} </td>
                                    <td colspan="2" class="align-middle">
                                        <ul style="margin-bottom: 0px;">
                                            @foreach ($ret->returns as $item)
                                                <li>
                                                    {{ $item->item->name }}
                                                    <span style="font-weight: bolder;">
                                                        {{ $item->quantity }} x {{ $item->price }}
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="align-middle">{{ money($ret->total) }}</td>
                                    <td class="align-middle text-end">
                                        {{ $ret->created_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="3"></th>
                                    <th><?= money($tot) ?></th>
                                    <th colspan="2"></th>
                                </tr>
                            @endforeach

                        </table>

                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection


@push('scripts')
    <script>
        $(function() {

            $('body').on('click', '.print_here', function() {

                id = $(this).data('id');

                var strWindowFeatures =
                    "location=yes,height=70,width=20,scrollbars=yes,status=yes";
                loc = location.href
                loc = loc.replace('/today_sales/1', `/receipt/${id}`);
                var URL = loc;
                var win = window.open(URL, "_blank", strWindowFeatures);
                window.open(URL, '_blank').focus();
                printPage(URL)
            })

        })
    </script>
@endpush
