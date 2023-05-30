<template>
    <!-- Main navbar -->
    <Navbar v-if="isLogin==true"></Navbar>
    <!-- /main navbar -->

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <Sidebar v-if="isLogin==true"></Sidebar>
        <!-- /main sidebar -->

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
            <Header v-if="isLogin==true"></Header>
            <!-- /page header -->

            <!-- Inner content -->
            <div class="content-inner">

                <!-- Content area -->
                <div v-if="isLogin==true" class="content">
                    <!-- Basic card -->
                    <div class="card p-1">
                        <router-view v-slot="{ Component }">
                            <component :is="Component" />
                        </router-view>
                    </div>
                    <!-- /basic card -->
                </div>
                <Login v-else></Login>
                <!-- /content area -->

                <!-- Footer -->
                <Footer v-if="isLogin==true"></Footer>
                <!-- /footer -->

            </div>
            <!-- /inner content -->

        </div>
        <!-- /main content -->
    </div>
</template>

<script>
    import Navbar from './partials/Navbar.vue'
    import Header from './partials/Header.vue'
    import Sidebar from './partials/Sidebar.vue'
    import Footer from './partials/Footer.vue'
    import Login from './pages/Login.vue';

    export default {
        name: "App",
        data() {
            return {
                isLogin : false,
            };
        },
        mounted(){
            if(localStorage.getItem('authenticated')){
                this.isLogin = true;
            }else{
                this.isLogin = false;
            }
        },
        components: {
            Navbar, Header, Sidebar, Footer, Login,
        },
        method : {

        }
    }
</script>

