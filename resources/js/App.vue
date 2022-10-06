<template>
    <main>
        <div id="wrapper">
            <!-- Sidebar -->
            <Sidebar v-if="isAuth" />
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    <!-- Topbar -->
                    <Header v-if="isAuth" />
                    <!-- End of Topbar -->
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <router-view></router-view>
                    </div>
                    <!-- /.container-fluid -->
                    <FlashMessage :position="'right bottom'"></FlashMessage>
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <Footer v-if="isAuth" />
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
    </main>
</template>

<script>
import { mapState, mapGetters } from "vuex";
import Header from "./components/Header.vue";
import Sidebar from "./components/Sidebar.vue";
import Footer from "./components/Footer.vue";
import $axios from './api';
export default {
    computed: {
        ...mapState(["token"]),
        ...mapGetters(["isAuth"])
    },
    components: {
        Header,
        Sidebar,
        Footer
    },
};
</script>
