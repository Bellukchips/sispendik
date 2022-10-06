import $axios from "../api.js";
// import { reject } from "lodash";
const state = () => ({});

const mutations = {};

const actions = {
    submit({ commit }, payload) {
        localStorage.setItem("token", null); //RESET LOCAL STORAGE MENJADI NULL
        commit("SET_TOKEN", null, { root: true }); //RESET STATE TOKEN MENJADI NULL

        return new Promise((resolve, reject) => {
            //MENGIRIM REQUEST KE SERVER DENGAN URI /login
            //DAN PAYLOAD ADALAH DATA YANG DIKIRIMKAN DARI COMPONENT LOGIN.VUE
            $axios
                .post("/login", payload)
                .then(response => {
                    //KEMUDIAN JIKA RESPONNYA SUKSES
                    if (response.data.status == "success") {
                        //MAKA LOCAL STORAGE DAN STATE TOKEN AKAN DISET MENGGUNAKAN
                        //API DARI SERVER RESPONSE
                        localStorage.setItem("token", response.data.data);
                        commit("SET_TOKEN", response.data.data, { root: true });
                    } else if (response.data.status == "deactive") {
                        commit(
                            "SET_ERRORS",
                            { invalid: "Akun yang anda buat belum aktif" },
                            { root: true }
                        );
                    } else {
                        commit(
                            "SET_ERRORS",
                            { invalid: "Email/Password Salah" },
                            { root: true }
                        );
                    }
                    //JANGAN LUPA UNTUK MELAKUKAN RESOLVE AGAR DIANGGAP SELESAI
                    resolve(response.data);
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        commit("SET_ERRORS", error.response.data.errors, {
                            root: true
                        });
                        location.reload();
                    }
                });
        });
    }
};

export default {
    namespaced: true,
    state,
    actions,
    mutations
};
