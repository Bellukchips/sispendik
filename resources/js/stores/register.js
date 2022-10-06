import $axios from '../api.js'

const state = () => ({
    schools: [],
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
    submitRegister({ commit }, payload) {

        return new Promise((resolve, reject) => {
            $axios.post(`/register`, payload)
                .then((response) => {
                    if (response.data.status == 'success') {
                        commit('SET_SUCCESS', { valid: 'Berhasil Mendaftar, Silahkan cek email anda untuk melengkapi data' }, { root: true })
                    } else if (response.data.status == 'redudancy') {
                        commit('SET_ERRORS', { invalid: 'NPSN sudah terdaftar' }, { root: true })
                    } else {
                        commit('SET_ERRORS', { invalid: 'Gagal Melakukan Pendaftaran' }, { root: true })
                    }
                    resolve(response.data)
                })
                .catch((error) => {
                    if (error.response.status == 422) {
                        commit('SET_ERRORS', error.response.data.errors, { root: true })
                    } else if (error.response.status == 500) {
                        commit('SET_ERRORS', error.response.data.errors, { root: true })
                    } else if (error.response.status == 405) {
                        commit('SET_ERRORS', error.response.data.errors, { root: true })
                    }
                })
        })
    },
    getRegister({ commit, state }, payload) {
        let search = typeof payload != 'undefined' ? payload : ''
        return new Promise((resolve, reject) => {
            //DENGAN MENGGUNAKAN AXIOS METHOD GET
            $axios.get(`/userRequest?page=${state.page}&q=${search}`)
                .then((response) => {
                    //KEMUDIAN DI COMMIT UNTUK MELAKUKAN PERUBAHA STATE
                    commit('ASSIGN_DATA', response.data)
                    resolve(response.data)
                })
        })
    },
}


export default {
    namespaced: true,
    state,
    actions,
    mutations
}