@extends('layout.app')
@section('page_title')
    Add Item Category
@endsection

<style>
    .tb-body {
        transform: underline;

        background: rgb(239, 238, 233);
    }
</style>

@section('page_content')
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-md-7">
                    <form class="d-flex align-items-center" action="/search_item">
                        <span class="position-absolute ps-3 py-1 search-icon">
                            <i class="fe fe-search"></i>
                        </span>
                        <input type="search" name="item" autocomplete="fe" class="form-control  form-control-sm ps-6 py-1"
                            placeholder="Search Category" />
                    </form>
                </div>

                <div class="col-md-3">
                    <button class="btn btn-primary add_category btn-sm py-2" style="width:  100%">
                        <i class="fe fe-plus-circle"> </i>
                        Add New
                        Category</button>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-secondary btn-sm py-2 btn-block" style="width:  100%">
                        <i class="fe fe-eye"> </i> View Items</button>
                </div>
            </div>
        </div>


        <div class="col-lg-12 col-md-12 col-12">

            <div class="card p-3 mt-3">
                <div class="row cart-head " style="font-weight: 600">
                    <div class="col-1">
                        <span>#</span>
                    </div>
                    <div class="col-3">
                        <span>Category Name</span>
                    </div>
                    <div class="col-5">
                        <span>Description</span>
                    </div>
                    <div class="col-1">
                        <div class="d-flex justify-content-end ">
                            <span>Items</span>
                        </div>
                    </div>
                    <div class="col-2">

                    </div>
                </div>


                @foreach ($categories as $cat)
                    <div class="row tb-body my-2 py-2">
                        <div class="col-1">
                            <span> # {{ $cat->id }}</span>
                        </div>
                        <div class="col-3">
                            <span> {{ $cat->category }} </span>
                        </div>
                        <div class="col-5">
                            <span>{{ $cat->description }}</span>
                        </div>
                        <div class="col-1">
                            <div class="d-flex justify-content-end ">
                                <span>0</span>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="d-flex justify-content-end ">
                               <div class="d-flex mt-1" >
                                <a href="javascript:;" class="me-2" >
                                    <i class="fe fe-edit"></i>
                                </a>
                                <a href="javascript:;" class="text-danger" >
                                    <i class="fe fe-trash"></i>
                                </a>
                            
                               </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>


    <div class="modal fade" id="add_category" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fw-bold mb-0" id="newCatgoryLabel">
                        Add Book Category
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
            $('.add_category').on('click', function() {
                $('#add_category').modal('show');
            })

        })
    </script>
@endpush
