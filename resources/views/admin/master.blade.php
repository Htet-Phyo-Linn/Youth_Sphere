<!DOCTYPE html>
<html lang="en">
{{-- {{ asset('admin/')}} --}}

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Youth Sphere Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/feather/feather.css') }} ">
    <link rel="stylesheet" href="{{ asset('admin/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('admin/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        /* Entry Select Style */
        .dataTables_wrapper .dataTables_length {
            margin-bottom: 20px;
            /* Space below the select */
        }

        .dataTables_wrapper .dataTables_length select {
            padding: 0.375rem 0.75rem;
            height: 30px;
            /* Padding */
            border: 1px solid #198754 !important;
            /* Border color */
            border-radius: 40px !important;
            /* Rounded corners */
            background-color: white !important;
            /* Background color */
            border: 1px solid #198754 !important;
            /* Text color */
            transition: border-color 0.3s;
        }

        .dataTables_wrapper .dataTables_length select:hover {
            border-color: #198754 !important;
            /* Darker border on hover */
        }

        /* Pagination Button Group */
        .dataTables_wrapper .dataTables_paginate {
            margin-top: 20px;
            /* Space above the pagination */
        }

        /* Active Pagination Button Style */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #198754 !important;
            /* Active button background color */
            color: white !important;
            /* Active button text color */
            border: none;
            /* Remove border for active button */
        }

        /* Hover Effect for Active Pagination Button */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            /* background-color: #155724 !important; */
            /* Darker green on hover for active button */
            /* color: white !important; */
            /* Keep text color white on hover */
        }

        /* Regular Pagination Button Hover Effect */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5rem 1rem;
            /* Padding */
            margin: 0 2px;
            /* Space between buttons */
            border: 1px solid #198754 !important;
            /* Border color */
            border-radius: 30px !important;
            /* Rounded corners */
            background-color: white !important;
            /* Background color */
            color: #198754 !important;
            /* Text color */
            transition: background-color 0.3s, color 0.3s !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            /* background-color: #198754 !important; */
            /* Background on hover for non-active buttons */
            /* color: white !important; */
            /* Text color on hover for non-active buttons */
        }

        /* General Styles for the Custom Nav Item */
        .cus-nav-item {
            margin-bottom: 0.5rem;
            /* Add some space between items */
        }

        /* Default State */
        .cus-nav-item .nav-link {
            /* background-color: #e8eff4; */
            background: white;
            /* Background for inactive state */
            color: rgba(0, 0, 0, 0.823);
            /* Text color for inactive state */
            padding: 0.5rem 1rem;
            /* Padding for better touch targets */
            border-radius: 0.375rem;
            /* Rounded corners */
            text-decoration: none;
            /* Remove underline from links */
            transition: background-color 0.3s, color 0.3s;
            /* Smooth transition for hover */
        }

        /* Active State */
        .cus-nav-item .nav-link.active {
            background-color: #4B49AC;
            /* Background color when active */
            color: white;
            /* Text color when active */
        }

        /* Hover Effect for Inactive State */
        .cus-nav-item .nav-link:hover {
            background-color: #4B49AC;
            /* Light background on hover */
            color: white;
            /* Slightly darker text on hover */
        }

        /* Hover Effect for Active State (Optional) */
        .cus-nav-item .nav-link.active:hover {
            background-color: #35339fda;
            /* Darker green when hovering over active */
            color: white;
            /* Keep text white */
        }
    </style>



</head>


