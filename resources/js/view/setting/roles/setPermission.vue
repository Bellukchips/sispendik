<template>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Catatan
                </h6>
            </div>
            <div class="card-body">
                <ul>
                    <li>
                        Set Role User
                    </li>
                    <li>
                        Set Permission User , Pilih Role dan Check Permission Role Untuk Mengetahui Permission Role
                    </li>
                    <li>
                        Jika Permission Masih Kosong Pilih Permission Yang dibutuh kan
                    </li>
                </ul>
                <!-- 1.  Data Npsn tidak dapat di ubah pada halaman ini
                2.  Untuk ubah password silahkan isi form password
                3.  Jika password tidak di ubah maka kosongkan form password -->
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <div class="form-group">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <h2>Setting Role</h2>
                                <div
                                    class="alert alert-success"
                                    v-if="alert_role"
                                >
                                    Role Has Been Added
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Role</label>
                            <select
                                class="form-control"
                                v-model="role_user.role"
                            >
                                <option value="">Pilih</option>
                                <option
                                    v-for="(row, index) in roles"
                                    :value="row.name"
                                    :key="index"
                                    >{{ row.name }}</option
                                >
                            </select>
                            <p class="text-danger" v-if="errors.role_id">
                                {{ errors.role_id[0] }}
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="">User</label>
                            <select
                                class="form-control"
                                v-model="role_user.user_id"
                            >
                                <option value="">Pilih</option>
                                <option
                                    v-for="(row, index) in users"
                                    :value="row.id"
                                    :key="index"
                                    >{{ row.name }} ({{ row.email }})</option
                                >
                            </select>
                        </div>
                        <div class="form-group">
                            <button
                                class="btn btn-danger btn-sm"
                                @click.prevent="setRole"
                            >
                                Set Role
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <div class="form-group">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <h2>Setting Permission</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Role</label>
                            <select
                                class="form-control"
                                v-model="role_selected"
                            >
                                <option value="">Pilih</option>
                                <option
                                    v-for="(row, index) in roles"
                                    :value="row.id"
                                    :key="index"
                                    >{{ row.name }}</option
                                >
                            </select>
                            <p class="text-danger" v-if="errors.role_id">
                                {{ errors.role_id[0] }}
                            </p>
                        </div>
                        <div class="form-group">
                            <button
                                class="btn btn-primary btn-sm"
                                @click="checkPermission"
                            >
                                {{ loading ? "Loading..." : "Check" }}
                            </button>
                        </div>
                        <div class="form-group">
                            <div
                                class="alert alert-success"
                                v-if="alert_permission"
                            >
                                Permission has been assigned
                            </div>
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_1" data-toggle="tab"
                                            >Permissions</a
                                        >
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <template
                                            v-for="(row, index) in permissions"
                                        >
                                            <input
                                                type="checkbox"
                                                class="minimal-red"
                                                :key="index"
                                                :value="row.name"
                                                :checked="
                                                    role_permission.findIndex(
                                                        x => x.name == row.name
                                                    ) != -1
                                                "
                                                @click="addPermission(row.name)"
                                            />
                                            {{ row.name }}
                                            <br :key="'row' + index" />
                                            <br
                                                :key="'enter' + index"
                                                v-if="(index + 1) % 4 == 0"
                                            />
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button
                                class="btn btn-primary btn-sm"
                                @click="setPermission"
                            >
                                <i class="fa fa-check"></i> Set Permission
                            </button>
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
    name: "SetPermission",
    data() {
        return {
            role_user: {
                role: "",
                user_id: ""
            },
            role_selected: "",
            new_permission: [],
            loading: false,
            alert_permission: false,
            alert_role: false
        };
    },
    created() {
        this.getRoles();
        this.getAllPermission();
        this.getUserLists();
    },
    computed: {
        ...mapState(["errors"]),
        ...mapState("user", {
            users: state => state.users,
            roles: state => state.roles,
            permissions: state => state.permissions,
            role_permission: state => state.role_permission
        })
    },
    methods: {
        ...mapActions("user", [
            "getUserLists",
            "getRoles",
            "getAllPermission",
            "getRolePermission",
            "setRolePermission",
            "setRoleUser"
        ]),
        ...mapMutations("user", ["CLEAR_ROLE_PERMISSION"]),
        setRole() {
            this.setRoleUser(this.role_user).then(() => {
                this.alert_role = true;
                setTimeout(() => {
                    this.role_user = {
                        role: "",
                        user_id: ""
                    };
                    this.alert_role = false;
                }, 1000);
            });
        },
        addPermission(name) {
            let index = this.new_permission.findIndex(x => x == name);
            if (index == -1) {
                this.new_permission.push(name);
            } else {
                this.new_permission.splice(index, 1);
            }
        },
        checkPermission() {
            this.loading = true;
            this.getRolePermission(this.role_selected).then(() => {
                this.loading = false;
                this.new_permission = this.role_permission;
            });
        },
        setPermission() {
            this.setRolePermission({
                role_id: this.role_selected,
                permissions: this.new_permission
            }).then(res => {
                if (res.status == "success") {
                    this.alert_permission = true;
                    setTimeout(() => {
                        this.role_selected = "";
                        this.new_permission = [];
                        this.loading = false;
                        this.alert_permission = false;
                        this.CLEAR_ROLE_PERMISSION();
                        location.reload();
                    }, 1000);
                }
            });
        }
    }
};
</script>
<style type="text/css">
.tab-pane {
    height: 150px;
    overflow-y: scroll;
}
</style>
