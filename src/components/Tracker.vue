<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="h4 mb-3 text-gray-800 text-left">COVID-19 Tracker</h1>
                <a href="https://github.com/raekw0n/covid-19">Github</a>
            </div>
        </div>
        <div id="filters">
            <div class="mt-2">
                <form class="form-inline">
                    <label for="country" class="sr-only">Country:</label>
                    <input class="form-control mb-2 mr-sm-2" id="country" v-model="country" name="country"
                           type="search" placeholder="e.g. United Kingdom" @keyup.enter="get">
                </form>
            </div>
        </div>
        <div class="table-responsive mt-2">
            <table class="table table-hover table-striped table-bordered table-sm">
                <thead>
                <tr>
                    <th scope="col">
                        <span class="text-dark th-link" @click="sort('country')">Country</span>
                    </th>
                    <th scope="col">
                        <span class="text-dark th-link" @click="sort('province')">Province</span>
                    </th>
                    <th scope="col">
                        <span class="text-dark th-link" @click="sort('confirmed_cases')">Confirmed Cases</span>
                    </th>
                    <th scope="col">
                        <span class="text-dark th-link" @click="sort('deaths')">Deaths</span>
                    </th>
                    <th scope="col">
                        <span class="text-dark th-link" @click="sort('recovered')">Recovered</span>
                    </th>
                    <th scope="col">
                        <span class="text-dark th-link" @click="sort('lastUpdate')">Last Update</span>
                    </th>
                </tr>
                </thead>
                <tbody id="live-table">
                <tr v-for="stat in this.stats" v-bind:key="stat.country + '_' + stat.province">
                    <td>{{ stat.country }}</td>
                    <td>{{ stat.province }}</td>
                    <td>{{ stat.confirmed }}</td>
                    <td>{{ stat.deaths }}</td>
                    <td>{{ stat.recovered }}</td>
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
            },
        }
    }
</script>

<style>
    .container {
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }
    @media (min-width: 768px) {
        .container {
            width: 750px;
        }
    }
    @media (min-width: 992px) {
        .container {
            width: 970px;
        }
    }
    @media (min-width: 1200px) {
        .container {
            width: 1170px;
        }
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dfe1f2;
    }

    .mt-2 {
        margin-top: 2rem;
    }
</style>