<body>

    <body>
        <div class="container-scroller">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo mr-5" href="{{ route('dashboard') }}"><img src="images/logo.svg"
                            class="mr-2" alt="logo" /></a>
                    <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}"><img
                            src="images/logo-mini.svg" alt="logo" /></a>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>

                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                                data-toggle="dropdown">
                                <i class="icon-bell mx-0"></i>
                                <span class="count"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="notificationDropdown">
                                <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-success">
                                            <i class="ti-info-alt mx-0"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <h6 class="preview-subject font-weight-normal">Application Error</h6>
                                        <p class="font-weight-light small-text mb-0 text-muted">
                                            Just now
                                        </p>
                                    </div>
                                </a>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-warning">
                                            <i class="ti-settings mx-0"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <h6 class="preview-subject font-weight-normal">Settings</h6>
                                        <p class="font-weight-light small-text mb-0 text-muted">
                                            Private message
                                        </p>
                                    </div>
                                </a>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-info">
                                            <i class="ti-user mx-0"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <h6 class="preview-subject font-weight-normal">New user registration</h6>
                                        <p class="font-weight-light small-text mb-0 text-muted">
                                            2 days ago
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"
                                id="profileDropdown">
                                <img src="images/faces/face28.jpg" alt="profile" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                aria-labelledby="profileDropdown">
                                <a class="dropdown-item">
                                    <i class="ti-settings text-primary"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item">
                                    <i class="ti-power-off text-primary"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                        <li class="nav-item nav-settings d-none d-lg-flex">
                            <a class="nav-link" href="#">
                                <i class="icon-ellipsis"></i>
                            </a>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas">
                        <span class="icon-menu"></span>
                    </button>
                </div>
            </nav>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <div id="right-sidebar" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section"
                                role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section"
                                role="tab" aria-controls="chats-section">CHATS</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="setting-content">
                        <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel"
                            aria-labelledby="todo-section">
                            <div class="add-items d-flex px-3 mb-0">
                                <form class="form w-100">
                                    <div class="form-group d-flex">
                                        <input type="text" class="form-control todo-list-input"
                                            placeholder="Add To-do">
                                        <button type="submit" class="add btn btn-primary todo-list-add-btn"
                                            id="add-task">Add</button>
                                    </div>
                                </form>
                            </div>
                            <div class="list-wrapper px-3">
                                <ul class="d-flex flex-column-reverse todo-list">
                                    <li>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="checkbox" type="checkbox">
                                                Team review meeting at 3.00 PM
                                            </label>
                                        </div>
                                        <i class="remove ti-close"></i>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="checkbox" type="checkbox">
                                                Prepare for presentation
                                            </label>
                                        </div>
                                        <i class="remove ti-close"></i>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="checkbox" type="checkbox">
                                                Resolve all the low priority tickets due today
                                            </label>
                                        </div>
                                        <i class="remove ti-close"></i>
                                    </li>
                                    <li class="completed">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="checkbox" type="checkbox" checked>
                                                Schedule meeting for next week
                                            </label>
                                        </div>
                                        <i class="remove ti-close"></i>
                                    </li>
                                    <li class="completed">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="checkbox" type="checkbox" checked>
                                                Project review
                                            </label>
                                        </div>
                                        <i class="remove ti-close"></i>
                                    </li>
                                </ul>
                            </div>
                            <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Events</h4>
                            <div class="events pt-4 px-3">
                                <div class="wrapper d-flex mb-2">
                                    <i class="ti-control-record text-primary mr-2"></i>
                                    <span>Feb 11 2018</span>
                                </div>
                                <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
                                <p class="text-gray mb-0">The total number of sessions</p>
                            </div>
                            <div class="events pt-4 px-3">
                                <div class="wrapper d-flex mb-2">
                                    <i class="ti-control-record text-primary mr-2"></i>
                                    <span>Feb 7 2018</span>
                                </div>
                                <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
                                <p class="text-gray mb-0 ">Call Sarah Graves</p>
                            </div>
                        </div>
                        <!-- To do section tab ends -->
                        <div class="tab-pane fade" id="chats-section" role="tabpanel"
                            aria-labelledby="chats-section">
                            <div class="d-flex align-items-center justify-content-between border-bottom">
                                <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends
                                </p>
                                <small
                                    class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See
                                    All</small>
                            </div>
                            <ul class="chat-list">
                                <li class="list active">
                                    <div class="profile"><img src="images/faces/face1.jpg" alt="image"><span
                                            class="online"></span></div>
                                    <div class="info">
                                        <p>Thomas Douglas</p>
                                        <p>Available</p>
                                    </div>
                                    <small class="text-muted my-auto">19 min</small>
                                </li>
                                <li class="list">
                                    <div class="profile"><img src="images/faces/face2.jpg" alt="image"><span
                                            class="offline"></span></div>
                                    <div class="info">
                                        <div class="wrapper d-flex">
                                            <p>Catherine</p>
                                        </div>
                                        <p>Away</p>
                                    </div>
                                    <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                                    <small class="text-muted my-auto">23 min</small>
                                </li>
                                <li class="list">
                                    <div class="profile"><img src="images/faces/face3.jpg" alt="image"><span
                                            class="online"></span></div>
                                    <div class="info">
                                        <p>Daniel Russell</p>
                                        <p>Available</p>
                                    </div>
                                    <small class="text-muted my-auto">14 min</small>
                                </li>
                                <li class="list">
                                    <div class="profile"><img src="images/faces/face4.jpg" alt="image"><span
                                            class="offline"></span></div>
                                    <div class="info">
                                        <p>James Richardson</p>
                                        <p>Away</p>
                                    </div>
                                    <small class="text-muted my-auto">2 min</small>
                                </li>
                                <li class="list">
                                    <div class="profile"><img src="images/faces/face5.jpg" alt="image"><span
                                            class="online"></span></div>
                                    <div class="info">
                                        <p>Madeline Kennedy</p>
                                        <p>Available</p>
                                    </div>
                                    <small class="text-muted my-auto">5 min</small>
                                </li>
                                <li class="list">
                                    <div class="profile"><img src="images/faces/face6.jpg" alt="image"><span
                                            class="online"></span></div>
                                    <div class="info">
                                        <p>Sarah Graves</p>
                                        <p>Available</p>
                                    </div>
                                    <small class="text-muted my-auto">47 min</small>
                                </li>
                            </ul>
                        </div>
                        <!-- chat tab ends -->
                    </div>
                </div>
                <!-- partial -->

                <!-- resources/views/layouts/sidebar.blade.php -->
                <nav class="sidebar sidebar-offcanvas" id="sidebar">
                    <ul class="nav">
                        <li class="cus-nav-item">

                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                                href="{{ route('dashboard') }}">
                                <i class="icon-grid menu-icon"></i>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="cus-nav-item">

                            <a class="nav-link {{ request()->routeIs('user.list') ? 'active' : '' }}"
                                href="{{ route('user.list') }}">
                                <i class="icon-head menu-icon"></i>
                                <span class="menu-title">User</span>
                            </a>
                        </li>
                        <li class="cus-nav-item">

                            <a class="nav-link {{ request()->routeIs('category.list') ? 'active' : '' }}"
                                href="{{ route('category.list') }}">
                                <i class="icon-layout menu-icon"></i>
                                <span class="menu-title">Category</span>
                            </a>
                        </li>
                        <li class="cus-nav-item">
                            <a class="nav-link {{ request()->routeIs('course.list') ? 'active' : '' }}"
                                href="{{ route('course.list') }}">
                                <i class="icon-columns menu-icon"></i>
                                <span class="menu-title">Course</span>
                            </a>
                        </li>
                        <li class="cus-nav-item">
                            <a class="nav-link {{ request()->routeIs('enrollment.list') ? 'active' : '' }}"
                                href="{{ route('enrollment.list') }}">
                                <i class="icon-paper menu-icon"></i>
                                <span class="menu-title">Enrollment</span>
                            </a>

                        </li>
                    </ul>



                </nav>



                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        @yield('content')
                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->
                    <footer class="footer">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ©
                                2021. Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin
                                    template</a> from
                                BootstrapDash. All rights reserved.</span>
                            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted &
                                made with <i class="ti-heart text-danger ml-1"></i></span>
                        </div>
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Distributed by
                                <a href="https://www.themewagon.com/" target="_blank">Themewagon</a></span>
                        </div>
                    </footer>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->



        <!-- container-scroller -->

        <!-- plugins:js -->
        <script src="{{ asset('admin/vendors/js/vendor.bundle.base.js') }}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        {{-- <script src="{{ asset('admin/vendors/chart.js/Chart.min.js') }}"></script> --}}
        <script src="{{ asset('admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
        <script src="{{ asset('admin/js/dataTables.select.min.js') }}"></script>

        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="{{ asset('admin/js/off-canvas.js') }}"></script>
        <script src="{{ asset('admin/js/hoverable-collapse.js') }}"></script>
        <script src="{{ asset('admin/js/template.js') }}"></script>
        <script src="{{ asset('admin/js/settings.js') }}"></script>
        <script src="{{ asset('admin/js/todolist.js') }}"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="{{ asset('admin/js/dashboard.js') }}"></script>
        {{-- <script src="{{ asset('admin/Chart.roundedBarCharts.js') }}"></script> --}}


        <!-- End custom js for this page-->

        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


        <!-- Bootstrap JS and Popper.js CDN -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>


        <script src="{{ asset('../../js/datatable/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('../../js/datatable/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('../../js/datatable/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('../../js/datatable/jquery.dataTables.min.js') }}"></script>

        {{-- <script src="{{ asset('js/datatable/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/datatable/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('js/datatable/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('js/datatable/jquery.dataTables.min.js') }}"></script> --}}


        {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script> --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script> --}}

        {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}





        {{-- Datatable script --}}
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            });

            // create form
            document.querySelector('.file-upload-browse').addEventListener('click', function() {
                document.querySelector('.file-upload-default').click();
            });

            // document.querySelector('.file-upload-default').addEventListener('change', function() {
            //     let fileName = this.files[0] ? this.files[0].name : '';
            //     document.querySelector('.file-upload-info').value = fileName;
            // });

            // edit form
            document.querySelector('.file-upload-browse').addEventListener('click', function() {
                document.querySelector('#image').click();
            });

            document.querySelector('#image').addEventListener('change', function() {
                var fileName = this.files[0] ? this.files[0].name : '';
                document.querySelector('.file-upload-info').value = fileName;
            });
        </script>

        @yield('scripts')
    </body>

</html>