@extends('layout.app')
@section('page_title')
    Add Item
@endsection

@section('page_content')
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-md-9">
                    <form class="d-flex align-items-center" action="/search_item">
                        <span class="position-absolute ps-3 py-1 search-icon">
                            <i class="fe fe-search"></i>
                        </span>
                        <input type="search" name="item" autocomplete="fe" class="form-control  form-control-sm ps-6 py-1"
                            placeholder="Scan Item or enter item information" />
                    </form>
                </div>

                <div class="col-md-3">
                    <button type="button" class="btn btn-primary add_item btn-sm py-2 btn-block" style="width:  100%">
                        <i class="fe fe-plus-circle"> </i>
                        Add New
                        Item</button>
                </div>
            </div>
        </div>


        <div class="col-lg-12 col-md-12 col-12">



            <div class="card p-3 mt-3">

                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>item #</th>
                            <th>item Name</th>
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
                                <td> {{ $item->category->category }} </td>
                                <td> {{ $item->description }} </td>
                                <td></td>
                                <td>{{ $item->price }} </td>
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
                        <div class="col-lg-12 mb-2 ">
                            <label class="form-label">Item Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control py-1" placeholder="Item Name" required
                                autocomplete="zpo">
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
                            <input type="number" name="price" class="form-control py-1" placeholder="Enter Item Price"
                                required>
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
                    <form method="POST" action="/item/update"  class="row">@csrf
                        <div class="col-lg-12 mb-2 ">
                            <label class="form-label">Item Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control py-1" placeholder="Item Name"
                                required>
                            <input type="hidden" name="id">
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
@endsection


@push('scripts')
    <script>
        $(function() {
            $('.add_item').on('click', function() {
                $('#add_item').modal('show');
            })


            $('.editItem').on('click', function() {
                data = $(this).data('data');
                console.log(data);
                modal = $('#editModal');
                form = modal.find('form');
                form.find('input[name="id"]').val(`${data.id}`)
                form.find('input[name="name"]').val(`${data.name}`)
                form.find('input[name="price"]').val(`${data.price}`)
                form.find('select[name="category_id"]').val(`${data.category_id}`);
                form.find('textarea[name="description"]').html(`${data.description}`)
                modal.modal('show');
            });

        })
    </script>
@endpush
