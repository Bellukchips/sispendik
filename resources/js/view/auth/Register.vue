<template>
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <FlashMessage :position="'right top'" v-if="errors.invalid">{{
                    errors.invalid
                }}</FlashMessage>
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-register"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">
                                    Daftar Akun!
                                </h1>
                            </div>
                            <div
                                class="alert alert-danger"
                                v-if="errors.invalid"
                            >
                                {{ errors.invalid }}
                            </div>
                            <div
                                class="alert alert-success"
                                v-if="success.valid"
                            >
                                {{ success.valid }}
                            </div>
                            <form class="user" autocomplete="false">
                                <div class="form-group row">
                                    <div
                                        class="col-sm-6 mb-3 mb-sm-0"
                                        :class="{ 'has-error': errors.code }"
                                    >
                                        <input
                                            type="number"
                                            class="form-control form-control-user"
                                            placeholder="NPSN"
                                            v-model="register.code"
                                            autocomplete="false"
                                        />
                                        <p
                                            class="text-danger"
                                            v-if="errors.code"
                                        >
                                            {{ errors.code[0] }}
                                        </p>
                                    </div>
                                    <div
                                        class="col-sm-6"
                                        :class="{ 'has-error': errors.name }"
                                    >
                                        <input
                                            type="text"
                                            class="form-control form-control-user"
                                            placeholder="Nama Sekolah.."
                                            v-model="register.name"
                                            onkeyup="this.value = this.value.toUpperCase();"
                                            autocomplete="false"
                                        />
                                        <p
                                            class="text-danger"
                                            v-if="errors.name"
                                        >
                                            {{ errors.name[0] }}
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="form-group"
                                    :class="{ 'has-error': errors.email }"
                                >
                                    <input
                                        type="email"
                                        class="form-control form-control-user"
                                        placeholder="Alamat Email.."
                                        v-model="register.email"
                                        autocomplete="false"
                                    />
                                    <p class="text-danger" v-if="errors.email">
                                        {{ errors.email[0] }}
                                    </p>
                                </div>
                                <div
                                    class="form-group"
                                    :class="{ 'has-error': errors.password }"
                                >
                                    <input
                                        type="password"
                                        class="form-control form-control-user"
                                        placeholder="Password"
                                        v-model="register.password"
                                        autocomplete="false"
                                    />
                                    <p
                                        class="text-danger"
                                        v-if="errors.password"
                                    >
                                        {{ errors.password[0] }}
                                    </p>
                                </div>
                                <div
                                    class="form-group"
                                    :class="{ 'has-error': errors.address }"
                                >
                                    <textarea
                                        class="form-control"
                                        cols="5"
                                        rows="5"
                                        v-model="register.address"
                                        autocomplete="false"
                                    ></textarea>
                                    <p
                                        class="text-danger"
                                        v-if="errors.address"
                                    >
                                        {{ errors.address[0] }}
                                    </p>
                                </div>
                                <button
                                    type="submit"
                                    class="btn btn-primary btn-user btn-block"
                                    @click.prevent="submit"
                                >
                                    Daftar
                                </button>
                                <hr />
                            </form>

                            <div class="text-center">
                                <router-link
                                    class="small"
                                    :to="{ name: 'forgot-password' }"
                                    >Forgot Password?</router-link
                                >
                            </div>
                            <div class="text-center">
                                <router-link class="small" to="/login"
                                    >Sudah punya akun ?
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState, mapMutations } from "vuex";
export default {
    data() {
        return {
            register: {
                code: "",
                name: "",
                email: "",
                password: "",
                address: ""
            },
            reg: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,
        };
    },
    computed: {
        ...mapState(["errors"]),
        ...mapState(["success"]),
        ...mapState("register", {
            schools: state => state.schools
        })
    },
    methods: {
        ...mapActions("register", ["submitRegister"]),
        ...mapMutations(["CLEAR_SUCCESS"]),
        submit() {
            this.$vs.loading();
            if (
                !this.register.code &&
                !this.register.name &&
                !this.register.email &&
                !this.register.password
            ) {
                setTimeout(() => {
                    this.$vs.loading.close();
                }, 500);
            } 
            if(this.register.password.length < 6){
                setTimeout(() => {
                    this.$vs.loading.close();
                }, 500);
            }
            if(!this.reg.test(this.register.email)){
                setTimeout(() => {
                    this.$vs.loading.close();
                }, 500);
            }
            let form = new FormData();
                form.append("code", this.register.code);
                form.append("name", this.register.name);
                form.append("email", this.register.email);
                form.append("password", this.register.password);
                form.append("address", this.register.address);
                this.submitRegister(form).then(() => {
                    this.register = {
                        code: "",
                        name: "",
                        email: "",
                        password: "",
                        address: ""
                    };
                    setTimeout(() => {
                        this.$vs.loading.close();
                    }, 3000);
                });
        }
    },
    destroyed() {
        this.CLEAR_SUCCESS();
    }
};
</script>
