<template>
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div
                                class="col-lg-6 d-none d-lg-block bg-password"
                            ></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            Lupa Password ?
                                        </h1>
                                    </div>
                                    <form class="user">
                                        <div
                                            class="form-group "
                                            :class="{
                                                'has-error': errors.email
                                            }"
                                        >
                                            <input
                                                type="text"
                                                class="form-control form-control-user"
                                                placeholder="Enter Email..."
                                                v-model="data.email"
                                                autocomplete="true"
                                                v-bind:class="{
                                                    'is-invalid':
                                                        data.errorEmail,
                                                    'is-valid': data.infoEmail
                                                }"
                                            />
                                            <p
                                                class="text-danger"
                                                v-if="errors.email"
                                            >
                                                {{ errors.email[0] }}
                                            </p>
                                            <div class="invalid-feedback">
                                                {{ data.errorEmail }}
                                            </div>
                                            <div class="valid-feedback">
                                                {{ data.infoEmail }}
                                            </div>
                                        </div>
                                        <button
                                            type="submit"
                                            class="btn btn-primary btn-user btn-block"
                                            @click.prevent="sendToken"
                                        >
                                            Send Email
                                            <i class="fa fa-mail-bulk"></i>
                                        </button>
                                        <hr />
                                    </form>
                                    <!--form token-->
                                    <div
                                        class="alert alert-secondary"
                                        v-if="data.sendEmail"
                                    >
                                        <form class="user">
                                            <div class="form-group">
                                                <label for="">Token</label>
                                                <input
                                                    type="text"
                                                    class="form-control form-control-user"
                                                    v-bind:class="{
                                                        'is-invalid':
                                                            data.errorToken,
                                                        'is-valid':
                                                            data.infoToken
                                                    }"
                                                    placeholder="Token ..."
                                                    v-model="data.token"
                                                />
                                                <div class="invalid-feedback">
                                                    {{ data.errorToken }}
                                                </div>
                                                <div class="valid-feedback">
                                                    {{ data.infoToken }}
                                                </div>
                                            </div>
                                            <button
                                                class="btn btn-secondary"
                                                type="submit"
                                                @click.prevent="validateToken"
                                            >
                                                Validate Token
                                            </button>
                                        </form>
                                    </div>
                                    <!--form new password-->
                                    <div
                                        class="alert alert-success"
                                        v-if="data.tokenValid"
                                    >
                                        <form
                                            v-on:submit.prevent="changePassword"
                                            class="user"
                                        >
                                            <div
                                                class="form-group"
                                                :class="{
                                                    'has-error': errors.password
                                                }"
                                            >
                                                <label for=""
                                                    >New Password</label
                                                >
                                                <input
                                                    type="password"
                                                    class="form-control form-control-user"
                                                    v-bind:class="{
                                                        'is-invalid':
                                                            data.errorNewPassword
                                                    }"
                                                    placeholder="New Password ..."
                                                    v-model="data.password"
                                                />
                                                <p
                                                    class="text-danger"
                                                    v-if="errors.password"
                                                >
                                                    {{ errors.password[0] }}
                                                </p>
                                                <div class="invalid-feedback">
                                                    {{ data.errorNewPassword }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="">
                                                    Password Confirmation</label
                                                >
                                                <input
                                                    type="password"
                                                    class="form-control form-control-user"
                                                    v-bind:class="{
                                                        'is-invalid':
                                                            data.errorPasswordAgain
                                                    }"
                                                    placeholder="Password Confirmation ..."
                                                    v-model="data.passwordAgain"
                                                />
                                                <div class="invalid-feedback">
                                                    {{
                                                        data.errorPasswordAgain
                                                    }}
                                                </div>
                                            </div>
                                            <button
                                                class="btn btn-success"
                                                type="submit"
                                            >
                                                Change Password
                                            </button>
                                        </form>
                                    </div>

                                    <div class="text-center">
                                        <router-link
                                            class="small"
                                            to="/register"
                                            >Daftar Akun !</router-link
                                        >
                                    </div>

                                    <div class="text-center">
                                        <router-link class="small" to="/login"
                                            >Masuk Akun !</router-link
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapMutations, mapGetters, mapState } from "vuex";
import $axios from "../../../api.js";
// import axios from "axios";
export default {
    name: "password-reset",
    data() {
        return {
            data: {
                email: "",
                errorEmail: null,
                sendEmail: false,
                infoEmail: null,
                token: "",
                errorToken: null,
                newPassword: "",
                errorNewPassword: null,
                passwordAgain: "",
                errorPasswordAgain: null,
                tokenValid: false,
                user: null,
                infoToken: null
                // sendToken:false
            }
        };
    },
    computed: {
        ...mapState(["errors"])
    },
    methods: {
        ...mapMutations(["CLEAR_ERRORS"]),
        sendToken() {
            this.$vs.loading();
            this.data.errorEmail = null;
            if (!this.data.email) {
                setTimeout(() => {
                    this.$vs.loading.close();
                }, 1000);
                this.data.errorEmail = "Email address is required.";
            }
            if (!this.data.errorEmail) {
                const data = {
                    email: this.data.email
                };
                return new Promise((resolve, reject) => {
                    $axios
                        .post(`/send-token`, data)
                        .then(response => {
                            if (response.data.success) {
                                setTimeout(() => {
                                    this.$vs.loading.close();
                                }, 3000);
                                this.data.infoEmail = response.data.success;
                                this.data.sendEmail = true;
                                this.data.sendToken = false;
                            } else if (response.data.errors) {
                                setTimeout(() => {
                                    this.$vs.loading.close();
                                }, 3000);
                                this.data.errorEmail = response.data.errors;
                                this.data.infoEmail = null;
                                this.data.sendEmail = false;
                            }
                        })
                        .catch(error => {
                            setTimeout(() => {
                                this.$vs.loading.close();
                            }, 3000);
                            this.data.errorEmail = error.response.data.errors;
                        });
                });
            }
        },
        validateToken() {
            this.$vs.loading();
            this.data.errorToken = null;
            if (!this.data.token) {
                setTimeout(() => {
                    this.$vs.loading.close();
                }, 500);
                this.data.errorToken = "Token is required";
            }
            if (!this.data.errorToken) {
                const data = {
                    token: this.data.token
                };
                $axios
                    .post(`/validate-token`, data)
                    .then(response => {
                        if (response.data.success) {
                            setTimeout(() => {
                                this.$vs.loading.close();
                            }, 3000);
                            this.data.tokenValid = true;
                            this.data.sendEmail = false;
                            this.data.infoToken = response.data.success;
                        } else {
                            setTimeout(() => {
                                this.$vs.loading.close();
                            }, 3000);
                            this.data.errorToken = response.data.errors;
                            this.data.infoToken = null;
                            this.data.tokenValid = false;
                        }
                    })
                    .catch(error => {
                        setTimeout(() => {
                            this.$vs.loading.close();
                        }, 3000);
                        this.data.errorToken = error.response.data.errors;
                    });
            }
        },
        changePassword() {
            this.$vs.loading();
            this.data.errorNewPassword = null;
            this.data.errorPasswordAgain = null;
            if (!this.data.password) {
                setTimeout(() => {
                    this.$vs.loading.close();
                }, 500);
                this.data.errorNewPassword = "New Password is required";
            }
            if (!this.data.passwordAgain) {
                setTimeout(() => {
                    this.$vs.loading.close();
                }, 500);
                this.data.errorPasswordAgain =
                    "Password Confirmation is required";
            }
            if (this.data.password.length < 6) {
                setTimeout(() => {
                    this.$vs.loading.close();
                }, 500);
                this.data.errorNewPassword = "Minimal password 6 huruf";
            }

            if (this.data.password !== this.data.passwordAgain) {
                setTimeout(() => {
                    this.$vs.loading.close();
                }, 500);
                this.data.errorPasswordAgain = "Password do not match";
            }
            if (!this.data.errorNewPassword && !this.data.errorPasswordAgain) {
                const data = {
                    password: this.data.password,
                    email: this.data.email
                };
                $axios.post(`/reset-password`, data).then(response => {
                    setTimeout(() => {
                        this.$vs.loading.close();
                    }, 2000);
                    this.$router.push("/login");
                    this.$swal({
                        title: "Berhasil",
                        icon: "success",
                        text: "Berhasil mengubah password",
                        type: "success",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Oke"
                    });
                });

                // this.app.req.post("reset-password", data).then(() => {
                //     this.$router.push("/login");
                // });
            }
        }
    },
    destroyed() {
        if (!this.data.email) {
            return null;
        }
        const data = {
            email: this.data.email
        };
        $axios.post(`/delete-token`, data);
    }
};
</script>
