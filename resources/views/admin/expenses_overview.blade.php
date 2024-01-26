@extends('layout.admin')
@section('page_title')
    Expenses Overview
@endsection

@section('page_content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @php
        $data = [
            'labels' => ['January', 'February', 'March', 'April', 'May'],
            'data' => [65, 59, 80, 81, 56],
        ];
    @endphp

    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-4 mb-4 d-md-flex justify-content-between align-items-center">
                <div class="mb-3 mb-md-0">
                    <h1 class="mb-0 h2 fw-bold"> {{ date('F') }} Expenses </h1>
                </div>
                <div class="d-flex">
                    <div class="input-group me-3  ">

                        <select name="" class="form-control flatpickr-input " id=""
                            style="width: 150px !important;">
                            @for ($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}"> {{ date('F', mktime(0, 0, 0, $m, 10)) }} </option>
                            @endfor
                        </select>

                    </div>
                    <a href="/admin/add-expenses" class="btn btn-primary">Expenses</a>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="fs-6 text-uppercase fw-semi-bold">Expense Count</span>
                            </div>
                            <div>
                                <span class="fe fe-shopping-bag fs-3 text-primary"></span>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-1">
                            200
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="fs-6 text-uppercase fw-semi-bold">Amount</span>
                            </div>
                            <div>
                                <span class=" fe fe-book-open fs-3 text-primary"></span>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-1">
                            $ 2,456
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="fs-6 text-uppercase fw-semi-bold">Salary</span>
                            </div>
                            <div>
                                <span class=" fe fe-users fs-3 text-primary"></span>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-1">
                            1,22,456
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                            <div>
                                <span class="fs-6 text-uppercase fw-semi-bold">Instructor</span>
                            </div>
                            <div>
                                <span class=" fe fe-user-check fs-3 text-primary"></span>
                            </div>
                        </div>
                        <h2 class="fw-bold mb-1">
                            22,786
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-12 col-md-12 col-12">
                <div class="card mb-4">
                    <div class="card-body" style="position: relative;">
                        <h4 class="fw-bold">Expense accross expense title</h4>

                        <canvas id="expense_chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-12 col-md-12 col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="fw-bold">Expenses Accross Weeks</h4>
                        <canvas id="barChart"></canvas>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script>
        var ctx = document.getElementById('barChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [
                    'Week 1',
                    'Week 2',
                    'Week 3',
                    'Week 4'
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [300, 50, 100, 548],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(25, 205, 86)',
                    ],
                    hoverOffset: 4
                }]
            },

        });



        var myChart = new Chart(document.getElementById('expense_chart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: [
                    'Week 1',
                    'Week 2',
                    'Week 3',
                    'Week 4'
                ],
                datasets: [{
                    label: '',
                    data: [462, 242, 750, 320],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(25, 205, 86)',
                    ],
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
    </script>
@endsection
