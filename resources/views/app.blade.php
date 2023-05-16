<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <title>Management Info</title>

        <!-- Global stylesheets -->
        <link href="{{asset('global_assets/fonts/inter/inter.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('global_assets/icons/phosphor/styles.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/ltr/all.min.css')}}" id="stylesheet" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->

        <!-- Core JS files -->
        <script src="{{asset('global_assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
        <!-- /core JS files -->

        <!-- Theme JS files -->
        <script src="{{asset('assets/js/app.js')}}"></script>
        <!-- /theme JS files -->

        <!-- App JS -->
        @vite('resources/js/app.js')
    </head>

    <body>

        <!-- Main navbar -->
        <div class="navbar navbar-dark navbar-expand-lg navbar-static border-bottom border-bottom-white border-opacity-10">
            <div class="container-fluid">
                <div class="d-flex d-lg-none me-2">
                    <button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded">
                        <i class="ph-list"></i>
                    </button>
                </div>

                <div class="navbar-brand">
                    <a href="index.html" class="d-inline-flex align-items-center">
                        <img src="{{ asset('global_assets/images/demo/logos/3.svg') }}" alt="">
                        {{-- <img src="asset('global_assets/images/logo_text_light.svg') }}" class="d-none d-sm-inline-block h-16px ms-3" alt=""> --}}
                    </a>
                </div>

                <div class="d-lg-none ms-2">
                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-mobile" aria-expanded="false">
                        <i class="ph-squares-four"></i>
                    </button>
                </div>

                <div class="navbar-collapse order-2 order-lg-1 collapse" id="navbar-mobile" style="">
                    <ul class="navbar-nav mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a href="#" class="navbar-nav-link rounded">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="navbar-nav-link rounded dropdown-toggle" data-bs-toggle="dropdown">Dropdown</a>
                            <div class="dropdown-menu">
                                <a href="#" class="dropdown-item">Action</a>
                                <a href="#" class="dropdown-item">Another action</a>
                                <a href="#" class="dropdown-item">Something else here</a>
                                <a href="#" class="dropdown-item">One more line</a>
                            </div>
                        </li>
                    </ul>
                </div>

                <ul class="nav gap-sm-2 order-1 order-lg-2 ms-auto">
                    <li class="nav-item">
                        <a href="#" class="navbar-nav-link navbar-nav-link-icon rounded">
                            <i class="ph-bell"></i>
                            <span class="badge bg-yellow text-black position-absolute top-0 end-0 translate-middle-top zindex-1 rounded-pill mt-1 me-1">2</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="navbar-nav-link navbar-nav-link-icon rounded">
                            <i class="ph-chats"></i>
                        </a>
                    </li>
                    <li class="nav-item nav-item-dropdown-lg dropdown">
                        <a href="#" class="navbar-nav-link align-items-center rounded p-1" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="status-indicator-container">
                                <img src="{{ asset('global_assets/images/demo/logos/2.svg') }}" class="w-32px h-32px rounded" alt="">
                                <span class="status-indicator bg-success"></span>
                            </div>
                            <span class="d-none d-lg-inline-block mx-lg-2">Victoria</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="#" class="dropdown-item">Action</a>
                            <a href="#" class="dropdown-item">Another action</a>
                            <a href="#" class="dropdown-item">Something else here</a>
                            <a href="#" class="dropdown-item">One more line</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /main navbar -->

        <!-- Page content -->
        <div id="app" class="page-content">
        </div>

    </body>
</html>
