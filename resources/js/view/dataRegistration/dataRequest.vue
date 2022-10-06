<template>
    <div class="container-fluid">
        <div class="mb-4">
            <div class="card bg-info text-white shadow">
                <div class="card-body">
                    <h2 class="h2">Permintaan Akses User Baru</h2>

                    <h6>Catatan</h6>
                    <ul>
                        <li>
                            Jika data tidak muncul klik tombol reload page yang
                            di sediakan
                        </li>
                        <li>
                            Status akun (Inactive) untuk user yang baru daftar
                            dan akun belum diaktifkan
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <button
                            class="btn btn-primary btn-sm"
                            @click.prevent="reloadData"
                        >
                            <i class="fa fa-redo-alt"></i> Reload Page
                        </button>
                    </div>
                    <div class="col-md-6">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Cari..."
                            v-model="search"
                        />
                    </div>
                </div>
            </div>
            <div class="card-body">
                <b-table
                    striped
                    hover
                    bordered
                    :items="schools.data"
                    :fields="fields"
                    show-empty
                    responsive
                >
                    <template v-slot:cell(status)="row">
                        <span
                            class="btn btn-secondary"
                            v-if="row.item.status == 0"
                            >Inactive</span
                        >
                    </template>
                    <template v-slot:cell(actions)="row">
                        <router-link
                            :to="{
                                name: 'registration-users.edit',
                                params: { id: row.item.id }
                            }"
                            class="btn btn-warning btn-circle"
                            ><i class="fa fa-edit"></i
                        ></router-link>
                        <button
                            class="btn btn-danger btn-circle"
                            @click.prevent="deleteRegister(row.item.id)"
                        >
                            <i class="fa fa-trash"></i>
                        </button>
                    </template>
                </b-table>
                <div class="row">
                    <div class="col-md-12">
                        <p v-if="schools.data">
                            <i class="fa fa-bars"></i>
                            {{ schools.data.length }} item dari
                            {{ schools.meta.total }} total data
                        </p>
                    </div>
                    <div class="col-md-12">
                        <div class="pull-right">
                            <b-pagination
                                v-model="page"
                                :total-rows="schools.meta.total"
                                :per-page="schools.meta.per_page"
                                aria-controls="schools"
                                v-if="schools.data && schools.data.length > 0"
                            ></b-pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
export default {
    name: "DataUserRequest",
    created() {
        this.getRegister();
    },
    data() {
        return {
            fields: [
                { key: "id_users", label: "Npsn" },
                { key: "name", label: "Nama" },
                { key: "email", label: "Email" },
                { key: "status", label: "Status Akun" },
                { key: "actions", label: "Aksi" }
            ],
            search: ""
        };
    },
    computed: {
        ...mapState(["errors"]),
        ...mapState("school", {
            schools: state => state.schools
        }),
        //STATE PAGE UNTUK MENGAMBIL DAN MENGUBAH DATA STATE
        page: {
            get() {
                return this.$store.state.school.page;
            },
            set(val) {
                this.$store.commit("school/SET_PAGE", val);
            }
        }
    },
    watch: {
        page() {
            this.getRegister(); //MAKA FUNGSI INI DIJALANKAN
        },
        search() {
            this.getRegister(this.search);
        }
    },
    methods: {
        ...mapActions("school", ["getRegister", "removeRegister"]),
        //safe delete
        deleteRegister(id) {
            this.$swal({
                title: "Kamu Yakin?",
                icon: "warning",
                text: "Tindakan ini akan menghapus secara permanent!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Iya, Lanjutkan!",
                cancelButtonText: "Batalkan",
                allowOutsideClick: false
            }).then(result => {
                //JIKA DISETUJUI
                if (result.value) {
                    this.removeRegister(id);
                    this.$swal({
                        title: "Berhasil",
                        icon: "success",
                        text: "Berhasil menghapus data",
                        type: "success",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Oke"
                    });
                } else {
                    this.$swal({
                        title: "Di batalkan",
                        icon: "error",
                        text: "Tidak terjadi penghapusan data",
                        type: "error",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Oke"
                    });
                }
            });
        },
        reloadData() {
            location.reload();
            this.getRegister();
        }
    }
};
</script>
