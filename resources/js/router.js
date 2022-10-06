import Vue from 'vue'
import store from './store'
import Router from 'vue-router'
//form
import Home from './view/Home.vue'
import Login from './view/auth/Login.vue'
import Register from './view/auth/Register.vue'
import ForgotPassword from './view/auth/forgot-password/forgot_password.vue'
import IndexUserRequest from './view/dataRegistration/index.vue'
import DataUserRequest from './view/dataRegistration/dataRequest.vue'
import formUpdateSchool from './view/dataRegistration/formUpdate.vue'
import IndexVerifiedUser from './view/dataVerifiedUser/index.vue'
import DataVerified from './view/dataVerifiedUser/dataVerified.vue'
import FormUpdateVerifiedUser from './view/dataVerifiedUser/formUpdate.vue'
import IndexDataSekolah from './view/dataSekolah/index.vue'
import DataSekolah from './view/dataSekolah/data.vue'
import FormUpdateSekolah from './view/dataSekolah/formUpdate.vue'
import Setting from './view/setting/index.vue'
import SetPermission from './view/setting/roles/setPermission.vue'
import PageNotFound from './view/errorPage/404.vue'
import IndexStudent from './view/dataStudent/index.vue'
import dataStudent from './view/dataStudent/data.vue'
import FormCompletedRegister from './view/auth/form-completed-registration.vue'
Vue.use(Router)

const router = new Router({
    mode: 'history',
    routes: [{
            path: '/',
            name: 'home',
            component: Home,
            meta: { requiresAuth: true },

        },
        {
            path: '*',
            component: PageNotFound
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
        },
        {
            path:'/completedDataRegistration/:activated_code',
            name:'completedDataRegistration',
            component:FormCompletedRegister
        },
        {
            path: '/forgot-password',
            name: 'forgot-password',
            component: ForgotPassword
        },
        {
            path: '/registration-users',
            component: IndexUserRequest,
            meta: { requiresAuth: true },
            children: [{
                    path: '',
                    name: 'registration-users.data',
                    component: DataUserRequest,
                    meta: { title: 'Manage User Request' }
                },
                {
                    path: 'edit/:id',
                    name: 'registration-users.edit',
                    component: formUpdateSchool,
                    meta: { title: 'Edit Data User Request' }
                }

            ]
        },
        {
            path: '/userVerified',
            component: IndexVerifiedUser,
            meta: { requiresAuth: true },
            children: [{
                    path: '',
                    name: 'userVerified.data',
                    component: DataVerified,
                    meta: { title: 'Manage User Verified' }
                },
                {
                    path: 'edit/:id',
                    name: 'userVerified.edit',
                    component: FormUpdateVerifiedUser,
                    meta: { title: 'Edit Data User Verified' }
                }

            ]
        },
        {
            path: '/data-student',
            component: IndexStudent,
            meta: { requiresAuth: true },
            children: [{
                path: '',
                component: dataStudent,
                name: 'data-student.data',
                meta: { title: 'Manage Student' }
            }]
        },
        {
            path: '/school',
            component: IndexDataSekolah,
            meta: { requiresAuth: true },
            children: [{
                path: '',
                component: DataSekolah,
                name: 'school.data',
                meta: { title: 'Manage School' }
            }, {
                path: 'edit/:id',
                component: FormUpdateSekolah,
                name: 'school.edit',
                meta: { title: 'Edit Data Sekolah' }

            }]

        }, {
            path: '/setting',
            component: Setting,
            meta: { requiresAuth: true },
            children: [{
                    path: 'role-permission',
                    name: 'role-permissions',
                    component: SetPermission,
                    meta: { title: 'Set Permission' }
                }

            ]
        }

    ],
    linkActiveClass: 'active '
});

Vue.config.productionTip = false
router.beforeEach((to, from, next) => {
    store.commit('CLEAR_ERRORS')
    if (to.matched.some(record => record.meta.requiresAuth)) {
        let auth = store.getters.isAuth
        if (!auth) {
            next({ name: 'login' })
        } else {
            next()
        }
    } else {
        next()
    }
})

export default router;