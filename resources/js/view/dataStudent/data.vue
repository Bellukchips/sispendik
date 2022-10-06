<template>
    <div class="container-fluid">
        <div class="mb-4">
            <div class="card bg-info text-white shadow">
                <div class="card-body">
                    <h2 class="h2">Data Siswa</h2>

                    <h6>Catatan</h6>
                    <ul>
                        <li>
                            Jika data tidak muncul klik tombol reload page yang
                            di sediakan
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
                            @click.prevent="reloadPage"
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
                    :items="student.data"
                    :fields="fields"
                    show-empty
                    responsive
                >
                    <template v-slot:cell(actions)="row">
                        <router-link
                            :to="{
                                name: 'data-student.edit',
                                params: { id: row.item.id }
                            }"
                            class="btn btn-warning btn-circle"
                            ><i class="fa fa-edit"></i
                        ></router-link>
                        <button
                            class="btn btn-danger btn-circle"
                            @click.prevent="deleteStudent(row.item.id)"
                        >
                            <i class="fa fa-trash"></i>
                        </button>
                    </template>
                </b-table>
                <div class="row">
                    <div class="col-md-12">
                        <p v-if="student.data">
                            <i class="fa fa-bars"></i>
                            {{ student.data.length }} item dari
                            {{ student.meta.total }} total data
                        </p>
                    </div>
                    <div class="col-md-12">
                        <div class="pull-right">
                            <b-pagination
                                v-model="page"
                                :total-rows="student.meta.total"
                                :per-page="student.meta.per_page"
                                aria-controls="schools"
                                v-if="student.data && student.data.length > 0"
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
    name: "DataSiswa",
    created() {
        this.getStudent();
    },
    computed: {
        ...mapState(["errors"]),
        ...mapState("student", {
            student: state => state.student
        }),
        //STATE PAGE UNTUK MENGAMBIL DAN MENGUBAH DATA STATE
        page: {
            get() {
                return this.$store.state.student.page;
            },
            set(val) {
                this.$store.commit("student/SET_PAGE", val);
            }
        }
    },
    data() {
        return {
            fields: [
                { key: "nis", label: "Nis" },
                { key: "name", label: "Nama" },
                { key: "address", label: "Alamat" },
                { key: "actions", label: "Aksi" }
            ],
            search: ""
        };
    },
    watch: {
        page() {
            this.getStudent(); //MAKA FUNGSI INI DIJALANKAN
        },
        search() {
            this.getStudent(this.search);
        }
    },
    methods: {
        ...mapActions("student", ["getStudent"]),
        reloadPage() {
            location.reload();
            this.getStudent();
        },
    }
};
</script>
