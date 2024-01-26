<div class="header">
    <!-- navbar -->
    <nav class="navbar-default navbar navbar-expand-lg">
        <a id="nav-toggle" href="#">
            <i class="fe fe-menu"></i>
        </a>

        <h4 class="fw-bold mx-2 fs-3 mt-2 "> SalesSphere </h4>

        <!--Navbar nav -->
        <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
            <li class="dropdown ms-2 mt-1">
                <a class="dropdown-item bold fw-bold" href="/">
                    Point of Sales
                </a>
            </li>
            <li class="dropdown ms-2 mt-1">
                <a class="dropdown-item bold fw-bold" href="/">
                    Purchasing
                </a>
            </li>
            <li class="ms-2 mt-1">
                <a class="dropdown-item bg-light fs-4 fw-bold " href="javascript:;">
                    <span id="current_date"></span> {{ date('D, M j') }}
                </a>
            </li>
            <li class="dropdown ms-2">
                <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="avatar avatar-md avatar-indicators avatar-online">
                        <img alt="avatar" src="{{ Avatar::create(auth()->user()->name)->toBase64() }}"
                            class="rounded-circle" />
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                    <div class="dropdown-item">
                        <div class="d-flex">
                            <div class="avatar avatar-md avatar-indicators avatar-online">
                                <img alt="avatar" src="{{ Avatar::create(auth()->user()->name)->toBase64() }}"
                                    class="rounded-circle" />
                            </div>
                            <div class="ms-3 lh-1">
                                <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                                <p class="mb-0 text-muted"> {{ auth()->user()->email }} </p>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <ul class="list-unstyled">
                        @if (auth()->user()->role == 'administrator')
                            <li>
                                <a class="dropdown-item" href="/admin/dashboard">
                                    <i class="fe fe-user me-2"></i> Access Administrator
                                </a>
                            </li>
                        @endif
                    </ul>
                    <div class="dropdown-divider"></div>
                    <ul class="list-unstyled">

                        <li>
                            <a class="dropdown-item" href="/logout">
                                <i class="fe fe-power me-2"></i> Sign Out
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
</div>




<script>
    function updateDateTime() {
        const now = new Date();
        let hour = now.getHours();
        let minute = now.getMinutes();
        document.querySelector('#current_date').textContent = `${hour}:${minute}`;
    }
    setInterval(updateDateTime, 1000);
</script>
