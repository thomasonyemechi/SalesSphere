@extends('layout.admin')
@section('page_title')
    Sales Overview
@endsection

@section('page_content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-4 mb-4 d-md-flex justify-content-between align-items-center">
                <div class="mb-3 mb-md-0">
                    <h1 class="mb-0 h2 fw-bold"> Admin Overview </h1>
                </div>
                <div class="d-flex">
                    <div class="input-group me-3  ">

                        <select name="" class="form-control flatpickr-input " id=""
                            style="width: 150px !important;">
                            @for ($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}" {{ $m == $mth ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $m, 10)) }} </option>
                            @endfor
                        </select>

                    </div>
                    <a href="/admin/add-expenses" class="btn btn-primary">Overview </a>
                </div>
            </div>
        </div>


        <div class="row">



            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                                            <div>
                                                <span class="fs-6 text-uppercase fw-semi-bold">Sales</span>
                                            </div>
                                            <div>
                                                <span class="fe fe-shopping-bag fs-3 text-primary"></span>
                                            </div>
                                        </div>
                                        <h2 class="fw-bold mb-1">
                                            {{ money($sales_total) }}
                                        </h2>
                                        <span class="text-success fw-semi-bold"><i
                                                class="fe fe-trending-up me-1"></i>+{{ number_format($sales_count) }}</span>
                                        <span class="ms-1 fw-medium">Number of sales</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                                <div class="card mb-4">
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
                                            {{ money($restock_total) }}
                                        </h2>
                                        <span class="text-success fw-semi-bold">{{ $restock_count }}</span>
                                        <span class="ms-1 fw-medium">Restocks</span>
                                        <span class="text-success fw-semi-bold"> {{ $clients }} </span>
                                        <span class="ms-1 fw-medium">Clients</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                                <div class="card mb-4">
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
                                            {{ money($expense_total) }}
                                        </h2>
                                        <span class="text-success fw-semi-bold"><i
                                                class="fe fe-trending-up me-1"></i>{{ $expense_categories }} </span>
                                        <span class="ms-1 fw-medium">Expense Categories</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                                            <div>
                                                <span class="fs-6 text-uppercase fw-semi-bold">Items</span>
                                            </div>
                                            <div>
                                                <span class="fe fe-shopping-bag fs-3 text-primary"></span>
                                            </div>
                                        </div>
                                        <h2 class="fw-bold mb-1">
                                            {{ number_format(App\Models\Item::count()) }}
                                        </h2>
                                        <span class="text-danger fw-semi-bold">{{ $suppliers }} </span>
                                        <span class="ms-1 fw-medium">Suppliers</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="d-flex">
                                    <a type="button" href="/admin/expense-overview"
                                        class="btn btn-light add_item me-2 btn-sm py-2 btn-block">
                                        <i class="fe fe-credit-card"> </i> Expense Overview
                                    </a>

                                    <a href="/admin/staffs" class="btn btn-dark me-3 add_category btn-sm py-2 btn-block">
                                        <i class="fe fe-users"> </i> Manage Users
                                    </a>

                                    <button type="button" class="btn btn-secondary btn-sm py-2 btn-block">
                                        <i class="fe fe-eye"> </i> Make restock
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 col-lg-12 col-md-12 col-12">
                <div class="card mb-4">
                    <div class="card-body" style="position: relative;">
                        <h4 class="fw-bold">Sales Accross Month</h4>

                        <canvas id="expense_chart"></canvas>
                    </div>
                </div>



                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-1 ">
                            <h5 class="fw-bold">Recent Sales</h5>
                            <a href="#" class="btn btn-primary py-1">Sales History</a>
                        </div>


                        <div class="table-responsive">
                            <table class="table table-sm " style="border: 0 !important">
                                <thead>
                                    <tr>
                                        <th>#id</th>
                                        <th colspan="2">Items</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="">

                                    @foreach ($sales_history as $sales)
                                        <tr>
                                            <td>{{ $loop->iteration }} </td>
                                            <td colspan="2">
                                                
                                                    @foreach ($sales->sales as $sale)
                                                        <b>{{ $sale->item->name }} </b>({{$sale->quantity}}) ,
                                                    @endforeach
                                            </td>
                                            <td> {{ money($sales->total) }} </td>
                                            <td>
                                                <a href="#" class="text-info p-1 m-0" >
                                                    <i class="fa fa-print" ></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-12 col-md-12 col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2 ">
                            <h5 class="fw-bold">Staffs</h5>
                            <a href="/admin/staffs" class="fw-bold">View all</a>
                        </div>

                        <div class="row">

                            @foreach (\App\Models\User::limit(12)->get() as $staff)
                                <div class="col-md-4">
                                    <div class="user-content text-center">
                                        <div class="user-info">
                                            <div class="user-img">
                                                <img src="{{ Avatar::create($staff->name)->toBase64() }}"
                                                    class="rounded-circle " style="width: 50px" />
                                            </div>
                                            <div class="user-details  mt-0">
                                                <a href="/admin/staff/{{ $staff->id }}">
                                                    <h4 class="user-name fw-bold mb-0">{{ $staff->name }} </h4>
                                                </a>
                                                <p>{{ $staff->role }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>


                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between ">
                            <h5 class="fw-bold">Staff Logins</h5>
                    
                        </div>
                        <div class="table-responsive" >
                            <table class="table table-sm" >
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Action</th>
                                        <th>Timestamp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($logins as $login)
                                        <tr>
                                            <td class="fw-bold" > {{$login->staff->name}} </td>
                                            <td> {{$login->action}} </td>
                                            <td> {{$login->created_at}} </td>
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
@endsection

@push('scripts')
    <script>
        $.ajax({
            method: 'get',
            url: '/admin/get_expense_graph_info'
        }).done(function(res) {
            var myChart = new Chart(document.getElementById('expense_chart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: res.data.month,
                    datasets: [{
                        label: '',
                        data: res.data.expense,
                        backgroundColor: res.data.color,
                        hoverOffset: 4
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });


        }).fail(function(res) {
            console.log(res);
        })
    </script>
@endpush
