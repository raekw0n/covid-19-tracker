<template>
    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-md-12">
                <a href="/" class="text-dark">
                    <h1 class="heading">COVID-19</h1>
                </a>
                <a class="nav-link" href="https://github.com/raekw0n/covid-19-tracker">
                    <font-awesome-icon class="my-2 text-dark" size="2x" :icon="['fab', 'github']"/>
                </a>
                <hr>
                <p class="text-muted">
                    The data this API serves including all data, mapping, and analysis, copyright 2020 Johns Hopkins
                    University, all rights reserved, is provided to the public strictly for educational and academic
                    research purposes. The Website relies upon publicly available data from multiple sources, that do
                    not always agree. Weedmark Systems (the author of the API this website consumes) and The Johns Hopkins University (the
                    author of the data provided by this API) hereby disclaims any and all representations and warranties
                    with respect to this website, including accuracy, fitness for use, and merchantability. Reliance on
                    this website or API for medical guidance or use of this website or API in commerce is strictly
                    prohibited.
                </p>
                <a class="mr-3" href="https://covid19-api.weedmark.systems/api/v1/stats">Weedmark Systems</a>
                <a href="https://systems.jhu.edu/research/public-health/ncov/">John Hopkins CSSE</a>
                <hr>
            </div>
        </div>
        <div id="filters">
            <div class="mt-2">
                <form class="form-inline">
                    <label for="country" class="sr-only">Country:</label>
                    <input class="form-control mb-2 mr-sm-2" id="country" v-model="country" name="country"
                           type="search" placeholder="e.g. United Kingdom" @keyup.enter="get($event)">
                    <button type="submit" class="mb-2 btn btn-secondary"
                            v-on:click="get($event)">Search</button>
                </form>
            </div>
        </div>
        <div class="table-responsive mt-2">
            <table class="table table-hover table-striped table-bordered table-responsive-sm table-sm" id="covid-19">
                <thead>
                <tr>
                    <th scope="col">
                        <span class="text-primary th-link" @click="sort('country')">Country</span>
                    </th>
                    <th scope="col">
                        <span class="text-primary th-link" @click="sort('province')">Province</span>
                    </th>
                    <th scope="col">
                        <span class="text-primary th-link" @click="sort('confirmed')">Confirmed Cases</span>
                    </th>
                    <th scope="col">
                        <span class="text-primary th-link" @click="sort('deaths')">Deaths</span>
                    </th>
                    <th scope="col">
                        <span class="text-primary th-link" @click="sort('recovered')">Recovered</span>
                    </th>
                    <th scope="col">
                        <span class="text-primary th-link" @click="sort('lastUpdate')">Last Update</span>
                    </th>
                </tr>
                </thead>
                <tbody id="live-table">
                <tr v-for="stat in sorted" v-bind:key="stat.country + '_' + stat.province">
                    <td>{{ stat.country }}</td>
                    <td>{{ stat.province }}</td>
                    <td :class="{ 'text-muted': stat.confirmed <= 100, 'text-amber': stat.confirmed > 100 && stat.confirmed <= 1000, 'text-danger': stat.confirmed > 1000  }">{{ stat.confirmed.toLocaleString() }}</td>
                    <td :class="{ 'text-muted': stat.deaths === 0, 'text-danger': stat.deaths > 0 }">{{ stat.deaths.toLocaleString() }}</td>
                    <td :class="{ 'text-muted': stat.recovered === 0, 'text-success': stat.recovered > 0 }">{{ stat.recovered.toLocaleString() }}</td>
                    <td>{{ stat.lastUpdate|formatDate }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Tracker',
        data() {
            return {
                stats: [],
                country: '',
                sortKey: ['country'],
                sortOrder: ['asc'],
            }
        },
        mounted() {
            this.get();
        },
        computed: {
            sorted() {
                return this.$_.orderBy(this.stats, this.sortKey, this.sortOrder);
            },
        },
        methods: {
            sort(key) {
                if (key === this.sortKey) {
                    this.sortOrder = (this.sortOrder === 'asc') ? 'desc' : 'asc';
                } else {
                    this.sortKey = key;
                    this.sortOrder = 'asc';
                }
            },
            get(event) {
                if (event) event.preventDefault();
                this.params = this.$root.buildQueryString({
                    country: this.country
                });
                this.$http.get('https://covid19-api.weedmark.systems/api/v1/stats' + this.params, {
                }).then((response) => {
                    this.stats = response.data.data.covid19Stats;
                    console.log(this.stats);
                    history.pushState("", "", this.params)
                });
            }
        }
    }
</script>

<style>
    th:hover {
        cursor: pointer;
        text-decoration: underline #007bff;
    }

    .text-amber {
        color: #ff8a37 !important;
    }
</style>