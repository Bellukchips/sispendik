<template>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a
                href="#"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
            >
                <i class="fas fa-download fa-sm text-white-50"></i> Generate
                Report
            </a>
        </div>
        <!-- Content Row -->
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4" v-for="card in cards">
                <div :class="card.class">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div :class="card.styleFont">
                                    {{ card.title }}
                                </div>
                                <div
                                    class="h5 mb-0 font-weight-bold text-gray-800"
                                    v-if="card.type === 'value'"
                                >
                                    {{ card.value }}
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
import $axios from "../api";
import { Cartesian, Area } from "laue";
export default {
    components: {
        LaCartesian: Cartesian,
        LaArea: Area
    },
    mounted() {
        $axios.get(`/`).then(res => {
            this.$set(this.$data, "cards", res.data.cards);
        });
    },
    data() {
        return {
            cards: [],
            values: [{ value: 0 }, { value: 1 }, { value: 10 }],
        };
    },

};
</script>
