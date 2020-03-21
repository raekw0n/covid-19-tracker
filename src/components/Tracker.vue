<template>
    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-md-12">
                <h1 class="heading">COVID-19 Tracker</h1>
                <a class="nav-link" href="https://github.com/raekw0n/covid-19-tracker">
                    <font-awesome-icon class="my-2 text-dark" size="2x" :icon="['fab', 'github']"/>
                </a>
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
                    <td class="text-success">{{ stat.confirmed }}</td>
                    <td class="text-danger">{{ stat.deaths }}</td>
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
            get() {
                this.stats = [
                    {
                        "province": "Hubei",
                        "country": "China",
                        "lastUpdate": "2020-03-20T07:43:02",
                        "confirmed": 67800,
                        "deaths": 3133,
                        "recovered": 58382
                    },
                    {
                        "province": "",
                        "country": "Italy",
                        "lastUpdate": "2020-03-20T17:43:03",
                        "confirmed": 47021,
                        "deaths": 4032,
                        "recovered": 4440
                    },
                    {
                        "province": "",
                        "country": "Spain",
                        "lastUpdate": "2020-03-20T17:43:03",
                        "confirmed": 20410,
                        "deaths": 1043,
                        "recovered": 1588
                    },
                    {
                        "province": "",
                        "country": "Germany",
                        "lastUpdate": "2020-03-20T20:13:15",
                        "confirmed": 19848,
                        "deaths": 67,
                        "recovered": 180
                    },
                    {
                        "province": "",
                        "country": "Iran",
                        "lastUpdate": "2020-03-20T15:13:21",
                        "confirmed": 19644,
                        "deaths": 1433,
                        "recovered": 6745
                    },
                    {
                        "province": "France",
                        "country": "France",
                        "lastUpdate": "2020-03-20T22:43:03",
                        "confirmed": 12612,
                        "deaths": 450,
                        "recovered": 12
                    },
                    {
                        "province": "",
                        "country": "Korea, South",
                        "lastUpdate": "2020-03-20T02:13:46",
                        "confirmed": 8652,
                        "deaths": 94,
                        "recovered": 1540
                    },
                    {
                        "province": "New York",
                        "country": "US",
                        "lastUpdate": "2020-03-20T22:14:43",
                        "confirmed": 8310,
                        "deaths": 42,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Switzerland",
                        "lastUpdate": "2020-03-20T18:13:09",
                        "confirmed": 5294,
                        "deaths": 54,
                        "recovered": 15
                    },
                    {
                        "province": "United Kingdom",
                        "country": "United Kingdom",
                        "lastUpdate": "2020-03-20T20:13:18",
                        "confirmed": 3983,
                        "deaths": 177,
                        "recovered": 65
                    },
                    {
                        "province": "Netherlands",
                        "country": "Netherlands",
                        "lastUpdate": "2020-03-20T18:13:12",
                        "confirmed": 2994,
                        "deaths": 106,
                        "recovered": 2
                    },
                    {
                        "province": "",
                        "country": "Austria",
                        "lastUpdate": "2020-03-20T15:43:24",
                        "confirmed": 2388,
                        "deaths": 6,
                        "recovered": 9
                    },
                    {
                        "province": "",
                        "country": "Belgium",
                        "lastUpdate": "2020-03-20T14:43:04",
                        "confirmed": 2257,
                        "deaths": 37,
                        "recovered": 1
                    },
                    {
                        "province": "",
                        "country": "Norway",
                        "lastUpdate": "2020-03-20T18:13:09",
                        "confirmed": 1914,
                        "deaths": 7,
                        "recovered": 1
                    },
                    {
                        "province": "",
                        "country": "Sweden",
                        "lastUpdate": "2020-03-20T15:43:24",
                        "confirmed": 1639,
                        "deaths": 16,
                        "recovered": 16
                    },
                    {
                        "province": "Washington",
                        "country": "US",
                        "lastUpdate": "2020-03-20T23:43:03",
                        "confirmed": 1524,
                        "deaths": 83,
                        "recovered": 0
                    },
                    {
                        "province": "Guangdong",
                        "country": "China",
                        "lastUpdate": "2020-03-20T09:13:30",
                        "confirmed": 1395,
                        "deaths": 8,
                        "recovered": 1323
                    },
                    {
                        "province": "Henan",
                        "country": "China",
                        "lastUpdate": "2020-03-14T09:53:08",
                        "confirmed": 1273,
                        "deaths": 22,
                        "recovered": 1250
                    },
                    {
                        "province": "Denmark",
                        "country": "Denmark",
                        "lastUpdate": "2020-03-20T18:13:12",
                        "confirmed": 1255,
                        "deaths": 9,
                        "recovered": 1
                    },
                    {
                        "province": "Zhejiang",
                        "country": "China",
                        "lastUpdate": "2020-03-20T02:43:09",
                        "confirmed": 1234,
                        "deaths": 1,
                        "recovered": 1219
                    },
                    {
                        "province": "California",
                        "country": "US",
                        "lastUpdate": "2020-03-20T23:43:03",
                        "confirmed": 1177,
                        "deaths": 23,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Malaysia",
                        "lastUpdate": "2020-03-20T18:13:09",
                        "confirmed": 1030,
                        "deaths": 3,
                        "recovered": 87
                    },
                    {
                        "province": "",
                        "country": "Portugal",
                        "lastUpdate": "2020-03-20T15:43:24",
                        "confirmed": 1020,
                        "deaths": 6,
                        "recovered": 5
                    },
                    {
                        "province": "Hunan",
                        "country": "China",
                        "lastUpdate": "2020-03-14T08:33:03",
                        "confirmed": 1018,
                        "deaths": 4,
                        "recovered": 1014
                    },
                    {
                        "province": "Anhui",
                        "country": "China",
                        "lastUpdate": "2020-03-11T02:18:14",
                        "confirmed": 990,
                        "deaths": 6,
                        "recovered": 984
                    },
                    {
                        "province": "",
                        "country": "Japan",
                        "lastUpdate": "2020-03-20T14:13:08",
                        "confirmed": 963,
                        "deaths": 33,
                        "recovered": 191
                    },
                    {
                        "province": "Jiangxi",
                        "country": "China",
                        "lastUpdate": "2020-03-12T02:13:04",
                        "confirmed": 935,
                        "deaths": 1,
                        "recovered": 934
                    },
                    {
                        "province": "New Jersey",
                        "country": "US",
                        "lastUpdate": "2020-03-20T21:13:32",
                        "confirmed": 890,
                        "deaths": 11,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Czechia",
                        "lastUpdate": "2020-03-20T20:13:15",
                        "confirmed": 833,
                        "deaths": 0,
                        "recovered": 4
                    },
                    {
                        "province": "",
                        "country": "Brazil",
                        "lastUpdate": "2020-03-20T20:13:16",
                        "confirmed": 793,
                        "deaths": 11,
                        "recovered": 2
                    },
                    {
                        "province": "Shandong",
                        "country": "China",
                        "lastUpdate": "2020-03-20T01:13:16",
                        "confirmed": 762,
                        "deaths": 7,
                        "recovered": 748
                    },
                    {
                        "province": "Diamond Princess",
                        "country": "Cruise Ship",
                        "lastUpdate": "2020-03-18T10:33:04",
                        "confirmed": 712,
                        "deaths": 7,
                        "recovered": 325
                    },
                    {
                        "province": "",
                        "country": "Israel",
                        "lastUpdate": "2020-03-20T14:43:04",
                        "confirmed": 705,
                        "deaths": 0,
                        "recovered": 14
                    },
                    {
                        "province": "",
                        "country": "Ireland",
                        "lastUpdate": "2020-03-20T20:13:16",
                        "confirmed": 683,
                        "deaths": 3,
                        "recovered": 5
                    },
                    {
                        "province": "Jiangsu",
                        "country": "China",
                        "lastUpdate": "2020-03-15T01:53:02",
                        "confirmed": 631,
                        "deaths": 0,
                        "recovered": 631
                    },
                    {
                        "province": "Illinois",
                        "country": "US",
                        "lastUpdate": "2020-03-20T21:13:32",
                        "confirmed": 585,
                        "deaths": 5,
                        "recovered": 0
                    },
                    {
                        "province": "Chongqing",
                        "country": "China",
                        "lastUpdate": "2020-03-15T03:53:04",
                        "confirmed": 576,
                        "deaths": 6,
                        "recovered": 570
                    },
                    {
                        "province": "Florida",
                        "country": "US",
                        "lastUpdate": "2020-03-20T23:43:03",
                        "confirmed": 563,
                        "deaths": 10,
                        "recovered": 0
                    },
                    {
                        "province": "Michigan",
                        "country": "US",
                        "lastUpdate": "2020-03-20T21:13:32",
                        "confirmed": 552,
                        "deaths": 3,
                        "recovered": 0
                    },
                    {
                        "province": "Sichuan",
                        "country": "China",
                        "lastUpdate": "2020-03-20T01:43:03",
                        "confirmed": 541,
                        "deaths": 3,
                        "recovered": 536
                    },
                    {
                        "province": "Louisiana",
                        "country": "US",
                        "lastUpdate": "2020-03-20T23:43:03",
                        "confirmed": 538,
                        "deaths": 14,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Pakistan",
                        "lastUpdate": "2020-03-20T20:13:16",
                        "confirmed": 501,
                        "deaths": 3,
                        "recovered": 13
                    },
                    {
                        "province": "",
                        "country": "Greece",
                        "lastUpdate": "2020-03-20T16:13:10",
                        "confirmed": 495,
                        "deaths": 6,
                        "recovered": 19
                    },
                    {
                        "province": "Beijing",
                        "country": "China",
                        "lastUpdate": "2020-03-20T06:43:05",
                        "confirmed": 491,
                        "deaths": 8,
                        "recovered": 390
                    },
                    {
                        "province": "Heilongjiang",
                        "country": "China",
                        "lastUpdate": "2020-03-20T02:13:46",
                        "confirmed": 484,
                        "deaths": 13,
                        "recovered": 463
                    },
                    {
                        "province": "",
                        "country": "Luxembourg",
                        "lastUpdate": "2020-03-20T14:43:04",
                        "confirmed": 484,
                        "deaths": 4,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Qatar",
                        "lastUpdate": "2020-03-20T20:13:16",
                        "confirmed": 470,
                        "deaths": 0,
                        "recovered": 10
                    },
                    {
                        "province": "",
                        "country": "Finland",
                        "lastUpdate": "2020-03-20T15:43:24",
                        "confirmed": 450,
                        "deaths": 0,
                        "recovered": 10
                    },
                    {
                        "province": "",
                        "country": "Chile",
                        "lastUpdate": "2020-03-20T20:13:17",
                        "confirmed": 434,
                        "deaths": 0,
                        "recovered": 6
                    },
                    {
                        "province": "",
                        "country": "Poland",
                        "lastUpdate": "2020-03-20T20:13:17",
                        "confirmed": 425,
                        "deaths": 5,
                        "recovered": 1
                    },
                    {
                        "province": "Georgia",
                        "country": "US",
                        "lastUpdate": "2020-03-20T19:13:30",
                        "confirmed": 420,
                        "deaths": 13,
                        "recovered": 0
                    },
                    {
                        "province": "Massachusetts",
                        "country": "US",
                        "lastUpdate": "2020-03-20T23:43:03",
                        "confirmed": 413,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Iceland",
                        "lastUpdate": "2020-03-20T15:13:21",
                        "confirmed": 409,
                        "deaths": 0,
                        "recovered": 5
                    },
                    {
                        "province": "Texas",
                        "country": "US",
                        "lastUpdate": "2020-03-20T23:43:03",
                        "confirmed": 394,
                        "deaths": 5,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Singapore",
                        "lastUpdate": "2020-03-20T15:43:24",
                        "confirmed": 385,
                        "deaths": 0,
                        "recovered": 124
                    },
                    {
                        "province": "Shanghai",
                        "country": "China",
                        "lastUpdate": "2020-03-20T00:43:02",
                        "confirmed": 371,
                        "deaths": 3,
                        "recovered": 326
                    },
                    {
                        "province": "",
                        "country": "Indonesia",
                        "lastUpdate": "2020-03-20T14:43:04",
                        "confirmed": 369,
                        "deaths": 32,
                        "recovered": 15
                    },
                    {
                        "province": "",
                        "country": "Ecuador",
                        "lastUpdate": "2020-03-20T20:43:02",
                        "confirmed": 367,
                        "deaths": 5,
                        "recovered": 0
                    },
                    {
                        "province": "Colorado",
                        "country": "US",
                        "lastUpdate": "2020-03-20T23:43:03",
                        "confirmed": 363,
                        "deaths": 4,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Turkey",
                        "lastUpdate": "2020-03-20T01:43:03",
                        "confirmed": 359,
                        "deaths": 4,
                        "recovered": 0
                    },
                    {
                        "province": "New South Wales",
                        "country": "Australia",
                        "lastUpdate": "2020-03-20T21:13:30",
                        "confirmed": 353,
                        "deaths": 6,
                        "recovered": 4
                    },
                    {
                        "province": "",
                        "country": "Saudi Arabia",
                        "lastUpdate": "2020-03-20T20:43:02",
                        "confirmed": 344,
                        "deaths": 0,
                        "recovered": 8
                    },
                    {
                        "province": "",
                        "country": "Slovenia",
                        "lastUpdate": "2020-03-20T15:43:24",
                        "confirmed": 341,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Thailand",
                        "lastUpdate": "2020-03-20T14:13:08",
                        "confirmed": 322,
                        "deaths": 1,
                        "recovered": 42
                    },
                    {
                        "province": "Hebei",
                        "country": "China",
                        "lastUpdate": "2020-03-13T11:09:03",
                        "confirmed": 318,
                        "deaths": 6,
                        "recovered": 310
                    },
                    {
                        "province": "Ontario",
                        "country": "Canada",
                        "lastUpdate": "2020-03-20T16:13:25",
                        "confirmed": 308,
                        "deaths": 2,
                        "recovered": 5
                    },
                    {
                        "province": "",
                        "country": "Romania",
                        "lastUpdate": "2020-03-20T15:13:21",
                        "confirmed": 308,
                        "deaths": 0,
                        "recovered": 25
                    },
                    {
                        "province": "Pennsylvania",
                        "country": "US",
                        "lastUpdate": "2020-03-20T23:43:03",
                        "confirmed": 303,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "Fujian",
                        "country": "China",
                        "lastUpdate": "2020-03-20T02:43:09",
                        "confirmed": 299,
                        "deaths": 1,
                        "recovered": 295
                    },
                    {
                        "province": "",
                        "country": "Bahrain",
                        "lastUpdate": "2020-03-20T14:43:04",
                        "confirmed": 285,
                        "deaths": 1,
                        "recovered": 100
                    },
                    {
                        "province": "",
                        "country": "Egypt",
                        "lastUpdate": "2020-03-20T20:43:02",
                        "confirmed": 285,
                        "deaths": 8,
                        "recovered": 39
                    },
                    {
                        "province": "",
                        "country": "Estonia",
                        "lastUpdate": "2020-03-20T14:43:04",
                        "confirmed": 283,
                        "deaths": 0,
                        "recovered": 1
                    },
                    {
                        "province": "British Columbia",
                        "country": "Canada",
                        "lastUpdate": "2020-03-20T03:13:18",
                        "confirmed": 271,
                        "deaths": 8,
                        "recovered": 4
                    },
                    {
                        "province": "Hong Kong",
                        "country": "China",
                        "lastUpdate": "2020-03-20T09:43:03",
                        "confirmed": 256,
                        "deaths": 4,
                        "recovered": 98
                    },
                    {
                        "province": "Guangxi",
                        "country": "China",
                        "lastUpdate": "2020-03-20T00:43:02",
                        "confirmed": 254,
                        "deaths": 2,
                        "recovered": 250
                    },
                    {
                        "province": "",
                        "country": "Russia",
                        "lastUpdate": "2020-03-20T15:43:24",
                        "confirmed": 253,
                        "deaths": 1,
                        "recovered": 9
                    },
                    {
                        "province": "Shaanxi",
                        "country": "China",
                        "lastUpdate": "2020-03-20T01:13:16",
                        "confirmed": 247,
                        "deaths": 3,
                        "recovered": 237
                    },
                    {
                        "province": "",
                        "country": "India",
                        "lastUpdate": "2020-03-20T15:13:21",
                        "confirmed": 244,
                        "deaths": 5,
                        "recovered": 20
                    },
                    {
                        "province": "",
                        "country": "Peru",
                        "lastUpdate": "2020-03-20T14:13:08",
                        "confirmed": 234,
                        "deaths": 3,
                        "recovered": 1
                    },
                    {
                        "province": "Tennessee",
                        "country": "US",
                        "lastUpdate": "2020-03-20T23:43:03",
                        "confirmed": 233,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Philippines",
                        "lastUpdate": "2020-03-20T14:43:04",
                        "confirmed": 230,
                        "deaths": 18,
                        "recovered": 8
                    },
                    {
                        "province": "",
                        "country": "Iraq",
                        "lastUpdate": "2020-03-20T20:43:02",
                        "confirmed": 208,
                        "deaths": 17,
                        "recovered": 49
                    },
                    {
                        "province": "Wisconsin",
                        "country": "US",
                        "lastUpdate": "2020-03-20T21:13:29",
                        "confirmed": 207,
                        "deaths": 3,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "South Africa",
                        "lastUpdate": "2020-03-20T14:43:04",
                        "confirmed": 202,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Connecticut",
                        "country": "US",
                        "lastUpdate": "2020-03-20T21:13:29",
                        "confirmed": 194,
                        "deaths": 3,
                        "recovered": 0
                    },
                    {
                        "province": "Queensland",
                        "country": "Australia",
                        "lastUpdate": "2020-03-20T21:13:30",
                        "confirmed": 184,
                        "deaths": 0,
                        "recovered": 8
                    },
                    {
                        "province": "Yunnan",
                        "country": "China",
                        "lastUpdate": "2020-03-16T23:53:02",
                        "confirmed": 176,
                        "deaths": 2,
                        "recovered": 172
                    },
                    {
                        "province": "Ohio",
                        "country": "US",
                        "lastUpdate": "2020-03-20T23:43:03",
                        "confirmed": 173,
                        "deaths": 2,
                        "recovered": 0
                    },
                    {
                        "province": "North Carolina",
                        "country": "US",
                        "lastUpdate": "2020-03-20T23:43:03",
                        "confirmed": 172,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Hainan",
                        "country": "China",
                        "lastUpdate": "2020-03-16T14:38:45",
                        "confirmed": 168,
                        "deaths": 6,
                        "recovered": 161
                    },
                    {
                        "province": "",
                        "country": "Mexico",
                        "lastUpdate": "2020-03-20T14:13:08",
                        "confirmed": 164,
                        "deaths": 1,
                        "recovered": 4
                    },
                    {
                        "province": "",
                        "country": "Lebanon",
                        "lastUpdate": "2020-03-20T14:43:04",
                        "confirmed": 163,
                        "deaths": 4,
                        "recovered": 4
                    },
                    {
                        "province": "",
                        "country": "Kuwait",
                        "lastUpdate": "2020-03-20T14:43:04",
                        "confirmed": 159,
                        "deaths": 0,
                        "recovered": 18
                    },
                    {
                        "province": "Maryland",
                        "country": "US",
                        "lastUpdate": "2020-03-20T16:43:10",
                        "confirmed": 149,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "Alberta",
                        "country": "Canada",
                        "lastUpdate": "2020-03-20T03:13:18",
                        "confirmed": 146,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "Guizhou",
                        "country": "China",
                        "lastUpdate": "2020-03-18T01:53:03",
                        "confirmed": 146,
                        "deaths": 2,
                        "recovered": 144
                    },
                    {
                        "province": "",
                        "country": "San Marino",
                        "lastUpdate": "2020-03-20T01:43:03",
                        "confirmed": 144,
                        "deaths": 14,
                        "recovered": 4
                    },
                    {
                        "province": "",
                        "country": "United Arab Emirates",
                        "lastUpdate": "2020-03-20T23:13:09",
                        "confirmed": 140,
                        "deaths": 2,
                        "recovered": 31
                    },
                    {
                        "province": "Quebec",
                        "country": "Canada",
                        "lastUpdate": "2020-03-20T21:13:29",
                        "confirmed": 139,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "Tianjin",
                        "country": "China",
                        "lastUpdate": "2020-03-19T23:43:03",
                        "confirmed": 137,
                        "deaths": 3,
                        "recovered": 133
                    },
                    {
                        "province": "",
                        "country": "Panama",
                        "lastUpdate": "2020-03-20T02:13:50",
                        "confirmed": 137,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Slovakia",
                        "lastUpdate": "2020-03-20T16:13:11",
                        "confirmed": 137,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Armenia",
                        "lastUpdate": "2020-03-20T14:43:04",
                        "confirmed": 136,
                        "deaths": 0,
                        "recovered": 1
                    },
                    {
                        "province": "",
                        "country": "Serbia",
                        "lastUpdate": "2020-03-20T20:43:02",
                        "confirmed": 135,
                        "deaths": 1,
                        "recovered": 1
                    },
                    {
                        "province": "",
                        "country": "Taiwan*",
                        "lastUpdate": "2020-03-20T09:43:03",
                        "confirmed": 135,
                        "deaths": 2,
                        "recovered": 26
                    },
                    {
                        "province": "Gansu",
                        "country": "China",
                        "lastUpdate": "2020-03-20T00:13:24",
                        "confirmed": 134,
                        "deaths": 2,
                        "recovered": 98
                    },
                    {
                        "province": "Shanxi",
                        "country": "China",
                        "lastUpdate": "2020-03-13T11:09:03",
                        "confirmed": 133,
                        "deaths": 0,
                        "recovered": 133
                    },
                    {
                        "province": "",
                        "country": "Argentina",
                        "lastUpdate": "2020-03-20T02:43:10",
                        "confirmed": 128,
                        "deaths": 3,
                        "recovered": 3
                    },
                    {
                        "province": "",
                        "country": "Colombia",
                        "lastUpdate": "2020-03-20T14:13:08",
                        "confirmed": 128,
                        "deaths": 0,
                        "recovered": 1
                    },
                    {
                        "province": "",
                        "country": "Croatia",
                        "lastUpdate": "2020-03-20T20:43:02",
                        "confirmed": 128,
                        "deaths": 1,
                        "recovered": 5
                    },
                    {
                        "province": "",
                        "country": "Bulgaria",
                        "lastUpdate": "2020-03-20T16:13:11",
                        "confirmed": 127,
                        "deaths": 3,
                        "recovered": 0
                    },
                    {
                        "province": "Liaoning",
                        "country": "China",
                        "lastUpdate": "2020-03-20T01:43:03",
                        "confirmed": 126,
                        "deaths": 2,
                        "recovered": 122
                    },
                    {
                        "province": "South Carolina",
                        "country": "US",
                        "lastUpdate": "2020-03-20T23:43:03",
                        "confirmed": 126,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "Virginia",
                        "country": "US",
                        "lastUpdate": "2020-03-20T23:43:03",
                        "confirmed": 122,
                        "deaths": 2,
                        "recovered": 0
                    },
                    {
                        "province": "Victoria",
                        "country": "Australia",
                        "lastUpdate": "2020-03-18T12:13:09",
                        "confirmed": 121,
                        "deaths": 0,
                        "recovered": 8
                    },
                    {
                        "province": "Minnesota",
                        "country": "US",
                        "lastUpdate": "2020-03-20T19:13:30",
                        "confirmed": 115,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Nevada",
                        "country": "US",
                        "lastUpdate": "2020-03-20T23:43:03",
                        "confirmed": 114,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "Oregon",
                        "country": "US",
                        "lastUpdate": "2020-03-20T21:43:03",
                        "confirmed": 114,
                        "deaths": 3,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Latvia",
                        "lastUpdate": "2020-03-20T14:43:04",
                        "confirmed": 111,
                        "deaths": 0,
                        "recovered": 1
                    },
                    {
                        "province": "Arkansas",
                        "country": "US",
                        "lastUpdate": "2020-03-20T21:43:03",
                        "confirmed": 96,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Uruguay",
                        "lastUpdate": "2020-03-20T01:43:03",
                        "confirmed": 94,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Jilin",
                        "country": "China",
                        "lastUpdate": "2020-03-16T00:22:10",
                        "confirmed": 93,
                        "deaths": 1,
                        "recovered": 92
                    },
                    {
                        "province": "",
                        "country": "Vietnam",
                        "lastUpdate": "2020-03-20T20:43:02",
                        "confirmed": 91,
                        "deaths": 0,
                        "recovered": 16
                    },
                    {
                        "province": "",
                        "country": "Algeria",
                        "lastUpdate": "2020-03-20T15:43:24",
                        "confirmed": 90,
                        "deaths": 11,
                        "recovered": 32
                    },
                    {
                        "province": "",
                        "country": "Bosnia and Herzegovina",
                        "lastUpdate": "2020-03-20T20:43:02",
                        "confirmed": 89,
                        "deaths": 0,
                        "recovered": 2
                    },
                    {
                        "province": "",
                        "country": "Costa Rica",
                        "lastUpdate": "2020-03-20T14:13:08",
                        "confirmed": 89,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "Indiana",
                        "country": "US",
                        "lastUpdate": "2020-03-20T21:43:03",
                        "confirmed": 86,
                        "deaths": 2,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Hungary",
                        "lastUpdate": "2020-03-20T14:43:04",
                        "confirmed": 85,
                        "deaths": 3,
                        "recovered": 2
                    },
                    {
                        "province": "",
                        "country": "Jordan",
                        "lastUpdate": "2020-03-20T20:43:02",
                        "confirmed": 85,
                        "deaths": 0,
                        "recovered": 1
                    },
                    {
                        "province": "Alabama",
                        "country": "US",
                        "lastUpdate": "2020-03-20T21:43:03",
                        "confirmed": 83,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Faroe Islands",
                        "country": "Denmark",
                        "lastUpdate": "2020-03-20T15:13:21",
                        "confirmed": 80,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Mississippi",
                        "country": "US",
                        "lastUpdate": "2020-03-20T16:43:10",
                        "confirmed": 80,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Brunei",
                        "lastUpdate": "2020-03-20T15:43:24",
                        "confirmed": 78,
                        "deaths": 0,
                        "recovered": 1
                    },
                    {
                        "province": "Arizona",
                        "country": "US",
                        "lastUpdate": "2020-03-20T19:13:30",
                        "confirmed": 78,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Utah",
                        "country": "US",
                        "lastUpdate": "2020-03-20T16:13:23",
                        "confirmed": 78,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Morocco",
                        "lastUpdate": "2020-03-20T20:43:02",
                        "confirmed": 77,
                        "deaths": 3,
                        "recovered": 1
                    },
                    {
                        "province": "Xinjiang",
                        "country": "China",
                        "lastUpdate": "2020-03-11T02:18:14",
                        "confirmed": 76,
                        "deaths": 3,
                        "recovered": 73
                    },
                    {
                        "province": "",
                        "country": "Andorra",
                        "lastUpdate": "2020-03-20T15:13:21",
                        "confirmed": 75,
                        "deaths": 0,
                        "recovered": 1
                    },
                    {
                        "province": "Inner Mongolia",
                        "country": "China",
                        "lastUpdate": "2020-03-19T01:03:02",
                        "confirmed": 75,
                        "deaths": 1,
                        "recovered": 74
                    },
                    {
                        "province": "Ningxia",
                        "country": "China",
                        "lastUpdate": "2020-03-16T14:38:45",
                        "confirmed": 75,
                        "deaths": 0,
                        "recovered": 75
                    },
                    {
                        "province": "",
                        "country": "Sri Lanka",
                        "lastUpdate": "2020-03-20T16:13:11",
                        "confirmed": 73,
                        "deaths": 0,
                        "recovered": 3
                    },
                    {
                        "province": "",
                        "country": "Dominican Republic",
                        "lastUpdate": "2020-03-20T20:43:03",
                        "confirmed": 72,
                        "deaths": 2,
                        "recovered": 0
                    },
                    {
                        "province": "District of Columbia",
                        "country": "US",
                        "lastUpdate": "2020-03-20T19:13:30",
                        "confirmed": 71,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Albania",
                        "lastUpdate": "2020-03-20T15:13:21",
                        "confirmed": 70,
                        "deaths": 2,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Belarus",
                        "lastUpdate": "2020-03-20T14:43:04",
                        "confirmed": 69,
                        "deaths": 0,
                        "recovered": 5
                    },
                    {
                        "province": "",
                        "country": "Cyprus",
                        "lastUpdate": "2020-03-19T18:13:29",
                        "confirmed": 67,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "North Macedonia",
                        "lastUpdate": "2020-03-20T14:43:04",
                        "confirmed": 67,
                        "deaths": 0,
                        "recovered": 1
                    },
                    {
                        "province": "",
                        "country": "Moldova",
                        "lastUpdate": "2020-03-20T16:13:11",
                        "confirmed": 66,
                        "deaths": 1,
                        "recovered": 1
                    },
                    {
                        "province": "Western Australia",
                        "country": "Australia",
                        "lastUpdate": "2020-03-20T21:13:30",
                        "confirmed": 64,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Malta",
                        "lastUpdate": "2020-03-20T15:13:21",
                        "confirmed": 64,
                        "deaths": 0,
                        "recovered": 2
                    },
                    {
                        "province": "Maine",
                        "country": "US",
                        "lastUpdate": "2020-03-20T19:13:30",
                        "confirmed": 56,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Tunisia",
                        "lastUpdate": "2020-03-20T15:13:21",
                        "confirmed": 54,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "Rhode Island",
                        "country": "US",
                        "lastUpdate": "2020-03-20T19:43:03",
                        "confirmed": 54,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Missouri",
                        "country": "US",
                        "lastUpdate": "2020-03-20T21:43:03",
                        "confirmed": 53,
                        "deaths": 2,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Cambodia",
                        "lastUpdate": "2020-03-20T15:43:24",
                        "confirmed": 51,
                        "deaths": 0,
                        "recovered": 1
                    },
                    {
                        "province": "South Australia",
                        "country": "Australia",
                        "lastUpdate": "2020-03-20T21:13:30",
                        "confirmed": 50,
                        "deaths": 0,
                        "recovered": 3
                    },
                    {
                        "province": "",
                        "country": "Kazakhstan",
                        "lastUpdate": "2020-03-20T14:13:08",
                        "confirmed": 49,
                        "deaths": 3,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Lithuania",
                        "lastUpdate": "2020-03-20T15:43:24",
                        "confirmed": 49,
                        "deaths": 0,
                        "recovered": 1
                    },
                    {
                        "province": "Diamond Princess",
                        "country": "US",
                        "lastUpdate": "2020-03-20T19:43:03",
                        "confirmed": 49,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Oklahoma",
                        "country": "US",
                        "lastUpdate": "2020-03-20T19:43:03",
                        "confirmed": 49,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Oman",
                        "lastUpdate": "2020-03-19T20:13:34",
                        "confirmed": 48,
                        "deaths": 0,
                        "recovered": 12
                    },
                    {
                        "province": "Kentucky",
                        "country": "US",
                        "lastUpdate": "2020-03-20T16:13:22",
                        "confirmed": 47,
                        "deaths": 2,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Guadeloupe",
                        "lastUpdate": "2020-03-20T10:13:38",
                        "confirmed": 45,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Iowa",
                        "country": "US",
                        "lastUpdate": "2020-03-20T19:43:03",
                        "confirmed": 45,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Azerbaijan",
                        "lastUpdate": "2020-03-19T16:13:36",
                        "confirmed": 44,
                        "deaths": 1,
                        "recovered": 6
                    },
                    {
                        "province": "Kansas",
                        "country": "US",
                        "lastUpdate": "2020-03-20T21:43:03",
                        "confirmed": 44,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "New Hampshire",
                        "country": "US",
                        "lastUpdate": "2020-03-19T23:43:04",
                        "confirmed": 44,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Georgia",
                        "lastUpdate": "2020-03-20T14:43:04",
                        "confirmed": 43,
                        "deaths": 0,
                        "recovered": 1
                    },
                    {
                        "province": "New Mexico",
                        "country": "US",
                        "lastUpdate": "2020-03-20T21:43:03",
                        "confirmed": 43,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Venezuela",
                        "lastUpdate": "2020-03-19T20:13:34",
                        "confirmed": 42,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Burkina Faso",
                        "lastUpdate": "2020-03-20T15:13:21",
                        "confirmed": 40,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "New Zealand",
                        "lastUpdate": "2020-03-20T02:13:50",
                        "confirmed": 39,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Senegal",
                        "lastUpdate": "2020-03-20T15:43:24",
                        "confirmed": 38,
                        "deaths": 0,
                        "recovered": 2
                    },
                    {
                        "province": "Delaware",
                        "country": "US",
                        "lastUpdate": "2020-03-20T19:43:03",
                        "confirmed": 38,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Nebraska",
                        "country": "US",
                        "lastUpdate": "2020-03-20T21:43:03",
                        "confirmed": 37,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Uzbekistan",
                        "lastUpdate": "2020-03-20T14:43:04",
                        "confirmed": 33,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Martinique",
                        "lastUpdate": "2020-03-20T10:13:37",
                        "confirmed": 32,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "Vermont",
                        "country": "US",
                        "lastUpdate": "2020-03-20T21:43:03",
                        "confirmed": 29,
                        "deaths": 2,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Ukraine",
                        "lastUpdate": "2020-03-20T20:43:03",
                        "confirmed": 29,
                        "deaths": 3,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Liechtenstein",
                        "lastUpdate": "2020-03-18T19:14:33",
                        "confirmed": 28,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Reunion",
                        "lastUpdate": "2020-03-20T02:13:59",
                        "confirmed": 28,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Hawaii",
                        "country": "US",
                        "lastUpdate": "2020-03-20T02:43:10",
                        "confirmed": 26,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Afghanistan",
                        "lastUpdate": "2020-03-20T14:43:04",
                        "confirmed": 24,
                        "deaths": 0,
                        "recovered": 1
                    },
                    {
                        "province": "",
                        "country": "Honduras",
                        "lastUpdate": "2020-03-20T14:13:08",
                        "confirmed": 24,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Grand Princess",
                        "country": "US",
                        "lastUpdate": "2020-03-20T19:43:03",
                        "confirmed": 23,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Idaho",
                        "country": "US",
                        "lastUpdate": "2020-03-20T02:43:10",
                        "confirmed": 23,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Bangladesh",
                        "lastUpdate": "2020-03-20T15:13:21",
                        "confirmed": 20,
                        "deaths": 1,
                        "recovered": 3
                    },
                    {
                        "province": "",
                        "country": "Cameroon",
                        "lastUpdate": "2020-03-20T14:43:04",
                        "confirmed": 20,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Saskatchewan",
                        "country": "Canada",
                        "lastUpdate": "2020-03-20T03:13:18",
                        "confirmed": 20,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "North Dakota",
                        "country": "US",
                        "lastUpdate": "2020-03-20T02:43:10",
                        "confirmed": 19,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Wyoming",
                        "country": "US",
                        "lastUpdate": "2020-03-20T22:14:43",
                        "confirmed": 19,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Qinghai",
                        "country": "China",
                        "lastUpdate": "2020-03-11T02:18:14",
                        "confirmed": 18,
                        "deaths": 0,
                        "recovered": 18
                    },
                    {
                        "province": "",
                        "country": "Congo (Kinshasa)",
                        "lastUpdate": "2020-03-20T14:43:04",
                        "confirmed": 18,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Manitoba",
                        "country": "Canada",
                        "lastUpdate": "2020-03-19T03:13:26",
                        "confirmed": 17,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Macau",
                        "country": "China",
                        "lastUpdate": "2020-03-19T01:02:56",
                        "confirmed": 17,
                        "deaths": 0,
                        "recovered": 10
                    },
                    {
                        "province": "",
                        "country": "Rwanda",
                        "lastUpdate": "2020-03-20T20:43:03",
                        "confirmed": 17,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Cuba",
                        "lastUpdate": "2020-03-20T02:43:10",
                        "confirmed": 16,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Ghana",
                        "lastUpdate": "2020-03-20T15:43:24",
                        "confirmed": 16,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Jamaica",
                        "lastUpdate": "2020-03-20T14:13:11",
                        "confirmed": 16,
                        "deaths": 1,
                        "recovered": 2
                    },
                    {
                        "province": "",
                        "country": "Bolivia",
                        "lastUpdate": "2020-03-20T02:43:10",
                        "confirmed": 15,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Nova Scotia",
                        "country": "Canada",
                        "lastUpdate": "2020-03-20T21:13:29",
                        "confirmed": 15,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "French Guiana",
                        "lastUpdate": "2020-03-20T10:13:39",
                        "confirmed": 15,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Montana",
                        "country": "US",
                        "lastUpdate": "2020-03-20T16:43:10",
                        "confirmed": 15,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Montenegro",
                        "lastUpdate": "2020-03-20T20:43:03",
                        "confirmed": 14,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Guam",
                        "country": "US",
                        "lastUpdate": "2020-03-20T16:43:10",
                        "confirmed": 14,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Puerto Rico",
                        "country": "US",
                        "lastUpdate": "2020-03-20T22:13:55",
                        "confirmed": 14,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "South Dakota",
                        "country": "US",
                        "lastUpdate": "2020-03-20T02:43:10",
                        "confirmed": 14,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "Channel Islands",
                        "country": "United Kingdom",
                        "lastUpdate": "2020-03-20T20:43:03",
                        "confirmed": 14,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Maldives",
                        "lastUpdate": "2020-03-15T18:20:18",
                        "confirmed": 13,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Paraguay",
                        "lastUpdate": "2020-03-20T02:13:50",
                        "confirmed": 13,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Guatemala",
                        "lastUpdate": "2020-03-20T16:13:19",
                        "confirmed": 12,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Mauritius",
                        "lastUpdate": "2020-03-20T15:13:21",
                        "confirmed": 12,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Nigeria",
                        "lastUpdate": "2020-03-20T02:13:50",
                        "confirmed": 12,
                        "deaths": 0,
                        "recovered": 1
                    },
                    {
                        "province": "Alaska",
                        "country": "US",
                        "lastUpdate": "2020-03-20T16:43:10",
                        "confirmed": 12,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "New Brunswick",
                        "country": "Canada",
                        "lastUpdate": "2020-03-18T18:33:03",
                        "confirmed": 11,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "French Polynesia",
                        "country": "France",
                        "lastUpdate": "2020-03-20T10:13:37",
                        "confirmed": 11,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Monaco",
                        "lastUpdate": "2020-03-20T14:43:04",
                        "confirmed": 11,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Tasmania",
                        "country": "Australia",
                        "lastUpdate": "2020-03-19T11:13:54",
                        "confirmed": 10,
                        "deaths": 0,
                        "recovered": 3
                    },
                    {
                        "province": "Grand Princess",
                        "country": "Canada",
                        "lastUpdate": "2020-03-20T03:13:18",
                        "confirmed": 10,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Gibraltar",
                        "country": "United Kingdom",
                        "lastUpdate": "2020-03-19T20:13:52",
                        "confirmed": 10,
                        "deaths": 0,
                        "recovered": 2
                    },
                    {
                        "province": "",
                        "country": "Cote d'Ivoire",
                        "lastUpdate": "2020-03-19T01:03:46",
                        "confirmed": 9,
                        "deaths": 0,
                        "recovered": 1
                    },
                    {
                        "province": "",
                        "country": "Ethiopia",
                        "lastUpdate": "2020-03-20T14:13:11",
                        "confirmed": 9,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Togo",
                        "lastUpdate": "2020-03-20T14:43:04",
                        "confirmed": 9,
                        "deaths": 0,
                        "recovered": 1
                    },
                    {
                        "province": "",
                        "country": "Trinidad and Tobago",
                        "lastUpdate": "2020-03-19T10:53:03",
                        "confirmed": 9,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Guyana",
                        "lastUpdate": "2020-03-17T10:53:03",
                        "confirmed": 7,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Kenya",
                        "lastUpdate": "2020-03-19T02:33:08",
                        "confirmed": 7,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Seychelles",
                        "lastUpdate": "2020-03-20T15:43:24",
                        "confirmed": 7,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "West Virginia",
                        "country": "US",
                        "lastUpdate": "2020-03-20T19:43:03",
                        "confirmed": 7,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Australian Capital Territory",
                        "country": "Australia",
                        "lastUpdate": "2020-03-20T21:13:30",
                        "confirmed": 6,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Equatorial Guinea",
                        "lastUpdate": "2020-03-19T20:43:03",
                        "confirmed": 6,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Kyrgyzstan",
                        "lastUpdate": "2020-03-20T14:13:36",
                        "confirmed": 6,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Mayotte",
                        "lastUpdate": "2020-03-20T10:13:38",
                        "confirmed": 6,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Mongolia",
                        "lastUpdate": "2020-03-18T11:53:04",
                        "confirmed": 6,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Tanzania",
                        "lastUpdate": "2020-03-19T11:33:36",
                        "confirmed": 6,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Barbados",
                        "lastUpdate": "2020-03-19T20:43:03",
                        "confirmed": 5,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Aruba",
                        "country": "Netherlands",
                        "lastUpdate": "2020-03-20T02:43:10",
                        "confirmed": 5,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Newfoundland and Labrador",
                        "country": "Canada",
                        "lastUpdate": "2020-03-20T21:13:29",
                        "confirmed": 4,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "St Martin",
                        "country": "France",
                        "lastUpdate": "2020-03-19T09:33:04",
                        "confirmed": 4,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Suriname",
                        "lastUpdate": "2020-03-20T14:43:04",
                        "confirmed": 4,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Northern Territory",
                        "country": "Australia",
                        "lastUpdate": "2020-03-20T21:13:29",
                        "confirmed": 3,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Bahamas, The",
                        "lastUpdate": "2020-03-19T11:33:39",
                        "confirmed": 3,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Central African Republic",
                        "lastUpdate": "2020-03-20T20:43:03",
                        "confirmed": 3,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Congo (Brazzaville)",
                        "lastUpdate": "2020-03-19T20:13:56",
                        "confirmed": 3,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Saint Barthelemy",
                        "country": "France",
                        "lastUpdate": "2020-03-16T14:38:45",
                        "confirmed": 3,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Gabon",
                        "lastUpdate": "2020-03-20T15:13:21",
                        "confirmed": 3,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Madagascar",
                        "lastUpdate": "2020-03-20T22:13:53",
                        "confirmed": 3,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Namibia",
                        "lastUpdate": "2020-03-19T20:13:52",
                        "confirmed": 3,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Curacao",
                        "country": "Netherlands",
                        "lastUpdate": "2020-03-19T08:53:03",
                        "confirmed": 3,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "United States Virgin Islands",
                        "country": "US",
                        "lastUpdate": "2020-03-20T00:43:02",
                        "confirmed": 3,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Cayman Islands",
                        "country": "United Kingdom",
                        "lastUpdate": "2020-03-19T20:13:56",
                        "confirmed": 3,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Benin",
                        "lastUpdate": "2020-03-18T14:13:56",
                        "confirmed": 2,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Bhutan",
                        "lastUpdate": "2020-03-20T14:13:37",
                        "confirmed": 2,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Prince Edward Island",
                        "country": "Canada",
                        "lastUpdate": "2020-03-19T18:43:03",
                        "confirmed": 2,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Greenland",
                        "country": "Denmark",
                        "lastUpdate": "2020-03-19T08:13:19",
                        "confirmed": 2,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "New Caledonia",
                        "country": "France",
                        "lastUpdate": "2020-03-19T02:33:09",
                        "confirmed": 2,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Haiti",
                        "lastUpdate": "2020-03-20T10:13:39",
                        "confirmed": 2,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Kosovo",
                        "lastUpdate": "2020-03-15T18:20:19",
                        "confirmed": 2,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Liberia",
                        "lastUpdate": "2020-03-18T03:13:22",
                        "confirmed": 2,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Mauritania",
                        "lastUpdate": "2020-03-19T02:33:08",
                        "confirmed": 2,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Saint Lucia",
                        "lastUpdate": "2020-03-17T04:32:19",
                        "confirmed": 2,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Sudan",
                        "lastUpdate": "2020-03-18T12:13:09",
                        "confirmed": 2,
                        "deaths": 1,
                        "recovered": 0
                    },
                    {
                        "province": "Bermuda",
                        "country": "United Kingdom",
                        "lastUpdate": "2020-03-19T02:53:33",
                        "confirmed": 2,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Zambia",
                        "lastUpdate": "2020-03-19T01:53:06",
                        "confirmed": 2,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Angola",
                        "lastUpdate": "2020-03-20T10:13:38",
                        "confirmed": 1,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Antigua and Barbuda",
                        "lastUpdate": "2020-03-15T18:20:19",
                        "confirmed": 1,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Cabo Verde",
                        "lastUpdate": "2020-03-20T10:13:39",
                        "confirmed": 1,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Chad",
                        "lastUpdate": "2020-03-19T16:43:03",
                        "confirmed": 1,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Tibet",
                        "country": "China",
                        "lastUpdate": "2020-03-11T02:18:14",
                        "confirmed": 1,
                        "deaths": 0,
                        "recovered": 1
                    },
                    {
                        "province": "",
                        "country": "Djibouti",
                        "lastUpdate": "2020-03-19T14:53:06",
                        "confirmed": 1,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "El Salvador",
                        "lastUpdate": "2020-03-19T14:53:06",
                        "confirmed": 1,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Eswatini",
                        "lastUpdate": "2020-03-15T06:41:54",
                        "confirmed": 1,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Fiji",
                        "lastUpdate": "2020-03-19T14:53:06",
                        "confirmed": 1,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Gambia, The",
                        "lastUpdate": "2020-03-18T14:13:56",
                        "confirmed": 1,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Guinea",
                        "lastUpdate": "2020-03-15T06:41:54",
                        "confirmed": 1,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Holy See",
                        "lastUpdate": "2020-03-13T22:22:02",
                        "confirmed": 1,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Nepal",
                        "lastUpdate": "2020-03-13T22:22:03",
                        "confirmed": 1,
                        "deaths": 0,
                        "recovered": 1
                    },
                    {
                        "province": "Sint Maarten",
                        "country": "Netherlands",
                        "lastUpdate": "2020-03-20T21:13:30",
                        "confirmed": 1,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Nicaragua",
                        "lastUpdate": "2020-03-19T08:33:08",
                        "confirmed": 1,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Niger",
                        "lastUpdate": "2020-03-20T02:13:52",
                        "confirmed": 1,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Papua New Guinea",
                        "lastUpdate": "2020-03-20T18:13:12",
                        "confirmed": 1,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Saint Vincent and the Grenadines",
                        "lastUpdate": "2020-03-14T16:33:03",
                        "confirmed": 1,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Somalia",
                        "lastUpdate": "2020-03-18T00:53:03",
                        "confirmed": 1,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "US",
                        "country": "US",
                        "lastUpdate": "2020-03-20T22:43:03",
                        "confirmed": 1,
                        "deaths": 0,
                        "recovered": 147
                    },
                    {
                        "province": "Isle of Man",
                        "country": "United Kingdom",
                        "lastUpdate": "2020-03-20T15:13:21",
                        "confirmed": 1,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Montserrat",
                        "country": "United Kingdom",
                        "lastUpdate": "2020-03-18T11:53:04",
                        "confirmed": 1,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Zimbabwe",
                        "lastUpdate": "2020-03-20T22:13:55",
                        "confirmed": 1,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "From Diamond Princess",
                        "country": "Australia",
                        "lastUpdate": "2020-03-14T02:33:04",
                        "confirmed": 0,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "French Guiana",
                        "country": "France",
                        "lastUpdate": "2020-03-18T14:33:15",
                        "confirmed": 0,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Guadeloupe",
                        "country": "France",
                        "lastUpdate": "2020-03-18T14:33:15",
                        "confirmed": 0,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Mayotte",
                        "country": "France",
                        "lastUpdate": "2020-03-18T14:33:15",
                        "confirmed": 0,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "Reunion",
                        "country": "France",
                        "lastUpdate": "2020-03-18T14:33:15",
                        "confirmed": 0,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Greenland",
                        "lastUpdate": "2020-03-19T09:33:04",
                        "confirmed": 0,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Guam",
                        "lastUpdate": "2020-03-18T19:14:33",
                        "confirmed": 0,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Guernsey",
                        "lastUpdate": "2020-03-17T18:33:03",
                        "confirmed": 0,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Jersey",
                        "lastUpdate": "2020-03-17T18:33:03",
                        "confirmed": 0,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Puerto Rico",
                        "lastUpdate": "2020-03-17T16:13:14",
                        "confirmed": 0,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "Republic of the Congo",
                        "lastUpdate": "2020-03-17T21:33:03",
                        "confirmed": 0,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "The Bahamas",
                        "lastUpdate": "2020-03-19T12:13:38",
                        "confirmed": 0,
                        "deaths": 0,
                        "recovered": 0
                    },
                    {
                        "province": "",
                        "country": "The Gambia",
                        "lastUpdate": "2020-03-18T14:13:56",
                        "confirmed": 0,
                        "deaths": 0,
                        "recovered": 0
                    }
                ]
                // if (event) event.preventDefault();
                // this.params = this.$root.buildQueryString({
                //     country: this.country
                // });
                // this.$http.get('https://covid19-api.weedmark.systems/api/v1/stats' + this.params, {
                // }).then((response) => {
                //     this.stats = response.data.data.covid19Stats;
                //     console.log(this.stats);
                //     history.pushState("", "", this.params)
                // });
            },
        }
    }
</script>

<style>
    th:hover {
        cursor: pointer;
        text-decoration: underline #007bff;
    }
</style>