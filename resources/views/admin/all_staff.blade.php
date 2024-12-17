@extends('layout.app')
@section('page_title')
    Manage Staff
@endsection

@section('page_content')
    <div class="col-xl-12">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class=" pb-4 mb-2 d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">
                            All Staff
                        </h1>
                        <!-- Breadcrumb  -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Staff</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Add Staff
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="nav btn-group" role="tablist">
                        <div class="">
                            <form action="" method="POST">
                                <input type="search" class="form-control me-2" placeholder="Search staff" name="search_user">
                            </form>
                        </div>
                        <a class="btn btn-outline-white  active" href="/admin/add_staff" >
                            Add Staff
                        </a>
                    </div>
                </div>
            </div>



            <div class="row">
                @foreach ($staffs as $staff)
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="card contact_list text-center">
                            <div class="card-body">
                                <div class="user-content">
                                    <div class="user-info">
                                        <div class="user-img">
                                            <img src="{{ Avatar::create($staff->name)->toBase64() }}" class="rounded-circle "  style="width: 50px"  />
                                        </div>
                                        <div class="user-details mt-2">
                                            <h4 class="user-name fw-bold mb-0">{{ $staff->name }}</h4>
                                            <p>{{ $staff->role }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="contact-icon  mb-2 mt-0">
                                    <span class="badge bg-success light">{{ $staff->phone }}</span>
                                    <span class="badge bg-danger light">{{ date('j M, Y', strtotime($staff->created_at)) }}</span>
                                </div>
                                <div class="d-flex justify-content-center ">
                                    <a href="/admin/staff/{{ $staff->id }}" class=" btn-sm w-50 me-2"><i
                                            class="fa fa-user me-2"></i>Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
