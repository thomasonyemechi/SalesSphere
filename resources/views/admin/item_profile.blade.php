@extends('layout.admin')
@section('page_title')
    Stock Profile | {{ $item->name }}
@endsection

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
                                    <a href="#">{{ $item->name }}</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">
                        <button class="btn btn-outline-white  active" data-bs-toggle="tab" data-bs-target="#tabPaneGrid"
                            role="tab" aria-controls="tabPaneGrid" aria-selected="true">
                            Search Item
                        </button>
                    </div>
                </div>
            </div>



            <div class="col-md-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between  ">
                        <h5 class="mb-0 fw-bold ">General Item Details</h5>
                        <button class="btn btn-primary py-0">Update Info</button>
                    </div>

                    <div class="card-body">
                        <div class="text-center" >
                            <img src="{{ Avatar::create($item->name)->toBase64() }}" />
                            <h2 class="fw-bold mt-2" > {{$item->name}} </h2>
                        </div>
                 
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span>Pricing</span>
                            <span class="text-warning">
                                {{money($item->price)}}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span>Product Code</span>
                            <span>
                                
                            </span>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span>Description</span>
                            <span>
                                {{$item->description}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class=" fw-bold ">Inventory Details</h5>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span>Current Stock</span>
                            <span class="text-warning">
                                {{money($item->price)}}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span>Restock Quantity</span>
                            <span>
                                
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class=" fw-bold ">Recent Suppliers Details</h5>

                        <table class="table table-sm mt-3 p-0 " >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th></th>
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
                        <h5 class="mb-0">Product Catrgory</h5>
                        <h3 class="fw-bold mb-0 mt-0" > {{$item->category->category}} </h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card" >
                    <div class="card-body" >
                        <h5 class="fw-bold">Recent Sales</h5>
                        <table class="table table-sm mt-2 p-0 " >
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

                <div class="card mt-3" >
                    <div class="card-body" >
                        <h5 class="fw-bold ">Restock History</h5>
                        <table class="table table-sm mt-2 p-0 " >
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


                <div class="card mt-3" >
                    <div class="card-body" >
                        <h5 class="fw-bold ">Returns </h5>
                        <table class="table table-sm mt-2 p-0 " >
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
@endsection
