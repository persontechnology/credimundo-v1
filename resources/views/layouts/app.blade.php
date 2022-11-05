<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Global stylesheets -->
    <link href="{{ asset('admin/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('admin/icons/fontawesome-free-6.2.0-web/css/all.min.css') }}">
    <link href="{{ asset('admin/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/css/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('admin/js/jquery-confirm-v3.3.4/jquery-confirm.min.css') }}">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{ asset('admin/demo/demo_configurator.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{ asset('admin/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <script src="{{ asset('admin/js/jquery-confirm-v3.3.4/jquery-confirm.min.js') }}"></script>

    <script src="{{ asset('admin/js/vendor/uploaders/fileinput/fileinput.min.js') }}"></script>
	<script src="{{ asset('admin/js/vendor/uploaders/fileinput/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('admin/js/vendor/uploaders/fileinput/es.js') }}"></script>
    <script src="{{ asset('admin/js/vendor/uploaders/fileinput/fa6.js') }}"></script>

    <script src="{{ asset('admin/js/app.js') }}"></script>

    @stack('scriptsHeader')
    <!-- /theme JS files -->

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

</head>

<body>

    <!-- Main navbar -->
    <div class="navbar navbar-dark navbar-expand-lg navbar-static border-bottom border-bottom-white border-opacity-10">
        <div class="container-fluid">
            <div class="d-flex d-lg-none me-2">
                <button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded-pill">
                    <i class="ph-list"></i>
                </button>
            </div>

            <div class="navbar-brand flex-1 flex-lg-0">
                <a href="{{ route('dashboard') }}" class="d-inline-flex align-items-center">
                    <img src="{{ asset('img/credimundo_icono.svg') }}" alt="">
                    <img src="{{ asset('img/credimundo_letras.svg') }}" class="d-none d-sm-inline-block h-16px ms-3"
                        alt="">
                </a>
            </div>

            <ul class="nav flex-row">
                <li class="nav-item d-lg-none">
                    <a href="#navbar_search" class="navbar-nav-link navbar-nav-link-icon rounded-pill"
                        data-bs-toggle="collapse">
                        <i class="ph-magnifying-glass"></i>
                    </a>
                </li>

                <li class="nav-item nav-item-dropdown-lg dropdown">
                    <a href="#" class="navbar-nav-link navbar-nav-link-icon rounded-pill"
                        data-bs-toggle="dropdown">
                        <i class="ph-squares-four"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-scrollable-sm wmin-lg-600 p-0">
                        <div class="d-flex align-items-center border-bottom p-3">
                            <h6 class="mb-0">Browse apps</h6>
                            <a href="#" class="ms-auto">
                                View all
                                <i class="ph-arrow-circle-right ms-1"></i>
                            </a>
                        </div>

                        <div class="row row-cols-1 row-cols-sm-2 g-0">
                            <div class="col">
                                <button type="button"
                                    class="dropdown-item text-wrap h-100 align-items-start border-end-sm border-bottom p-3">
                                    <div>
                                        <img src="{{ asset('img/credimundo_icono.svg') }}" class="h-40px mb-2"
                                            alt="">
                                        <div class="fw-semibold my-1">Customer data platform</div>
                                        <div class="text-muted">Unify customer data from multiple sources</div>
                                    </div>
                                </button>
                            </div>

                            <div class="col">
                                <button type="button"
                                    class="dropdown-item text-wrap h-100 align-items-start border-bottom p-3">
                                    <div>
                                        <img src="{{ asset('img/credimundo_icono.svg') }}" class="h-40px mb-2"
                                            alt="">
                                        <div class="fw-semibold my-1">Data catalog</div>
                                        <div class="text-muted">Discover, inventory, and organize data assets</div>
                                    </div>
                                </button>
                            </div>

                            <div class="col">
                                <button type="button"
                                    class="dropdown-item text-wrap h-100 align-items-start border-end-sm border-bottom border-bottom-sm-0 rounded-bottom-start p-3">
                                    <div>
                                        <img src="{{ asset('img/credimundo_icono.svg') }}" class="h-40px mb-2"
                                            alt="">
                                        <div class="fw-semibold my-1">Data governance</div>
                                        <div class="text-muted">The collaboration hub and data marketplace</div>
                                    </div>
                                </button>
                            </div>

                            <div class="col">
                                <button type="button"
                                    class="dropdown-item text-wrap h-100 align-items-start rounded-bottom-end p-3">
                                    <div>
                                        <img src="{{ asset('img/credimundo_icono.svg') }}" class="h-40px mb-2"
                                            alt="">
                                        <div class="fw-semibold my-1">Data privacy</div>
                                        <div class="text-muted">Automated provisioning of non-production datasets</div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item nav-item-dropdown-lg dropdown ms-lg-2">
                    <a href="#" class="navbar-nav-link navbar-nav-link-icon rounded-pill"
                        data-bs-toggle="dropdown" data-bs-auto-close="outside">
                        <i class="ph-chats"></i>
                        <span
                            class="badge bg-yellow text-black position-absolute top-0 end-0 translate-middle-top zindex-1 rounded-pill mt-1 me-1">8</span>
                    </a>

                    <div class="dropdown-menu wmin-lg-400 p-0">
                        <div class="d-flex align-items-center p-3">
                            <h6 class="mb-0">Messages</h6>
                            <div class="ms-auto">
                                <a href="#" class="text-body rounded-pill">
                                    <i class="ph-plus-circle"></i>
                                </a>
                                <a href="#search_messages" class="collapsed text-body rounded-pill ms-2"
                                    data-bs-toggle="collapse">
                                    <i class="ph-magnifying-glass"></i>
                                </a>
                            </div>
                        </div>

                        <div class="collapse" id="search_messages">
                            <div class="px-3 mb-2">
                                <div class="form-control-feedback form-control-feedback-start">
                                    <input type="text" class="form-control" placeholder="Search messages">
                                    <div class="form-control-feedback-icon">
                                        <i class="ph-magnifying-glass"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown-menu-scrollable pb-2">
                            <a href="#" class="dropdown-item align-items-start text-wrap py-2">
                                <div class="status-indicator-container me-3">
                                    <img src="{{ asset('img/credimundo_icono.svg') }}"
                                        class="w-40px h-40px rounded-pill" alt="">
                                    <span class="status-indicator bg-warning"></span>
                                </div>

                                <div class="flex-1">
                                    <span class="fw-semibold">James Alexander</span>
                                    <span class="text-muted float-end fs-sm">04:58</span>
                                    <div class="text-muted">who knows, maybe that would be the best thing for me...
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="dropdown-item align-items-start text-wrap py-2">
                                <div class="status-indicator-container me-3">
                                    <img src="{{ asset('img/credimundo_icono.svg') }}"
                                        class="w-40px h-40px rounded-pill" alt="">
                                    <span class="status-indicator bg-success"></span>
                                </div>

                                <div class="flex-1">
                                    <span class="fw-semibold">Margo Baker</span>
                                    <span class="text-muted float-end fs-sm">12:16</span>
                                    <div class="text-muted">That was something he was unable to do because...</div>
                                </div>
                            </a>

                            <a href="#" class="dropdown-item align-items-start text-wrap py-2">
                                <div class="status-indicator-container me-3">
                                    <img src="{{ asset('img/credimundo_icono.svg') }}"
                                        class="w-40px h-40px rounded-pill" alt="">
                                    <span class="status-indicator bg-success"></span>
                                </div>
                                <div class="flex-1">
                                    <span class="fw-semibold">Jeremy Victorino</span>
                                    <span class="text-muted float-end fs-sm">22:48</span>
                                    <div class="text-muted">But that would be extremely strained and suspicious...
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="dropdown-item align-items-start text-wrap py-2">
                                <div class="status-indicator-container me-3">
                                    <img src="{{ asset('img/credimundo_icono.svg') }}"
                                        class="w-40px h-40px rounded-pill" alt="">
                                    <span class="status-indicator bg-grey"></span>
                                </div>
                                <div class="flex-1">
                                    <span class="fw-semibold">Beatrix Diaz</span>
                                    <span class="text-muted float-end fs-sm">Tue</span>
                                    <div class="text-muted">What a strenuous career it is that I've chosen...</div>
                                </div>
                            </a>

                            <a href="#" class="dropdown-item align-items-start text-wrap py-2">
                                <div class="status-indicator-container me-3">
                                    <img src="{{ asset('img/credimundo_icono.svg') }}"
                                        class="w-40px h-40px rounded-pill" alt="">
                                    <span class="status-indicator bg-danger"></span>
                                </div>
                                <div class="flex-1">
                                    <span class="fw-semibold">Richard Vango</span>
                                    <span class="text-muted float-end fs-sm">Mon</span>
                                    <div class="text-muted">Other travelling salesmen live a life of luxury...</div>
                                </div>
                            </a>
                        </div>

                        <div class="d-flex border-top py-2 px-3">
                            <a href="#" class="text-body">
                                <i class="ph-checks me-1"></i>
                                Dismiss all
                            </a>
                            <a href="#" class="text-body ms-auto">
                                View all
                                <i class="ph-arrow-circle-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>

            <div class="navbar-collapse justify-content-center flex-lg-1 order-2 order-lg-1 collapse"
                id="navbar_search">
                <div class="navbar-search flex-fill position-relative mt-2 mt-lg-0 mx-lg-3">
                    <div class="form-control-feedback form-control-feedback-start flex-grow-1"
                        data-color-theme="dark">
                        <input type="text" class="form-control bg-transparent rounded-pill" placeholder="Search"
                            data-bs-toggle="dropdown">
                        <div class="form-control-feedback-icon">
                            <i class="ph-magnifying-glass"></i>
                        </div>
                        <div class="dropdown-menu w-100" data-color-theme="light">
                            <button type="button" class="dropdown-item">
                                <div class="text-center w-32px me-3">
                                    <i class="ph-magnifying-glass"></i>
                                </div>
                                <span>Search <span class="fw-bold">"in"</span> everywhere</span>
                            </button>

                            <div class="dropdown-divider"></div>

                            <div class="dropdown-menu-scrollable-lg">
                                <div class="dropdown-header">
                                    Contacts
                                    <a href="#" class="float-end">
                                        See all
                                        <i class="ph-arrow-circle-right ms-1"></i>
                                    </a>
                                </div>

                                <div class="dropdown-item cursor-pointer">
                                    <div class="me-3">
                                        <img src="{{ asset('img/credimundo_icono.svg') }}"
                                            class="w-32px h-32px rounded-pill" alt="">
                                    </div>

                                    <div class="d-flex flex-column flex-grow-1">
                                        <div class="fw-semibold">Christ<mark>in</mark>e Johnson</div>
                                        <span class="fs-sm text-muted">c.johnson@awesomecorp.com</span>
                                    </div>

                                    <div class="d-inline-flex">
                                        <a href="#" class="text-body ms-2">
                                            <i class="ph-user-circle"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="dropdown-item cursor-pointer">
                                    <div class="me-3">
                                        <img src="{{ asset('img/credimundo_icono.svg') }}"
                                            class="w-32px h-32px rounded-pill" alt="">
                                    </div>

                                    <div class="d-flex flex-column flex-grow-1">
                                        <div class="fw-semibold">Cl<mark>in</mark>ton Sparks</div>
                                        <span class="fs-sm text-muted">c.sparks@awesomecorp.com</span>
                                    </div>

                                    <div class="d-inline-flex">
                                        <a href="#" class="text-body ms-2">
                                            <i class="ph-user-circle"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="dropdown-divider"></div>

                                <div class="dropdown-header">
                                    Clients
                                    <a href="#" class="float-end">
                                        See all
                                        <i class="ph-arrow-circle-right ms-1"></i>
                                    </a>
                                </div>

                                <div class="dropdown-item cursor-pointer">
                                    <div class="me-3">
                                        <img src="{{ asset('img/credimundo_icono.svg') }}"
                                            class="w-32px h-32px rounded-pill" alt="">
                                    </div>

                                    <div class="d-flex flex-column flex-grow-1">
                                        <div class="fw-semibold">Adobe <mark>In</mark>c.</div>
                                        <span class="fs-sm text-muted">Enterprise license</span>
                                    </div>

                                    <div class="d-inline-flex">
                                        <a href="#" class="text-body ms-2">
                                            <i class="ph-briefcase"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="dropdown-item cursor-pointer">
                                    <div class="me-3">
                                        <img src="{{ asset('img/credimundo_icono.svg') }}"
                                            class="w-32px h-32px rounded-pill" alt="">
                                    </div>

                                    <div class="d-flex flex-column flex-grow-1">
                                        <div class="fw-semibold">Holiday-<mark>In</mark>n</div>
                                        <span class="fs-sm text-muted">On-premise license</span>
                                    </div>

                                    <div class="d-inline-flex">
                                        <a href="#" class="text-body ms-2">
                                            <i class="ph-briefcase"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="dropdown-item cursor-pointer">
                                    <div class="me-3">
                                        <img src="{{ asset('img/credimundo_icono.svg') }}"
                                            class="w-32px h-32px rounded-pill" alt="">
                                    </div>

                                    <div class="d-flex flex-column flex-grow-1">
                                        <div class="fw-semibold"><mark>IN</mark>G Group</div>
                                        <span class="fs-sm text-muted">Perpetual license</span>
                                    </div>

                                    <div class="d-inline-flex">
                                        <a href="#" class="text-body ms-2">
                                            <i class="ph-briefcase"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="#"
                        class="navbar-nav-link align-items-center justify-content-center w-40px h-32px rounded-pill position-absolute end-0 top-50 translate-middle-y p-0 me-1"
                        data-bs-toggle="dropdown" data-bs-auto-close="outside">
                        <i class="ph-faders-horizontal"></i>
                    </a>

                    <div class="dropdown-menu w-100 p-3">
                        <div class="d-flex align-items-center mb-3">
                            <h6 class="mb-0">Search options</h6>
                            <a href="#" class="text-body rounded-pill ms-auto">
                                <i class="ph-clock-counter-clockwise"></i>
                            </a>
                        </div>

                        <div class="mb-3">
                            <label class="d-block form-label">Category</label>
                            <label class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" checked>
                                <span class="form-check-label">Invoices</span>
                            </label>
                            <label class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input">
                                <span class="form-check-label">Files</span>
                            </label>
                            <label class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input">
                                <span class="form-check-label">Users</span>
                            </label>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Addition</label>
                            <div class="input-group">
                                <select class="form-select w-auto flex-grow-0">
                                    <option value="1" selected>has</option>
                                    <option value="2">has not</option>
                                </select>
                                <input type="text" class="form-control" placeholder="Enter the word(s)">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <div class="input-group">
                                <select class="form-select w-auto flex-grow-0">
                                    <option value="1" selected>is</option>
                                    <option value="2">is not</option>
                                </select>
                                <select class="form-select">
                                    <option value="1" selected>Active</option>
                                    <option value="2">Inactive</option>
                                    <option value="3">New</option>
                                    <option value="4">Expired</option>
                                    <option value="5">Pending</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex">
                            <button type="button" class="btn btn-light">Reset</button>

                            <div class="ms-auto">
                                <button type="button" class="btn btn-light">Cancel</button>
                                <button type="button" class="btn btn-primary ms-2">Apply</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="nav flex-row justify-content-end order-1 order-lg-2">
                <li class="nav-item">
                    <a href="#" class="navbar-nav-link navbar-nav-link-icon rounded-pill"
                        data-bs-toggle="offcanvas" data-bs-target="#notifications">
                        <i class="ph-bell"></i>
                        <span
                            class="badge bg-yellow text-black position-absolute top-0 end-0 translate-middle-top zindex-1 rounded-pill mt-1 me-1">2</span>
                    </a>
                </li>

                <li class="nav-item nav-item-dropdown-lg dropdown ms-lg-2">
                    <a href="#" class="navbar-nav-link align-items-center rounded-pill p-1"
                        data-bs-toggle="dropdown">
                        <div class="status-indicator-container">
                            <img src="{{ asset('img/credimundo_icono.svg') }}" class="w-32px h-32px rounded-pill"
                                alt="">
                            <span class="status-indicator bg-success"></span>
                        </div>
                        <span class="d-none d-lg-inline-block mx-lg-2">{{ Auth::user()->name }}</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="#" class="dropdown-item">
                            <i class="ph-user-circle me-2"></i>
                            My profile
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="ph-currency-circle-dollar me-2"></i>
                            My subscription
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="ph-shopping-cart me-2"></i>
                            My orders
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="ph-envelope-open me-2"></i>
                            My inbox
                            <span class="badge bg-primary rounded-pill ms-auto">26</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="ph-gear me-2"></i>
                            Account settings
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"
                                class="dropdown-item">
                                <i class="ph-sign-out me-2"></i>
                                {{ __('Logout') }}
                            </a>
                        </form>



                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- /main navbar -->


    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

            <!-- Sidebar content -->
            <div class="sidebar-content">

                <!-- Sidebar header -->
                <div class="sidebar-section">
                    <div class="sidebar-section-body d-flex justify-content-center">
                        <h5 class="sidebar-resize-hide flex-grow-1 my-auto">Navegación</h5>

                        <div>
                            <button type="button"
                                class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                                <i class="ph-arrows-left-right"></i>
                            </button>

                            <button type="button"
                                class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
                                <i class="ph-x"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /sidebar header -->


                <!-- Main navigation -->
                <div class="sidebar-section">
                    <ul class="nav nav-sidebar" data-nav-type="accordion">

                        @include('layouts.navigation')
                    </ul>
                </div>
                <!-- /main navigation -->

            </div>
            <!-- /sidebar content -->

        </div>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Inner content -->
            <div class="content-inner">

                <!-- Page header -->
                <div class="page-header page-header-light shadow">
                    {{-- <div class="page-header-content d-lg-flex">
                        <div class="d-flex">
                            <h4 class="page-title mb-0">
                                Datatables - <span class="fw-normal">Styling</span>
                            </h4>

                            <a href="#page_header"
                                class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto"
                                data-bs-toggle="collapse">
                                <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                            </a>
                        </div>

                        <div class="collapse d-lg-block my-lg-auto ms-lg-auto" id="page_header">
                            <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
                                <div class="dropdown w-100 w-sm-auto">
                                    <a href="#"
                                        class="d-flex align-items-center text-body lh-1 dropdown-toggle py-sm-2"
                                        data-bs-toggle="dropdown" data-bs-display="static">
                                        <img src="{{ asset('img/credimundo_icono.svg') }}" class="w-32px h-32px me-2"
                                            alt="">
                                        <div class="me-auto me-lg-1">
                                            <div class="fs-sm text-muted mb-1">Customer</div>
                                            <div class="fw-semibold">Tesla Motors Inc</div>
                                        </div>
                                    </a>

                                    <div
                                        class="dropdown-menu dropdown-menu-lg-end w-100 w-lg-auto wmin-300 wmin-sm-350 pt-0">
                                        <div class="d-flex align-items-center p-3">
                                            <h6 class="fw-semibold mb-0">Customers</h6>
                                            <a href="#" class="ms-auto">
                                                View all
                                                <i class="ph-arrow-circle-right ms-1"></i>
                                            </a>
                                        </div>
                                        <a href="#" class="dropdown-item active py-2">
                                            <img src="{{ asset('img/credimundo_icono.svg') }}"
                                                class="w-32px h-32px me-2" alt="">
                                            <div>
                                                <div class="fw-semibold">Tesla Motors Inc</div>
                                                <div class="fs-sm text-muted">42 users</div>
                                            </div>
                                        </a>
                                        <a href="#" class="dropdown-item py-2">
                                            <img src="{{ asset('img/credimundo_icono.svg') }}"
                                                class="w-32px h-32px me-2" alt="">
                                            <div>
                                                <div class="fw-semibold">De Bijenkorf</div>
                                                <div class="fs-sm text-muted">49 users</div>
                                            </div>
                                        </a>
                                        <a href="#" class="dropdown-item py-2">
                                            <img src="{{ asset('img/credimundo_icono.svg') }}"
                                                class="w-32px h-32px me-2" alt="">
                                            <div>
                                                <div class="fw-semibold">Royal Dutch Airlines</div>
                                                <div class="fs-sm text-muted">18 users</div>
                                            </div>
                                        </a>
                                        <a href="#" class="dropdown-item py-2">
                                            <img src="{{ asset('img/credimundo_icono.svg') }}"
                                                class="w-32px h-32px me-2" alt="">
                                            <div>
                                                <div class="fw-semibold">Royal Dutch Shell</div>
                                                <div class="fs-sm text-muted">54 users</div>
                                            </div>
                                        </a>
                                        <a href="#" class="dropdown-item py-2">
                                            <img src="{{ asset('img/credimundo_icono.svg') }}" class="w-32px h-32px me-2"
                                                alt="">
                                            <div>
                                                <div class="fw-semibold">BP plc</div>
                                                <div class="fs-sm text-muted">23 users</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="vr d-none d-sm-block flex-shrink-0 my-2 mx-3"></div>

                                <div class="d-inline-flex mt-3 mt-sm-0">
                                    <a href="#" class="status-indicator-container ms-1">
                                        <img src="{{ asset('img/credimundo_icono.svg') }}"
                                            class="w-32px h-32px rounded-pill" alt="">
                                        <span class="status-indicator bg-warning"></span>
                                    </a>
                                    <a href="#" class="status-indicator-container ms-1">
                                        <img src="{{ asset('img/credimundo_icono.svg') }}"
                                            class="w-32px h-32px rounded-pill" alt="">
                                        <span class="status-indicator bg-success"></span>
                                    </a>
                                    <a href="#" class="status-indicator-container ms-1">
                                        <img src="{{ asset('img/credimundo_icono.svg') }}"
                                            class="w-32px h-32px rounded-pill" alt="">
                                        <span class="status-indicator bg-danger"></span>
                                    </a>
                                    <a href="#"
                                        class="btn btn-outline-primary btn-icon w-32px h-32px rounded-pill ms-3">
                                        <i class="ph-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="page-header-content d-lg-flex border-top">
                        @hasSection ('breadcrumb')
                            @yield('breadcrumb')
                        @endif
                    </div>
                </div>
                <!-- /page header -->


                <!-- Content area -->
                <div class="content">

                     
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li><strong>{{ $error }}</strong></li>
                                @endforeach
                            </ul>
                        </div>
                        
                    @endif
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has($msg))
                        <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>{{ Session::get($msg) }}</strong>
                        </div>
                        @endif
                    @endforeach

                    @yield('content')

                </div>
                <!-- /content area -->


                @include('layouts.footer')

            </div>
            <!-- /inner content -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

    <form action="" method="POST" id="formEliminar">
        @csrf
        @method("DELETE")
    </form>

    @include('layouts.notifications')
    @include('layouts.config')

    <script>
        
        $('table').on('draw.dt', function() {
			$('[data-bs-popup="tooltip"]').tooltip();
		})
       
        function eliminar(arg){
            var url = $(arg).attr('href');
            var msg = $(arg).data('msg');
            $.confirm({
                title: 'Está seguro de eliminar.!',
                content: ''+msg,
                type: 'red',
                theme: 'modern',
                icon: 'fa fa-trash',
                typeAnimated: true,
                buttons: {
                    SI: {
                        btnClass: 'btn btn-danger',
                        action: function(){
                            $('#formEliminar').attr('action', url);
                            $("#formEliminar").submit();
                        }
                    },
                    NO: function () {
                    }
                }
            });
        }
    </script>
    @stack('scripts')

</body>

</html>
