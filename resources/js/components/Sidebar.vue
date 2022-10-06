<template>
    <ul
        class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
        id="accordionSidebar"
    >
        <!-- Sidebar - Brand -->
        <a
            class="sidebar-brand d-flex align-items-center justify-content-center"
            href="#"
        >
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">
                Sispendik Admin <sup>2</sup>
            </div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <router-link class="nav-link" to="/" exact>
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></router-link
            >
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider" />

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a
                class="nav-link collapsed"
                href="#"
                data-toggle="collapse"
                data-target="#collapseTwo"
                aria-expanded="true"
                aria-controls="collapseTwo"
            >
                <i class="fas fa-fw fa-archive"></i>
                <span>Management</span>
            </a>
            <div
                id="collapseTwo"
                class="collapse"
                aria-labelledby="headingTwo"
                data-parent="#accordionSidebar"
            >
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Management</h6>
                    <li v-if="$can('read schoolNotverified')">
                        <router-link
                            class="collapse-item"
                            :to="{ name: 'registration-users.data' }"
                            exact
                            >Permintaan User
                        </router-link>
                    </li>
                    <li v-if="$can('read schoolverified')">
                        <router-link
                            class="collapse-item"
                            :to="{ name: 'userVerified.data' }"
                            exact
                            >User Terverifikasi</router-link
                        >
                    </li>
                    <li v-if="$can('read dataSekolah')">
                        <router-link
                            class="collapse-item"
                            :to="{ name: 'school.data' }"
                            exact
                            >Manage Sekolah</router-link
                        >
                    </li>
                    <li v-if="$can('read student')">
                        <router-link
                            class="collapse-item"
                            :to="{ name: 'data-student.data' }"
                            exact
                            >Manage Student</router-link
                        >
                    </li>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a
                class="nav-link collapsed"
                href="#"
                data-toggle="collapse"
                data-target="#collapseUtilities"
                aria-expanded="true"
                aria-controls="collapseUtilities"
            >
                <i class="fas fa-fw fa-wrench"></i>
                <span>Settings</span>
            </a>
            <div
                id="collapseUtilities"
                class="collapse"
                aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar"
            >
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Settings</h6>
                    <router-link
                        class="collapse-item"
                        :to="{ name: 'role-permissions' }"
                        >Role & Permissions</router-link
                    >
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider" />
    </ul>
</template>
