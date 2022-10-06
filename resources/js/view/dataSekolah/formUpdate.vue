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
                        Data Npsn dapat di ubah pada halaman ini
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
                    <div
                        class="form-group"
                        :class="{ 'has-error': errors.code }"
                    >
                        <label for="">Npsn</label>
                        <input
                            type="number"
                            class="form-control"
                            placeholder="NPSN"
                            v-model="school.code"
                        />
                        <p class="text-danger" v-if="errors.code">
                            {{ errors.code[0] }}
                        </p>
                    </div>
                    <div
                        class="form-group"
                        :class="{ 'has-error': errors.name }"
                    >
                        <label for="">Name</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Name"
                            v-model="school.name"
                        />
                        <p class="text-danger" v-if="errors.name">
                            {{ errors.name[0] }}
                        </p>
                    </div>
                    <div
                        class="form-group"
                        :class="{ 'has-error': errors.address }"
                    >
                        <label for="">Address</label>
                        <textarea
                            cols="30"
                            rows="10"
                            class="form-control"
                            placeholder="Address"
                            v-model="school.address"
                        ></textarea>
                        <p class="text-danger" v-if="errors.address">
                            {{ errors.address[0] }}
                        </p>
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
    name: "FormUpdateVerifiedUser",
    created() {
        this.getSchool();
        this.editSekolah(this.$route.params.id).then(res => {
            this.school = {
                code: res.data.code,
                name: res.data.name,
                address: res.data.address
            };
        });
    },
    data() {
        return {
            school: {
                code: "",
                name: "",
                address: ""
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
        ...mapActions("school", ["getSchool", "editSekolah", "updateSekolah"]),
        ...mapMutations("school", ["SET_ID_UPDATE"]),
        cancel() {
            this.$router.push({ name: "school.data" });
        },
        submit() {
            let form = new FormData();
            form.append("code", this.school.code);
            form.append("name", this.school.name);
            form.append("address", this.school.address);
            this.SET_ID_UPDATE(this.$route.params.id);
            this.updateSekolah(form).then(() => {
                this.school = {
                    code: "",
                    name: "",
                    address: ""
                };
                this.$router.push({ name: "school.data" });
                this.$swal({
                    title: "Berhasil",
                    icon: "success",
                    text: "Berhasil mengubah data",
                    type: "success",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Oke"
                });
            });
        }
    }
};
</script>
