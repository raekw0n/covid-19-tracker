<template>
    <div class="container pt-3">
        <div class="row">
            <div class="col-md-12">
                <small class="text-muted">(Data source: <a href="https://systems.jhu.edu/research/public-health/ncov/">John Hopkins CSSE</a>)</small>
                <br />
                <small class="text-muted">(Last updated: {{ this.last_updated|formatDate }})</small>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-sm-12 py-2">
                <div class="h-100">
                    <div class="text-dark">
                        <h6 class="text-uppercase">Cases</h6>
                        <h1 class="display-4">{{ this.total_cases.toLocaleString() }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-12 py-2">
                <div class="h-100">
                    <div class="text-danger">
                        <h6 class="text-uppercase">Deaths</h6>
                        <h1 class="display-4">{{ this.total_deaths.toLocaleString() }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-12 py-2">
                <div class="h-100">
                    <div class="text-success">
                        <h6 class="text-uppercase">Recovered</h6>
                        <h1 class="display-4">{{ this.total_recovered.toLocaleString() }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div id="filters">
                    <div class="mt-2 w-100 d-flex justify-content-between">
                        <form class="form-inline">
                            <label for="country" class="sr-only">Country:</label>
                            <select class="form-control mb-2 mr-sm-2 custom-select" name="country"
                                    id="country" v-model="selected" @change="get($event)">
                                <option value="" selected>-- Please Select --</option>
                                <option v-for="country in this.countries" v-bind:key="country.id"
                                        v-bind:value="country.name" >{{ country.name }}</option>
                            </select>
                            <label for="province" class="sr-only">Province:</label>
                            <input class="form-control mb-2 mr-sm-2" id="province" v-model="province" name="province"
                                   type="search" placeholder="Enter province..." @keyup.enter="get($event)">
                            <button type="submit" class="mb-2 btn btn-secondary"
                                    v-on:click="get($event)">Search</button>
                        </form>
                        <div class="d-none d-sm-inline-flex">
                            <label for="limit" class="sr-only">Per Page:</label>
                            <select name="limit" title="Per Page" class="form-control mb-2 mr-sm-2" id="limit"
                                    v-model="limit" @change="get($event)">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
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
                        <tr v-if="sorted.length === 0"><td colspan="6">No Results...</td></tr>
                        <tr v-for="stat in sorted" v-bind:key="stat.id">
                            <td>{{ stat.country }}</td>
                            <td>{{ stat.province }}</td>
                            <td :class="{
                                'text-muted': stat.confirmed <= 100,
                                'text-amber': stat.confirmed > 100 && stat.confirmed <= 1000,
                                'text-danger': stat.confirmed > 1000  }">{{ stat.confirmed.toLocaleString() }}
                            </td>
                            <td :class="{
                                'text-muted': stat.deaths === 0,
                                'text-danger': stat.deaths > 0 }">{{ stat.deaths.toLocaleString() }}
                            </td>
                            <td :class="{
                                'text-muted': stat.recovered === 0,
                                'text-success': stat.recovered > 0 }">{{ stat.recovered.toLocaleString() }}
                            </td>
                            <td>{{ stat.last_updated|formatDate }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        <nav class="mx-auto">
                            <ul class="pagination">
                                <li class="page-item">
                                    <button type="button" class="page-link" @click="prevPage">
                                        <font-awesome-icon :icon="['fas', 'caret-left']"></font-awesome-icon>
                                    </button>
                                </li>
                                <li class="page-item">
                                    <button v-bind:key="pageNumber" type="button" class="page-link"
                                            v-for="pageNumber in this.pages"
                                            :class="{ 'active': pageNumber === page }"
                                            @click="getPage(pageNumber)">
                                        {{pageNumber}}
                                    </button>
                                </li>
                                <li class="page-item">
                                    <button type="button" @click="nextPage" class="page-link">
                                        <font-awesome-icon :icon="['fas', 'caret-right']"></font-awesome-icon>
                                    </button>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Tracker',
        data() {
            return {
                stats: [],
                countries: [],
                province: '',
                selected: '',
                total_cases: 0,
                total_deaths: 0,
                total_recovered: 0,
                last_updated: '',
                page: 1,
                pages: 1,
                limit: 10,
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
            }
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
                    country: this.selected,
                    province: this.province,
                    page: this.page,
                    limit: this.limit
                });

                this.$http.get('http://api.covid-19.local/statistics' + this.params, {
                }).then((response) => {
                    this.stats = response.data.data.items;
                    this.page = response.data.data.page;
                    this.limit = response.data.data.limit;
                    this.pages = response.data.data.pages;

                    this.total_cases = response.data.totals.confirmed;
                    this.total_deaths = response.data.totals.deaths;
                    this.total_recovered = response.data.totals.recovered;
                    this.last_updated = response.data.data.last_update;

                    history.pushState("", "", this.params)
                });

                this.$http.get('http://api.covid-19.local/countries', {
                }).then((response) => {
                    this.countries = response.data.countries;
                });
            },
            getPage(page){
                this.page = page;
                this.get();
            },
            nextPage(){
                this.page++;
                this.get();
            },
            prevPage(){
                this.page--;
                this.get();
            }
        }
    }
</script>

<style lang="scss">
    a {
        &:hover {
            cursor: pointer;
            color: #007bff !important;
        }
    }
    th {
        &:hover {
            cursor: pointer;
            text-decoration: underline #007bff;
        }
    }

    .text-amber {
        color: #ff8a37 !important;
    }

    button.page-link {
        font-size: 0.95rem;
        background-color: transparent;
        border: none;
        display: inline-block;
        color: rgba(0,0,0,.5);
        font-weight: 500;

        &.active {
            background: rgba(0,0,0,.5);
            color: white;
        }
    }

    .offset{
        width: 500px !important;
        margin: 20px auto;
    }
</style>