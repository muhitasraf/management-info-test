<template>
    <!-- Main navbar -->
    <Navbar></Navbar>
    <!-- /main navbar -->

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <Sidebar></Sidebar>
        <!-- /main sidebar -->

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
            <Header></Header>
            <!-- /page header -->

            <!-- Inner content -->
            <div class="content-inner">

                <!-- Content area -->
                <div class="content">
                    <!-- Basic card -->
                    <div class="card p-1">
                        <router-view v-slot="{ Component }">
                            <component :is="Component" />
                        </router-view>
                    </div>
                    <!-- /basic card -->
                </div>
                <!-- /content area -->

                <!-- Footer -->
                <Footer></Footer>
                <!-- /footer -->

            </div>
            <!-- /inner content -->

        </div>
        <!-- /main content -->
    </div>
</template>

<style>
.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>
<script>
    import Navbar from './partials/Navbar.vue'
    import Header from './partials/Header.vue'
    import Sidebar from './partials/Sidebar.vue'
    import Footer from './partials/Footer.vue'

    export default {
        name: "App",

        components: {
            Navbar, Header, Sidebar, Footer,
        }
    }
</script>

