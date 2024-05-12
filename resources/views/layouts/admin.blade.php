<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">


<!-- Mirrored from myrathemes.com/dashtrap/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Mar 2024 03:40:24 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8" />
    <title>Dashboard | Sohel Rana Blogsite </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets') }}/images/favicon.ico">

    <link href="{{ asset('backend/assets') }}/libs/morris.js/morris.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
        integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <!-- App css -->
    <link href="{{ asset('backend/assets') }}/css/style.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets') }}/css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="{{ asset('backend/assets') }}/js/config.js"></script>
</head>

<style>
    .inner_img_dash{
        width: 50px !important;
        height: 50px !important;
        border-radius: 50%;
    }
</style>

<body>

    <!-- Begin page -->
    <div class="layout-wrapper">

        <!-- ========== Left Sidebar ========== -->
        <div class="main-menu">
            <!-- Brand Logo -->
            <div class="logo-box">
                <!-- Brand Logo Light -->
                <a class='logo-light' href='{{ route('home') }}'>
                    <img src="{{ asset('backend/assets') }}/images/logo-light.png" alt="logo" class="logo-lg"
                        height="28">
                    <img src="{{ asset('backend/assets') }}/images/logo-sm.png" alt="small logo" class="logo-sm"
                        height="28">
                </a>

                <!-- Brand Logo Dark -->
                <a class='logo-dark' href='index.html'>
                    <img src="{{ asset('backend/assets') }}/images/logo-dark.png" alt="dark logo" class="logo-lg"
                        height="28">
                    <img src="{{ asset('backend/assets') }}/images/logo-sm.png" alt="small logo" class="logo-sm"
                        height="28">
                </a>
            </div>

            <!--- Menu -->
            <div data-simplebar>
                <ul class="app-menu">

                    <li class="menu-title">Menu</li>

                    <li class="menu-item">
                        <a class='menu-link waves-effect waves-light' href='{{ route('index') }}'>
                            <span class="menu-icon"><i class="bx bx-home-smile"></i></span>
                            <span class="menu-text"> Frontend </span>
                        </a>
                    </li>

                    <li class="menu-title">backend</li>

                    @can('show_user_list')
                    {{-- user menu start --}}
                    <li class="menu-item">
                        <a href="#menuExpages" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-file"></i></span>
                            <span class="menu-text">User</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="menuExpages">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a class='menu-link' href='{{ route('user.list') }}'>
                                        <span class="menu-text">User List</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- user menu end --}}
                     @endcan

                    {{-- category menu start --}}
                    @can('show_category')                        
                    <li class="menu-item">
                        <a href="#category" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-category"></i></span>
                            <span class="menu-text">Category</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="category">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a class='menu-link' href='{{ route('category.list') }}'>
                                        <span class="menu-text">Category List</span>
                                    </a>
                                    <a class='menu-link' href='{{ route('category.trash.list') }}'>
                                        <span class="menu-text">Trash Category List</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endcan
                    {{-- category menu end --}}

                    {{-- tag menu start --}}
                     @can('show tag')  
                    <li class="menu-item">
                        <a href="#menuIcons" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"> <i class="bx bx-bookmark"></i></span>
                            <span class="menu-text"> Tag </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="menuIcons">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a class='menu-link' href='{{ route('tag') }}'>
                                        <span class="menu-text">Tag List</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endcan
                    {{-- tag menu end --}}

                    {{-- role menu start  --}}
                    @can('show_role_manage')
                    <li class="menu-item">
                        <a href="#role" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-shield"></i></span>
                            <span class="menu-text"> Role Management</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="role">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a class='menu-link' href='{{ route('role.permission.add') }}'>
                                        <span class="menu-text">Add Role & Permission</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endcan
                    {{-- role menu end  --}}

                    {{-- post menu start  --}}
                    @can('show_post')
                    <li class="menu-item">
                        <a href="#menuTables" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-table"></i></span>
                            <span class="menu-text"> Post </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="menuTables">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a class='menu-link' href='{{ route('add.post') }}'>
                                        <span class="menu-text">Add Post</span>
                                    </a>
                                    <a class='menu-link' href='{{ route('post.list') }}'>
                                        <span class="menu-text">My Post</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endcan
                    {{-- post menu end  --}}

                     <li class="menu-title">frontend</li>

                     {{-- news latter  --}}
                     @can('show_subscriber_list')
                    <li class="menu-item">
                        <a href="#menuCharts" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-doughnut-chart"></i></span>
                            <span class="menu-text"> Subscriber </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="menuCharts">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a class='menu-link' href='{{ route('subscriber') }}'>
                                        <span class="menu-text">Subscriber Email</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endcan
                    {{-- news latter  --}}

                    {{-- logo strat  --}}
                    @can('show_logo_form')
                    <li class="menu-item">
                        <a href="#menuMaps" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="fas fa-signature"></i></span>
                            <span class="menu-text"> Logo </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="menuMaps">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a class='menu-link' href='{{ route('logo.update') }}'>
                                        <span class="menu-text">Logo Update</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endcan
                    {{-- logo end  --}}

                    {{-- Author strat  --}}
                    @can('show_author_info')
                    <li class="menu-item">
                        <a href="#author" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="fas fa-user-circle"></i></span>
                            <span class="menu-text"> Author Info </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="author">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a class='menu-link' href='{{ route('auth.info') }}'>
                                        <span class="menu-text">Author Icon & Desp</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endcan
                    {{-- Author end  --}}
                    {{-- admin strat  --}}
                    @can('admin_info')
                    <li class="menu-item">
                        <a href="#admin" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="fas fa-cogs"></i></span>
                            <span class="menu-text"> Admin Info </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="admin">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a class='menu-link' href='{{ route('admin.info') }}'>
                                        <span class="menu-text">Admin Icon & Desp</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endcan
                    {{-- admin end  --}}
                    {{-- contact strat  --}}
                    @can('contact_info')
                    <li class="menu-item">
                        <a href="#contact" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="fas fa-user"></i></span>
                            <span class="menu-text"> Contact Info </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="contact">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a class='menu-link' href='{{ route('contact.info') }}'>
                                        <span class="menu-text">Admin Contact</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endcan
                    {{-- contact end  --}}
                    {{-- Author strat  --}}
                    @can('visitor_message')
                    <li class="menu-item">
                        <a href="#Visitor" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="fas fa-envelope"></i></span>
                            <span class="menu-text">Visitor Message</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="Visitor">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a class='menu-link' href='{{ route('visitor.message') }}'>
                                        <span class="menu-text">Messages</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endcan
                    {{-- Author end  --}}

                    {{-- all post  --}}
                    @can('show_all_post')
                    <li class="menu-item">
                        <a href="#all_post" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="fas fa-globe"></i></span>
                            <span class="menu-text">All Post</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="all_post">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a class='menu-link' href='{{ route('view.all.post') }}'>
                                        <span class="menu-text">View All Post</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endcan
                    {{-- All post  --}}
                    {{-- all post  --}}
                    @can('show_author_item')
                    <li class="menu-item">
                        <a href="#all_post" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="fas fa-comment"></i></span>
                            <span class="menu-text">Comment</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="all_post">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a class='menu-link' href='{{ route('comment.single') }}'>
                                        <span class="menu-text">Comment List</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endcan
                    {{-- All post  --}}
                </ul>
            </div>
        </div>



        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="page-content">

            <!-- ========== Topbar Start ========== -->
            <div class="navbar-custom">
                <div class="topbar">
                    <div class="topbar-menu d-flex align-items-center gap-lg-2 gap-1">

                        <!-- Brand Logo -->
                        <div class="logo-box">
                            <!-- Brand Logo Light -->
                            <a class='logo-light' href='index.html'>
                                <img src="{{ asset('backend/assets') }}/images/logo-light.png" alt="logo"
                                    class="logo-lg" height="22">
                                <img src="{{ asset('backend/assets') }}/images/logo-sm.png" alt="small logo"
                                    class="logo-sm" height="22">
                            </a>

                            <!-- Brand Logo Dark -->
                            <a class='logo-dark' href='index.html'>
                                <img src="{{ asset('backend/assets') }}/images/logo-dark.png" alt="dark logo"
                                    class="logo-lg" height="22">
                                <img src="{{ asset('backend/assets') }}/images/logo-sm.png" alt="small logo"
                                    class="logo-sm" height="22">
                            </a>
                        </div>

                        <!-- Sidebar Menu Toggle Button -->
                        <button class="button-toggle-menu">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </div>

                    <ul class="topbar-menu d-flex align-items-center gap-4">

                        <li class="d-none d-md-inline-block">
                            <a class="nav-link" href="#" data-bs-toggle="fullscreen">
                                <i class="mdi mdi-fullscreen font-size-24"></i>
                            </a>
                        </li>

                        {{-- <li class="dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none"
                                data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                aria-expanded="false">
                                <i class="mdi mdi-magnify font-size-24"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-animated dropdown-menu-end dropdown-lg p-0">
                                <form class="p-3">
                                    <input type="search" class="form-control" placeholder="Search ..."
                                        aria-label="Recipient's username">
                                </form>
                            </div>
                        </li> --}}

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none"
                                data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                aria-expanded="false">
                                <i class="mdi mdi-bell font-size-24"></i>
                                 @php
                                    $post_ids = App\Models\Post::where('author_id', Auth::id())->pluck('id');
                                @endphp
                                <span class="badge bg-danger rounded-circle noti-icon-badge">{{ App\Models\Comment::whereIn('post_id', $post_ids)->where('status',1)->count() }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                                <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 font-size-16 fw-semibold"> Notification</h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="{{ route('comment.read') }}" class="text-dark text-decoration-underline">
                                                <small>Clear All</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="px-1" style="max-height: 300px;" data-simplebar>

                                    {{-- <h5 class="text-muted font-size-13 fw-normal mt-2">Today</h5> --}}
                            
                                    @foreach (App\Models\Comment::whereIn('post_id', $post_ids)->where('status',1)->latest()->get()->take(5) as $commentu)
                                    <a href="{{ route('comment.view', $commentu->id) }}"
                                        class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-1">
                                        <div class="card-body">
                                            <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close sohel" data-comment-id="{{ $commentu->id }}"></i></span>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="notify-icon bg-primary">
                                                        <i class="mdi mdi-comment-account-outline"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 text-truncate ms-2">
                                                    <h5 class="noti-item-title fw-semibold font-size-14">{{ $commentu->rel_to_guest->name }}<small
                                                            class="fw-normal text-muted ms-1">{{ $commentu->created_at->diffForHumans() }}</small></h5>
                                                    <small class="noti-item-subtitle text-muted">{{ $commentu->comment }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach

                                    <div class="text-center">
                                        <i class="mdi mdi-dots-circle mdi-spin text-muted h3 mt-0"></i>
                                    </div>
                                </div>

                                <!-- All-->
                                <a href="{{ route('comment.single') }}"
                                    class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
                                    View All
                                </a>

                            </div>
                        </li>

                        <li class="nav-link" id="theme-mode">
                            <i class="bx bx-moon font-size-24"></i>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light"
                                data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                aria-expanded="false">
                                @auth
                                    @if (Auth()->user()->profile_photo == NULL)
                                    <img class="rounded-circle"
                                        src="{{ Avatar::create(Auth()->user()->name)->toBase64() }}" />
                                    @else
                                    <img class="rounded-circle"
                                        src="{{ asset('uploads/user') }}/{{ Auth()->user()->profile_photo }}" alt="" />
                                    @endif
                                    <span class="ms-1 d-none d-md-inline-block">{{ Auth()->user()->name }}<i
                                        class="mdi mdi-chevron-down"></i>
                                    </span>
                                    @endauth
                            </a>
                            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                                <!-- item-->
                                <a href="{{ route('profile') }}" class="dropdown-item notify-item">
                                    <i class="fe-user"></i>
                                    <span>My Account</span>
                                </a>
                                <!-- item-->
                                <a class='dropdown-item notify-item' href='{{ route('logout') }}' onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fe-log-out"></i>
                                    <span>Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf   
                                </form>

                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- ========== Topbar End ========== -->

            <div class="px-3">

                <!-- Start Content-->
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="py-3 py-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4 class="page-title mb-0">Dashboard</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-none d-lg-block">
                                    <ol class="breadcrumb m-0 float-end">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashtrap</a></li>
                                        <li class="breadcrumb-item active">Dashboard</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    @yield('content')
                    <!-- end page title -->
                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                <script>
                                    document.write(new Date().getFullYear())

                                </script> © Dashtrap
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-none d-md-flex gap-4 align-item-center justify-content-md-end">
                                <p class="mb-0">Design & Develop by <a href="https://myrathemes.com/"
                                        target="_blank">MyraStudio</a> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- App js -->
    <script src="{{ asset('backend/assets') }}/js/vendor.min.js"></script>
    <script src="{{ asset('backend/assets') }}/js/app.js"></script>

    <!-- Knob charts js -->
    <script src="{{ asset('backend/assets') }}/libs/jquery-knob/jquery.knob.min.js"></script>

    <!-- Sparkline Js-->
    <script src="{{ asset('backend/assets') }}/libs/jquery-sparkline/jquery.sparkline.min.js"></script>

    <script src="{{ asset('backend/assets') }}/libs/morris.js/morris.min.js"></script>

    
    <script src="{{ asset('backend/assets') }}/libs/raphael/raphael.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
    integrity="sha512-IOebNkvAHZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQcrossorigin="
    anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <!-- Dashboard init-->
    <script src="{{ asset('backend/assets') }}/js/pages/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @yield('footer_content')

</body>


<!-- Mirrored from myrathemes.com/dashtrap/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Mar 2024 03:40:30 GMT -->

</html>
