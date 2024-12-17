<nav class="navbar-vertical navbar">
    <div class="nav-scroller">

        <ul class="navbar-nav flex-column" id="sideNavbar">

            {{-- <li class="nav-item">
                <a class="nav-link py-3" href="#">
                    <h2 class="text-white m-0">Mapet Hospital Pos </h2>
                </a>
            </li> --}}

            <li class="nav-item mb-3">
                <a class="nav-link bg-info p-3 text-white" href="/pos?trno={{ rand(111111, 3444444445409) }}">
                    <i class="nav-icon fe fe-home me-2"></i> Point Of Sales
                </a>
            </li>



            <li class="nav-item mb-3">
                <a class="nav-link bg-info p-3 text-white" href="/item/add">
                    <i class="nav-icon fe fe-book me-2"></i> Add New Item
                </a>
            </li>


            <li class="nav-item mb-3">
                <a class="nav-link bg-info p-3 text-white" href="/today_sales/{{ auth()->user()->id }}">
                    <i class="nav-icon fe fe-book me-2"></i>Today's Sales
                </a>
            </li>

    


            
            <li class="nav-item bg-info mb-3">
                <a class="nav-link text-white p-3 " href="/admin/dashboard">
                    <i class="nav-icon fe fe-home me-2"></i> Account Overview
                </a>
            </li>


            <li class="nav-item bg-info mb-3 " style="color: white !important">
                <a class="nav-link  collapsed text-white bg-info p-3 " href="#!" data-bs-toggle="collapse"
                    data-bs-target="#navAuthentication" aria-expanded="false" aria-controls="navAuthentication">
                    <i class="nav-icon fe fe-lock me-2"></i> Stock Management
                </a>
                <div id="navAuthentication" class="collapse " data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column text-white">
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/admin/stock-profile">Stock Profiler</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white"
                                href="/admin/restock-history">Restock History</a>
                        </li>

                    </ul>
                </div>
            </li>


            
            <li class="nav-item bg-info mb-3">
                <a class="nav-link text-white p-3 " href="#" >
                    <i class="nav-icon fe fe-circle me-2"></i> 
                    Out of stock items
                </a>
            </li>


            
            

            <li class="nav-item mb-3 bg-info ">
                <a class="nav-link  collapsed text-white p-3 " href="#!" data-bs-toggle="collapse"
                    data-bs-target="#expsn" aria-expanded="false" aria-controls="expsn">
                    <i class="nav-icon fe fe-users me-2"></i> Expenses Management
                </a>
                <div id="expsn" class="collapse " data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/admin/expenses-overview">Overview </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="/admin/expenses-add">Add Expenses</a>
                        </li>
                    </ul>
                </div>
            </li>



            <li class="nav-item mb-3 bg-info ">
                <a class="nav-link  collapsed text-white p-3 " href="#!" data-bs-toggle="collapse"
                    data-bs-target="#salesreport" aria-expanded="false" aria-controls="salesreport">
                    <i class="nav-icon fe fe-book me-2"></i> Business Report
                </a>
                <div id="salesreport" class="collapse " data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Daily Report</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Report On Weeks</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Monthly Report</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Report accross dates</a>
                        </li>

                    </ul>
                </div>
            </li>





        </ul>

    </div>
</nav>
