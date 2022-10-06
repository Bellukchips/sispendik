import Vue from 'vue'
import router from './router.js'
import store from './store.js'
import App from './App.vue'
import FlashMessage from '@smartweb/vue-flash-message'
import VueSweetalert2 from 'vue-sweetalert2';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'sweetalert2/dist/sweetalert2.min.css';
import Permissions from './mixins/permission.js'
import Vuesax from 'vuesax';
import 'vuesax/dist/vuesax.css' //Vuesax styles
import 'material-icons/iconfont/material-icons.css';
Vue.mixin(Permissions)
import { mapActions, mapGetters } from 'vuex'
Vue.use(FlashMessage)
Vue.use(Vuesax)
Vue.use(BootstrapVue) // Install BootstrapVue
Vue.use(IconsPlugin) // Optionally install the BootstrapVue icon components plugin
Vue.use(VueSweetalert2);
new Vue({
    el: '#home',
    router,
    store,
    components: {
        App
    },
    computed: {
        ...mapGetters(['isAuth'])
    },
    methods: {
        ...mapActions('user', ['getUserLogin'])
    },
    created() {
        if (this.isAuth) {
            this.getUserLogin() //REQUEST DATA YANG SEDANG LOGIN
        }
    }
})