@extends('layout.admin')
@section('page_title')
    Add Expenses
@endsection

@section('page_content')
    <div class="col-xl-12">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class=" pb-4 mb-2 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Manage Expenses
                        </h1>
                    </div>
                    <div class="nav btn-group" role="tablist">
                        <a class="btn btn-outline-white  active" href="/admin/expenses-overview">
                            Expense Overview
                        </a>
                    </div>
                </div>
            </div>



            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex mb-3 justify-content-between">
                            <h4 class="fw-bold">Add Expenses</h4>
                            <button class="btn btn-secondary py-0 btn-sm" data-bs-toggle="modal"
                                data-bs-target="#add_item">Create Expense Category</button>
                        </div>
                        <form action="/admin/create-expenses" method="post"> @csrf
                            <div class="row">
                                <div class="col-xl-6 col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Expenses Category</label>
                                        <select name="category_id" class="form-control">
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}"> {{ $cat->title }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <label class="form-label ">Amount<span class="required">*</span></label>
                                        <input type="number" name="amount" value="{{ old('amount') }}"
                                            class="form-control" placeholder="300000">
                                    </div>
                                </div>
                                <div class="col-xl-12 col-sm-12">
                                    <div class="mb-3">
                                        <label for="">Remark</label>
                                        <textarea name="remark" class="form-control" cols="2"></textarea>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-sm-6">
                                    <div class="d-flex justify-content-end ">
                                        <button class="btn btn-primary">Save Expenses</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-lg-12 col-md-12 mt-3 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card header -->
                    <div class="card-header border-bottom-0 fw-bold">
                        All Expenses
                    </div>
                    <!-- Table -->
                    <div class="table-responsive border-0 overflow-y-hidden">
                        <table class="table mb-0 text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0">Expense </th>
                                    <th class="border-0">Amount</th>
                                    <th class="border-0">Remark</th>
                                    <th class="border-0">Add By </th>
                                    <th class="border-0">DATE</th>
                                    <th class="border-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expenses as $expense)
                                    <tr>
                                        <td class="align-middle border-top-0">
                                            <a href="#" class="text-inherit position-relative">
                                                <h5 class="mb-0 fw-bold text-primary-hover">
                                                    {{ $expense->category->title }}
                                                </h5>
                                            </a>
                                        </td>
                                        <td class="align-middle border-top-0">
                                            {{ money($expense->amount) }}
                                        </td>
                                        <td class="align-middle border-top-0">{{ $expense->remark }}</td>
                                        <td class="align-middle border-top-0">
                                            {{ $expense->user->name }}
                                        </td>
                                        <td class="align-middle border-top-0">
                                            {{ $expense->created_at }}
                                        </td>
                                        <td class="align-middle border-top-0">
                                            <div class="d-flex justify-content-end ">
                                                <a class="text-danger"> <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="add_item" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 ">
                    <h4 class="modal-title fw-bold mb-0" id="newCatgoryLabel">
                        Create Expenses Cateogry
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fe fe-x-circle"></i></span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="POST" class="row" action="/admin/create-expenses-category">
                        @csrf
                        <div class="alert alert-warning">
                            Fill the form below to add new expenses category
                        </div>
                        <div class="col-lg-12 mb-2 ">
                            <label class="form-label">Category Name<span class="text-danger">*</span></label>
                            <input type="text" name="category_name" class="form-control " placeholder="Category Name"
                                required autocomplete="zpo">
                        </div>

                        <div class="col-lg-12 mb-3 mb-3 mt-2">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn py-2 btn-primary">Save Category</button>
                        </div>
                    </form>

                    <hr>

                    <div class="table-responsive mt-3 border-0 overflow-y-hidden">

                        <h4 class="fw-bold">Category List</h4>
                        <table class="table mb-0 text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0">Category </th>
                                    <th class="border-0">Description</th>
                                    <th class="border-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $cat)
                                    <tr>
                                        <td> {{ $cat->title }} </td>
                                        <td> {{ $cat->description }} </td>
                                        <td>
                                            <div class="d-flex justify-content-end ">
                                                <a class="text-danger" href="/admin/delete_expenses_category/{{$cat->id}}"> <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(function() {

        })
    </script>
@endpush
