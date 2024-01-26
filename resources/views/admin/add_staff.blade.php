@extends('layout.admin')
@section('page_title')
    Add New Staff
@endsection

@section('page_content')
    <div class="col-xl-12">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class=" pb-4 mb-2 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            Add New Staff
                            <span class="fs-5 text-muted">(12,105)</span>
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Staff</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Add Staff
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">
                        <button class="btn btn-outline-white  active" data-bs-toggle="tab" data-bs-target="#tabPaneGrid"
                            role="tab" aria-controls="tabPaneGrid" aria-selected="true">
                            View all Staff
                        </button>
                    </div>
                </div>
            </div>



            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 fw-bold ">Personal Details</h5>
                    </div>
                    <div class="card-body">
                        <form action="/admin/add_staff" method="post"> @csrf
                            <div class="row">
                                <div class="col-xl-6 col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label text-primary">Full Name<span
                                                class="required">*</span></label>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            class="form-control" placeholder="James">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label text-primary">Email<span class="required">*</span></label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="form-control" placeholder="hello@example.com">
                                    </div>


                                </div>
                                <div class="col-xl-6 col-sm-6">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="mb-3">
                                                <label class="form-label text-primary">Staff
                                                    Role<span class="required">*</span></label>
                                                <select name="role" class="form-control">
                                                    <option>Sales Rep</option>
                                                    <option>Administrator</option>
                                                    <option>Accountant</option>
                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label text-primary">Phone
                                            Number<span class="required">*</span></label>
                                        <input type="number" name="phone" value="{{ old('phone') }}"
                                            class="form-control" placeholder="+123456789">
                                    </div>

                                </div>
                                <div class="col-xl-12 col-sm-6">
                                    <div class="d-flex justify-content-end ">
                                        <button class="btn btn-primary">Save Details</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="{{ asset('assets/vendor/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js') }}"></script>

    <script>
        $(function() {

        })
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });
        $('.remove-img').on('click', function() {
            var imageUrl = "assets/images/no-img-avatar.png";
            $('.avatar-preview, #imagePreview').removeAttr('style');
            $('#imagePreview').css('background-image', 'url(' + imageUrl + ')');
        });
    </script>
@endpush
