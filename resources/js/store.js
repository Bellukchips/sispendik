import Vue from 'vue'
import Vuex from 'vuex'

import auth from './stores/auth.js'
import register from './stores/register.js'
import school from './stores/school.js'
import user from './stores/user.js'
import student from './stores/student.js'
Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        auth,
        register,
        school,
        user,
        student
    },
    state: {
        // apiURL: 'http://localhost:8000/api',
        // serverPath: 'http//localhost:8000',
        token: localStorage.getItem('token'),
        errors: [],
        success: []
    },
    getters: {
        isAuth: state => {
            return state.token != "null" && state.token != null
        }
    },
    mutations: {
        SET_TOKEN(state, payload) {
            state.token = payload
        },
        SET_ERRORS(state, payload) {
            state.errors = payload
        },
        SET_SUCCESS(state, payload) {
            state.success = payload
        },
        CLEAR_ERRORS(state) {
            state.errors = []
        },
        CLEAR_SUCCESS(state) {
            state.success = []
        }
    }
})


export default store