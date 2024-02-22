@extends('layout.admin')
@section('page_title')
    Restock History For All Items
@endsection

@section('page_content')
    <div class="row">

        <div class="col-lg-12 col-md-12 col-12">
            <div class=" pb-4 mb-2 d-flex justify-content-between align-items-center">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-1 h2 fw-bold">
                        Restock History
                    </h1>
                    <!-- Breadcrumb  -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Stock </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Restock History</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>




        <div class="col-lg-4 col-md-6">
            <div class="card mb-4">
                <div class="card-body py-4">
                    <form action="" method="get">
                        <div class="form-group">
                            <label for="">Select Date To View</label>
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
                            <span class="fs-6 text-uppercase fw-semi-bold">Restock</span>
                        </div>
                        <div>
                            <span class=" fe fe-dollar-sign fs-3 text-primary"></span>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">
                        {{ $total_restock }}
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-12 col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                        <div>
                            <span class="fs-6 text-uppercase fw-semi-bold">Today's Restock</span>
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
                    <h4 class="fw-bold"> <i class="fe fe-list"> </i> Restock List (<?= $day ?>)</h4>
                    <table class="table table-sm mt-2  ">
                        <tr>
                            <th>Receipt</th>
                            <th>items</th>
                            <th></th>
                            <th>Total</th>
                            <th>Supplier</th>
                            <th>Date</th>
                            <th></th>
                        </tr>

                        @php
                            $balance = 0;
                            $tot = 0;
                            $ad = 0;
                        @endphp


                        @foreach ($restocks as $restock)
                            @php
                                $tot += $restock['total'];
                            @endphp
                            <tr class="py-4">
                                <td class="align-middle"> # {{ $restock->id }} </td>
                                <td colspan="2" class="align-middle">
                                    <ul style="margin-bottom: 0px;">
                                        @foreach ($restock->restocks as $item)
                                            <li>
                                                {{ $item->item->name }}
                                                (<span style="font-weight: bolder;">
                                                    {{ $item->quantity }} x {{ $item->price }}
                                                </span>)
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="align-middle">{{ money($restock->total) }}</td>
                                <td class="align-middle">{{ $restock->supplier->phone }}</td>
                                <td class="align-middle">
                                    {{ $restock->created_at }}
                                </td>
                                <td class="align-middle">
                                    <a href="/admin/stock/delete/{{ $restock->id }}" class="text-danger"
                                        onclick="return confirm('This restock will be deleted and stock price will be affected ')">
                                        <i class="fa fa-trash"></i> </a>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3"></th>
                                <th><?= money($tot) ?></th>
                                <th colspan="2"></th>
                                <th colspan="4"></th>
                            </tr>
                        @endforeach

                    </table>

                </div>
            </div>
        </div>
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
