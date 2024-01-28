@extends('layout.admin')
@section('page_title')
    Staff Profile | {{ $user->name }}
@endsection

@section('page_content')
    <div class="col-xl-12">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class=" pb-4 mb-2 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Staff Profile
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Staffs </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">{{ $user->name }}</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">
                        <div class="input-group me-3  ">

                            <select name="" class="form-control flatpickr-input ">
                                @foreach ($users as $staff)
                                    <option value="{{ $staff->id }}"> {{ $staff->name }} | {{ $staff->phone }} </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between  ">
                        <h5 class="mb-0 fw-bold ">Staff Details</h5>
                        {{-- <button class="btn btn-primary py-0">Update Info</button> --}}
                    </div>

                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ Avatar::create($user->name)->toBase64() }}" />
                            <h2 class="fw-bold mt-2"> {{ $user->name }} | {{ $user->role }} </h2>
                        </div>

                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span>Phone</span>
                            <span class="text-warning">
                                {{ $user->phone }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span>Email</span>
                            <span>
                                {{ $user->email }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span>Salary</span>
                            <span>
                                {{ $user->salary }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class=" fw-bold ">Sales Details</h5>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span>Total Sales</span>
                            <span class="text-warning">
                                {{-- {{money($item->price)}} --}}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span>Average Transaction</span>
                            <span>

                            </span>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span>Items Sold</span>
                            <span>

                            </span>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between ">
                            <h5 class=" fw-bold ">Acccess Hours</h5>
                            <a href="#" class="text-primary fw-bold "> <i class="fa fa-clock"></i> Modify Access
                                Hours</a>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span>Total Sales</span>
                            <span class="text-warning">
                                {{-- {{money($item->price)}} --}}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span>Average Transaction</span>
                            <span>

                            </span>
                        </div>
                    </div>
                </div>


                <div class="card mt-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between ">
                            <h5 class=" fw-bold ">Login History</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm mt-2 p-0 ">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="fw-bold">Recent Sales</h5>
                        <table class="table table-sm mt-2 p-0 ">
                            <thead>
                                <tr>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="fw-bold ">Restock History</h5>
                        <table class="table table-sm mt-2 p-0 ">
                            <thead>
                                <tr>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="fw-bold ">Returns </h5>
                        <table class="table table-sm mt-2 p-0 ">
                            <thead>
                                <tr>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <div class="modal fade" id="modify_userhours" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 ">
                    <h4 class="modal-title fw-bold mb-0" id="newCatgoryLabel">
                        Manage Staff Hours
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fe fe-x-circle"></i></span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="POST" class="row" action="/admin/staff-hours">
                        @csrf
                        <div class="col-lg-12 mb-2 ">

                            @php
                                $hours = json_decode($staff->user_hours);
                            @endphp


                            @foreach ($hours as $day => $key)
                            
                                <h6 class="fw-bold mb-0">{{ strtoupper($day) }} </h6>
                                    <div class="row d-flex justify-content-between mb-2 ">
                                        <div class="col-6">
                                            <input type="time" name="{{$day}}_start" class="form-control form-control-sm "
                                             value="{{$key->start}}" required >
                                        </div>

                                        <div class="col-6">
                                            <input type="time" name="{{$day}}_stop" class=" form-control form-control-sm "
                                             value="{{$key->stop}}" required>
                                        </div>
                                    </div>
                            @endforeach


                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn py-2 btn-primary btn-sm">Update Hours</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(function() {
            //$('#modify_userhours').modal('show');
        })
    </script>
@endpush
