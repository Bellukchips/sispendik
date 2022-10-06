<template>
    <div class="container">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Catatan Update Data
                </h6>
            </div>
            <div class="card-body">
                <ul>
                    <li>
                        Data Npsn tidak dapat di ubah pada halaman ini
                    </li>
                    <li>
                        Untuk ubah password silahkan isi form password
                    </li>
                    <li>
                        Jika password tidak di ubah maka kosongkan form password
                    </li>
                    <li>
                        Untuk mengaktifkan / menonaktifkan akun pilih opsi aktif
                        / tidak aktif
                    </li>
                </ul>
                <!-- 1.  Data Npsn tidak dapat di ubah pada halaman ini
                2.  Untuk ubah password silahkan isi form password
                3.  Jika password tidak di ubah maka kosongkan form password -->
            </div>
        </div>
        <div class="card shadow card-danger">
            <div class="card-header">
                Update Data
            </div>
            <div class="card-body">
                <form class="user">
                    <div class="form-group row">
                        <div
                            class="col-sm-6 mb-3 mb-sm-0"
                            :class="{ 'has-error': errors.id_users }"
                        >
                            <label for="">Npsn</label>
                            <input
                                type="number"
                                class="form-control"
                                placeholder="NPSN"
                                v-model="register.id_users"
                                disabled
                            />
                            <p class="text-danger" v-if="errors.id_users">
                                {{ errors.id_users[0] }}
                            </p>
                        </div>
                        <div
                            class="col-sm-6"
                            :class="{ 'has-error': errors.name }"
                        >
                            <label for="">Name</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Name"
                                v-model="register.name"
                            />
                            <p class="text-danger" v-if="errors.name">
                                {{ errors.name[0] }}
                            </p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div
                            class="col-sm-6 mb-3 mb-sm-0"
                            :class="{ 'has-error': errors.email }"
                        >
                            <label for="">Email</label>
                            <input
                                type="email"
                                class="form-control"
                                placeholder="Email Address"
                                v-model="register.email"
                            />
                            <p class="text-danger" v-if="errors.email">
                                {{ errors.email[0] }}
                            </p>
                        </div>
                        <div
                            class="col-sm-6"
                            :class="{ 'has-error': errors.password }"
                        >
                            <label for="">Password</label>
                            <input
                                type="password"
                                class="form-control"
                                placeholder="Password"
                                v-model="register.password"
                            />
                            <p class="text-danger" v-if="errors.password">
                                {{ errors.password[0] }}
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Status Akun</label>
                        <select class="form-control" v-model="register.status">
                            <option value="1">1 (Aktif)</option>
                            <option value="0">0 (Tidak Aktif)</option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <button
                                type="submit"
                                class="btn btn-primary btn-user btn-block"
                                @click.prevent="submit"
                            >
                                <span class="fa fa-save"></span>
                                Update Data
                            </button>
                        </div>
                        <div class="col-sm-6">
                            <button
                                type="submit"
                                class="btn btn-danger btn-user btn-block"
                                @click.prevent="cancel"
                            >
                                <span class="fa fa-backward"></span>
                                Batalkan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState, mapMutations, mapActions } from "vuex";
export default {
    name: "formUpdateSchool",
    created() {
        this.getRegister();
        this.editRegister(this.$route.params.id).then(res => {
            this.register = {
                id_users: res.data.id_users,
                name: res.data.name,
                email: res.data.email,
                password: "",
                status: res.data.status
            };
        });
    },
    data() {
        return {
            register: {
                id_users: "",
                name: "",
                email: "",
                password: "",
                status: false
            }
        };
    },
    computed: {
        ...mapState(["errors"]),
        ...mapState("school", {
            schools: state => state.schools
        })
    },
    methods: {
        ...mapActions("school", [
            "editRegister",
            "getRegister",
            "updateRegister"
        ]),
        ...mapMutations("school", ["SET_ID_UPDATE"]),
        cancel() {
            this.$router.push({ name: "registration-users.data" });
        },
        submit() {
            this.$vs.loading();
            if (
                !this.register.id_users ||
                !this.register.name ||
                !this.register.email
            ) {
                setTimeout(() => {
                    this.$vs.loading.close();
                }, 1000);
            } else {
                let form = new FormData();
                form.append("id_users", this.register.id_users);
                form.append("name", this.register.name);
                form.append("email", this.register.email);
                form.append("password", this.register.password);
                form.append("status", this.register.status);
                this.SET_ID_UPDATE(this.$route.params.id);
                this.updateRegister(form).then(() => {
                    this.register = {
                        id_users: "",
                        name: "",
                        email: "",
                        password: "",
                        status: false
                    };
                    this.$router.push({ name: "registration-users.data" });
                    this.$swal({
                        title: "Berhasil",
                        icon: "success",
                        text: "Berhasil mengubah data",
                        type: "success",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Oke"
                    });
                    setTimeout(() => {
                        this.$vs.loading.close();
                    }, 3000);
                });
            }
        }
    }
};
</script>
