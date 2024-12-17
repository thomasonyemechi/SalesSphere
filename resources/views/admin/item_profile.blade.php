@extends('layout.app')
@section('page_title')
    Stock Profile {{ isset($item) ? '| ' . $item->name : '' }}
@endsection

<style>
    .ddt {
        position: absolute;
        z-index: 9;
        max-height: 50vh;
        overflow-y: scroll;
        overflow-x: hidden;
    }
</style>

@section('page_content')
    <div class="col-xl-12">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class=" pb-4 mb-2 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Item Profile
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Items </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">{{ isset($item) ? $item->name : '' }}</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">

                        <div style="width: 600px;">
                            @include('pos.search')


                            <div class="sbox ddt mt-3 " style="width: 100%" style="position: absolute; background-color:rgb(0, 0, 0) ">

                            </div>

                        </div>


                    </div>
                </div>
            </div>




            @isset($item)
                <div class="col-md-12">
                    <div class="card mb-3">



                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="text-center">
                                        <img src="{{ Avatar::create(ucwords($item->name))->toBase64() }}" />
                                        <h2 class="fw-bold mt-2 mb-0" style="text-transform: uppercase"> {{ ucwords($item->name) }}
                                        </h2>


                                        <div class="badge bg-dark-warning " >
                                            Store Quantity : {{ $item->quantity }} 
                                        </div>

                                        @if ($item->brand)
                                            <p class="m-0">
                                                {{ $item->brand }}
                                            </p>
                                        @endif

                                        @if ($item->description)
                                            <p class="m-0">
                                                {{ $item->description }}
                                            </p>
                                        @endif

                                    </div>
                                </div>

                                <div class="col-md-8">

                                    <div class="row">
                                        <div class="col">
                                            <div class="d-flex justify-content-between border-bottom py-2">
                                                <span>Cost Price</span>
                                                <span class="text-warning">
                                                    {{ money($item->cost_price) }}
                                                </span>
                                            </div>


                                            <div class="d-flex justify-content-between border-bottom py-2">
                                                <span>Restock Qty</span>
                                                <span class="fw-bold text-success">
                                                    {{ money($item->cost_price) }}
                                                </span>
                                            </div>


                                            <div class="d-flex justify-content-between border-bottom py-2">
                                                <span>Sold Last </span>
                                                <span>
                                                    20 nov 24
                                                    <br>
                                                    2 x 25000
                                                </span>
                                            </div>

                                            <div class="d-flex justify-content-between border-bottom py-2">
                                                <span>Created Date</span>
                                                <span>
                                                    {{ formatDate($item->created_at) }}
                                                </span>

                                            </div>
                                            <div class="d-flex justify-content-between border-bottom py-2">
                                                <span>Total Returned</span>
                                                <span class="fw-bold text-success">
                                                    {{ money($item->cost_price) }}
                                                </span>
                                            </div>


                                        </div>
                                        <div class="col">
                                            <div class="d-flex justify-content-between border-bottom py-2">
                                                <span>Selling Price</span>
                                                <span class="text-warning">
                                                    {{ money($item->price) }}
                                                </span>
                                            </div>


                                            <div class="d-flex justify-content-between border-bottom py-2">
                                                <span>Sales Qty</span>
                                                <span class="text-warning">
                                                    {{ money($item->cost_price) }}
                                                </span>
                                            </div>


                                            <div class="d-flex justify-content-between border-bottom py-2">
                                                <span>First Sold </span>
                                                <span>
                                                    20 nov 24
                                                    <br>
                                                    2 x 25000
                                                </span>
                                            </div>

                                            <div class="d-flex justify-content-between border-bottom py-2">
                                                <span>last Updated</span>
                                                <span>
                                                    {{ formatDate($item->updated_at) }}
                                                </span>

                                            </div>

                                     
                                            <div class="d-flex justify-content-between border-bottom py-2">
                                                <span>Total Damage</span>
                                                <span class="fw-bold text-success">
                                                    {{ money($item->cost_price) }}
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card mb-3 shadow-sm " style="border-bottom-color: red">
                        <div class="card-body">


                            <div class="row">
                                <div class="col-xl-4 col-lg-6 col-md-12 col-12">
                                    <div class="card shadow-lg mb-4">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                                                <div>
                                                    <span class="fs-6 text-uppercase fw-semi-bold">Sales Total</span>
                                                </div>
                                                <div>
                                                    <span class="fe fe-shopping-bag fs-3 text-primary"></span>
                                                </div>
                                            </div>
                                            <h2 class="fw-bold mb-1">
                                                {{ money(4343) }}
                                            </h2>
                     
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 col-12">
                                    <div class="card  shadow-lg mb-4">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                                                <div>
                                                    <span class="fs-6 text-uppercase fw-semi-bold">Restock</span>
                                                </div>
                                                <div>
                                                    <span class="fe fe-shopping-bag fs-3 text-primary"></span>
                                                </div>
                                            </div>
                                            <h2 class="fw-bold mb-1">
                                                {{ money(7866) }}
                                            </h2>
                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12 col-12">
                                    <div class="card shadow-lg mb-4">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                                                <div>
                                                    <span class="fs-6 text-uppercase fw-semi-bold">Total Expense</span>
                                                </div>
                                                <div>
                                                    <span class="fe fe-shopping-bag fs-3 text-primary"></span>
                                                </div>
                                            </div>
                                            <h2 class="fw-bold mb-1">
                                                {{ money(887) }}
                                            </h2>
                                   
                                        </div>
                                    </div>
                                </div>


                            </div>




                            <button class="btn btn-outline-danger px-5 "> Delete <br> Product</button>
                            <button class="btn btn-outline-primary px-5 "> Edit <br> Product Info</button>
                            <button class="btn btn-outline-warning px-5 "> View <br> Restock History</button>
                        </div>
                    </div>



                </div>


                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex  justify-content-between ">
                                <h5 class="fw-bold">Related Transactions</h5>
                                <a href="/admin/stock/sales/{{ $item->id }}"
                                    class=" btn btn-secondary btn-xs align-middle">View All Transactions</a>
                            </div>
                            <table class="table table-sm mt-2 p-0 ">
                                <thead>
                                    <tr>
                                        <th>Item </th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th>action</th>
                                        <th class="text-end">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recent_sales as $sale)
                                        <tr>
                                            <td>
                                                <span class="fw-bold"> {{ ucfirst($item->name) }}</span>
                                            </td>
                                            <td>


                                                @if ($sale->quantity < 0)
                                                    <span class="text-danger">
                                                        <svg width="10" height="8" viewBox="0 0 8 5" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M4 4.5L0.535898 0L7.4641 0L4 4.5Z" fill="#FF2E2E">
                                                            </path>
                                                        </svg>
                                                        {{ number_format(abs($sale->quantity)) }}
                                                    </span>
                                                @else
                                                    <span class="text-success">
                                                        <svg width="10" height="8" viewBox="0 0 8 5" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M4 0.5L7.4641 5H0.535898L4 0.5Z" fill="#00EC42">
                                                            </path>
                                                        </svg>
                                                        {{ number_format($sale->quantity) }}
                                                    </span>
                                                @endif



                                            </td>
                                            <td> {{ money($sale->price) }} </td>
                                            <td> {{ money(abs($sale->price * $sale->quantity)) }} </td>
                                            <td>
                                                <div class="badge {{ itemAction($sale->action) }} ">
                                                    {{ $sale->action }}
                                                </div>
                                            </td>
                                            <td class="text-end"> {{ formatDate($sale->created_at) }} </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>



                </div>
            @endisset


        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).on('click', '.search_item', function() {
            item = $(this).data('data');
            console.log(item);

            location.href = `/admin/stock-profile/` + item.id;
        });
    </script>
@endpush
