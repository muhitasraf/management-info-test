<template>
    <div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">
        <div class="sidebar-content">

            <!-- Sidebar header -->
            <div class="sidebar-section">
                <div class="sidebar-section-body d-flex justify-content-center">
                    <h5 class="sidebar-resize-hide flex-grow-1 my-auto">Navigation</h5>

                    <div>
                        <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                            <i class="ph-arrows-left-right"></i>
                        </button>

                        <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
                            <i class="ph-x"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- /sidebar header -->

            <!-- Main navigation -->
            <div class="sidebar-section">
                <ul class="nav nav-sidebar" data-nav-type="accordion">
                    <!-- Main -->
                    <li class="nav-item-header pt-0">
                        <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main</div>
                        <i class="ph-dots-three sidebar-resize-show"></i>
                    </li>
                    <li class="nav-item">
                        <router-link to="/" class="nav-link">
                            <i class="ph-house"></i>
                            <span>Dashboard</span>
                        </router-link>
                    </li>

                    <!-- Layout -->
                    <li class="nav-item nav-item-submenu">
                        <a href="#" class="nav-link"><i class="ph-layout"></i> <span>Company</span></a>
                        <ul class="nav-group-sub collapse">
                            <li class="nav-item"><router-link to="/company/create" class="nav-item nav-link">Cteate</router-link></li>
                            <li class="nav-item"><router-link to="/company" class="nav-item nav-link">List</router-link></li>
                        </ul>
                    </li>

                    <li class="nav-item nav-item-submenu">
                        <a href="#" class="nav-link"><i class="ph-layout"></i> <span>Customer</span></a>
                        <ul class="nav-group-sub collapse">
                            <li class="nav-item"><router-link to="/customer/create" class="nav-item nav-link">Cteate</router-link></li>
                            <li class="nav-item"><router-link to="/customer" class="nav-item nav-link">List</router-link></li>
                        </ul>
                    </li>

                    <li class="nav-item nav-item-submenu">
                        <a href="#" class="nav-link"><i class="ph-layout"></i> <span>Supplier</span></a>
                        <ul class="nav-group-sub collapse">
                            <li class="nav-item"><router-link to="/customer/create" class="nav-item nav-link">Cteate</router-link></li>
                            <li class="nav-item"><router-link to="/customer" class="nav-item nav-link">List</router-link></li>
                        </ul>
                    </li>
                    <!-- /layout -->

                </ul>
            </div>
            <!-- /main navigation -->
        </div>
    </div>
</template>
