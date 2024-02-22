@extends('layout.app')
@section('page_title')
    Add Item
@endsection

@section('page_content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                            <div class="card mb-4">
                                <div class="card-body bg-light py-3 ">
                                    <h2 class="fw-bold m-0">
                                        {{ number_format(App\Models\Item::count()) }}
                                    </h2>
                                    <div class="d-flex align-items-center justify-content-between mb-2 lh-1">
                                        <div>
                                            <span class="fs-6 text-uppercase fw-semi-bold">Items</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                            <div class="card mb-4">
                                <div class="card-body bg-light py-3 ">
                                    <h2 class="fw-bold m-0">
                                        {{ number_format(App\Models\Category::count()) }}
                                    </h2>
                                    <div class="d-flex align-items-center justify-content-between mb-2 lh-1">
                                        <div>
                                            <span class="fs-6 text-uppercase fw-semi-bold"> Categories </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                            <div class="card mb-4">
                                <div class="card-body bg-light py-3 ">
                                    <h2 class="fw-bold m-0">
                                        {{ number_format(App\Models\Item::count()) }}
                                    </h2>
                                    <div class="d-flex align-items-center justify-content-between mb-2 lh-1">
                                        <div>
                                            <span class="fs-6 text-uppercase fw-semi-bold">No. Items</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
                            <div class="card mb-4">
                                <div class="card-body bg-light py-3 ">
                                    <h2 class="fw-bold m-0">
                                        {{ number_format(App\Models\Item::count()) }}
                                    </h2>
                                    <div class="d-flex align-items-center justify-content-between mb-2 lh-1">
                                        <div>
                                            <span class="fs-6 text-uppercase fw-semi-bold">No. Items</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="d-flex">
                                <button type="button" class="btn btn-light add_item me-2 btn-sm py-2 btn-block">
                                    <i class="fe fe-plus-circle"> </i> Add New Item
                                </button>

                                <button type="button" class="btn btn-dark me-3 add_category btn-sm py-2 btn-block">
                                    <i class="fe fe-circle"> </i> Create Item Category
                                </button>

                                <button type="button" class="btn btn-secondary me-2 btn-sm py-2 btn-block">
                                    <i class="fe fe-eye"> </i> View all Categories
                                </button>

                                <button type="button" class="btn btn-info btn-sm open-uploadsheet py-2 btn-block">
                                    <i class="fe fe-upload"> </i> Upload ExcelSheet
                                </button>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-12 col-md-12 col-12">
            <div class="card p-3 mt-3">

                <div class="">
                    <div class="">
                        <form action="/search_product" method="POST">@csrf
                            <input type="search" name="search_product" class="form-control mb-3 shadow"
                                placeholder="Enter Item name and click enter" id="">
                        </form>
                    </div>
                </div>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>item #</th>
                            <th>item Name</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Avail Qty</th>
                            <th class="text-">Price</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td> # {{ $item->id }} </td>
                                <td> <a href="javascript:;">
                                        <h4 class="fw-bold">{{ ucwords($item->name) }}</h4>
                                    </a> </td>
                                <td> {{ $item->brand }} </td>
                                <td> {{ $item->category->category }} </td>
                                <td> {{ $item->description }} </td>
                                <td> {{ itemQty($item->id) }} </td>
                                <td>{{ number_format($item->price) }} </td>
                                <td>
                                    <div class="d-flex justify-content-end ">
                                        <div class="d-flex mt-1">
                                            <a href="javascript:;" class="me-2 editItem"
                                                data-data='{{ json_encode($item) }}'>
                                                <i class="fe fe-edit"></i>
                                            </a>
                                            <a href="javascript:;" class="text-danger">
                                                <i class="fe fe-trash"></i>
                                            </a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="nav d-flex mt-3 justify-content-end ">
                {{ $items->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_item" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fw-bold mb-0" id="newCatgoryLabel">
                        Add Item
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fe fe-x-circle"></i></span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="POST" class="row" action="/item/add">
                        @csrf
                        <div class="alert alert-warning">
                            Fill the form below to add new item
                        </div>
                        <div class="col-lg-8 mb-2 ">
                            <label class="form-label">Item Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control py-1" placeholder="Item Name" required
                                autocomplete="zpo">
                        </div>
                        <div class="col-lg-4 mb-2 ">
                            <label class="form-label">Brand <span class="text-danger">*</span></label>
                            <input type="text" name="brand" class="form-control py-1" placeholder="Brand name"
                                required autocomplete="zpo">
                        </div>
                        <div class="col-lg-6 mb-2 ">
                            <label class="form-label">Category<span class="text-danger">*</span></label>
                            <select class="form-control py-1" name="category_id">
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"> {{ $cat->category }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-6 ">
                            <label class="form-label">Price<span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control py-1"
                                placeholder="Enter Item Price" required>
                        </div>

                        <div class="col-lg-12 mb-3 mb-3 mt-2">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control py-1" rows="1"></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn py-2 btn-primary">Save Item</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="uploadsheet" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fw-bold mb-0" id="newCatgoryLabel">
                        Add Items From Excel File
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fe fe-x-circle"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" class="row" action="/upload-excel" enctype="multipart/form-data">
                        @csrf
                        <div class="alert alert-warning">
                            Select your excel file to upload and add items
                            <br>
                            <b>Note:</b> Items that already exists will be skipped and will not be added
                        </div>
                        <div class="col-lg-12 mb-2 ">
                            <label class="form-label">File<span class="text-danger">*</span></label>
                            <input type="file" name="file" class="form-control form-control-lg " required
                                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn py-2 btn-primary">Save Item</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mb-0">
                        Edit Item
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fe fe-x-circle"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/item/update" class="row">@csrf
                        <div class="col-lg-8 mb-2 ">
                            <label class="form-label">Item Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control py-1" placeholder="Item Name"
                                required>
                            <input type="hidden" name="id">
                        </div>
                        <div class="col-lg-4 mb-2 ">
                            <label class="form-label">Brand <span class="text-danger">*</span></label>
                            <input type="text" name="brand" class="form-control py-1" placeholder="Brand name"
                                required autocomplete="zpo">
                        </div>
                        <div class="col-lg-6 ">
                            <label class="form-label">Price<span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control py-1"
                                placeholder="Enter Item Price" required>
                        </div>

                        <div class="col-lg-6 mb-2 ">
                            <label class="form-label">Category<span class="text-danger ">*</span></label>
                            <select class="form-control py-1 " name="category_id">
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"> {{ $cat->category }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12 mb-3 mb-3 mt-2">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control py-1" rows="1"></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn py-2 btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="add_category" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fw-bold mb-0" id="newCatgoryLabel">
                        Add Item Category
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fe fe-x-circle"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" class="row" action="/category/add"> @csrf
                        <div class="alert alert-warning">
                            Fill the form below to add new item category
                        </div>
                        <div class="col-lg-12 mb-2 ">
                            <label class="form-label">Category Name<span class="text-danger">*</span></label>
                            <input type="text" name="category" class="form-control py-1" placeholder="Category Name"
                                required="">
                        </div>
                        <div class="col-lg-12 mb-3 mb-3 mt-2">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control py-1" rows="1"></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn py-2 btn-primary">Add Category</button>
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
            $('.add_item').on('click', function() {
                $('#add_item').modal('show');
            })

            $('.add_category').on('click', function() {
                $('#add_category').modal('show');
            })

            $('.open-uploadsheet').on('click', function() {
                $('#uploadsheet').modal('show');
            })



            $('.editItem').on('click', function() {
                data = $(this).data('data');
                console.log(data);
                modal = $('#editModal');
                form = modal.find('form');
                form.find('input[name="id"]').val(`${data.id}`)
                form.find('input[name="name"]').val(`${data.name}`)
                form.find('input[name="brand"]').val(`${data.brand}`)
                form.find('input[name="price"]').val(`${data.price}`)
                form.find('select[name="category_id"]').val(`${data.category_id}`);
                form.find('textarea[name="description"]').html(`${data.description}`)
                modal.modal('show');
            });

        })
    </script>
@endpush
