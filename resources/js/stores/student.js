import $axios from '../api.js'
import { reject } from 'lodash'

const state = () => ({
    student: [],
    id: '',
    page: 1
})

const mutations = {
    ASSIGN_DATA(state, payload) {
        state.schools = payload
    },
    SET_PAGE(state, payload) {
        state.page = payload
    },
    SET_ID_UPDATE(state, payload) {
        state.id = payload
    }
}

const actions = {
    getStudent({ commit, state }, payload) {
        let search = typeof payload != 'undefined' ? payload : '';
        return new Promise((resolve, reject) => {
            $axios.get(`/data-student?page=${state.page}&q=${search}`)
                .then((response) => {
                    commit('ASSIGN_DATA', response.data);
                    resolve(response.data)
                })
        })
    }
}
export default {
    namespaced: true,
    state,
    actions,
    mutations
}