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
    //function user terverifikasi
    getVerifiedUser({ commit, state }, payload) {
        let search = typeof payload != 'undefined' ? payload : ''
        return new Promise((resolve, reject) => {
            $axios.get(`/userVerified?page=${state.page}&q=${search}`)
                .then((response) => {
                    commit('ASSIGN_DATA', response.data)
                    resolve(response.data)
                })
        })
    },
    editVerifiedUser({ commit }, payload) {
        return new Promise((resolve, reject) => {
            //FUNGSI UNTUK MELAKUKAN REQUEST SINGLE DATA BERDASARKAN ID
            $axios.get(`/userVerified/${payload}/edit`)
                .then((response) => {
                    //DATA YANG DITERIMA AKAN DIKIRIMKAN KE FORM
                    resolve(response.data)
                })
        })
    },
    updateVerifiedUser({ state, commit }, payload) {
        return new Promise((resolve, reject) => {
            $axios.post(`/userVerified/${state.id}`, payload)
                .then((response) => {
                    if (response.data.status == "success") {
                        console.log('berhasil')
                    } else {
                        console.log('gagal')
                    }
                    resolve(response.data)
                })
                .catch((error) => {
                    //JIKA GAGALNYA VALIDASI MAKA ERRONYA AKAN DI ASSIGN
                    if (error.response.status == 422) {
                        commit('SET_ERRORS', error.response.data.errors, { root: true })
                    }
                })

        })
    },
    //safe delete
    removeVerifiedUser({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            $axios.post(`/userVerified/${payload}/delete`)
                .then((response) => {
                    dispatch('getVerifiedUser').then(() => resolve(response.data))
                })
        })
    },

    //function untuk permintaan user baru
    getRegister({ commit, state }, payload) {
        let search = typeof payload != 'undefined' ? payload : ''
        return new Promise((resolve, reject) => {
            //DENGAN MENGGUNAKAN AXIOS METHOD GET
            $axios.get(`/registration-users?page=${state.page}&q=${search}`)
                .then((response) => {
                    //KEMUDIAN DI COMMIT UNTUK MELAKUKAN PERUBAHA STATE
                    commit('ASSIGN_DATA', response.data)
                    resolve(response.data)
                })
        })
    },
    editRegister({ commit }, payload) {
        return new Promise((resolve, reject) => {
            //FUNGSI UNTUK MELAKUKAN REQUEST SINGLE DATA BERDASARKAN ID
            $axios.get(`/registration-users/${payload}/edit`)
                .then((response) => {
                    //DATA YANG DITERIMA AKAN DIKIRIMKAN KE FORM
                    resolve(response.data)
                })
        })
    },
    updateRegister({ state, commit }, payload) {
        return new Promise((resolve, reject) => {
            $axios.post(`/registration-users/${state.id}`, payload)
                .then((response) => {
                    if (response.data.status == "success") {
                        console.log('berhasil')
                    } else {
                        console.log('gagal')
                    }
                    resolve(response.data)
                })
                .catch((error) => {
                    //JIKA GAGALNYA VALIDASI MAKA ERRONYA AKAN DI ASSIGN
                    if (error.response.status == 422) {
                        commit('SET_ERRORS', error.response.data.errors, { root: true })
                    }
                })

        })
    },
    // safe delete
    removeRegister({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            $axios.post(`/registration-users/${payload}/delete`)
                .then((response) => {
                    dispatch('getRegister').then(() => resolve(response.data))
                })
        })
    },

    //school get data
    getSchool({ commit, state }, payload) {
        let search = typeof payload != 'undefined' ? payload : ''
        return new Promise((resolve, reject) => {
            //DENGAN MENGGUNAKAN AXIOS METHOD GET
            $axios.get(`/school?page=${state.page}&q=${search}`)
                .then((response) => {
                    //KEMUDIAN DI COMMIT UNTUK MELAKUKAN PERUBAHA STATE
                    commit('ASSIGN_DATA', response.data)
                    resolve(response.data)
                })
        })
    },
    editSekolah({ commit }, payload) {
        return new Promise((resolve, reject) => {
            //FUNGSI UNTUK MELAKUKAN REQUEST SINGLE DATA BERDASARKAN ID
            $axios.get(`/school/${payload}/edit`)
                .then((response) => {
                    //DATA YANG DITERIMA AKAN DIKIRIMKAN KE FORM
                    resolve(response.data)
                })
        })
    },
    updateSekolah({ state, commit }, payload) {
        return new Promise((resolve, reject) => {
            $axios.post(`/school/${state.id}`, payload)
                .then((response) => {
                    if (response.data.status == "success") {
                        console.log('berhasil')
                    } else {
                        console.log('gagal')
                    }
                    resolve(response.data)
                })
                .catch((error) => {
                    //JIKA GAGALNYA VALIDASI MAKA ERRONYA AKAN DI ASSIGN
                    if (error.response.status == 422) {
                        commit('SET_ERRORS', error.response.data.errors, { root: true })
                    }
                })

        })
    },
    // safe delete
    removeSchool({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            $axios.post(`/school/${payload}/delete`)
                .then((response) => {
                    dispatch('getSchool').then(() => resolve(response.data))
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