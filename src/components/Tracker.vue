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
                <small class="text-muted">(Data source: <a href="https://systems.jhu.edu/research/public-health/ncov/">John Hopkins CSSE</a>)</small>
                <br />
                <small class="text-muted">(Last updated: {{ '2020-03-21T17:02:34'|formatDate }})</small>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-sm-12 py-2">
                <div class="card bg-success text-white h-100">
                    <div class="card-body bg-secondary">
                        <h6 class="text-uppercase">Cases</h6>
                        <h1 class="display-4">{{ this.total_cases.toLocaleString() }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-12 py-2">
                <div class="card text-white bg-danger h-100">
                    <div class="card-body bg-danger">
                        <h6 class="text-uppercase">Deaths</h6>
                        <h1 class="display-4">{{ this.total_deaths.toLocaleString() }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-12 py-2">
                <div class="card text-white bg-info h-100">
                    <div class="card-body bg-success">
                        <h6 class="text-uppercase">Recovered</h6>
                        <h1 class="display-4">{{ this.total_recovered.toLocaleString() }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="filters">
                    <div class="mt-2">
                        <form class="form-inline">
                            <label for="country" class="sr-only">Country:</label>
                            <select class="form-control mb-2 mr-sm-2 custom-select" name="country"
                                    id="country" v-model="country" @change="get($event)">
                                <option value="" selected>-- Select Country --</option>
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Antigua & Deps">Antigua & Deps</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Australia">Australia</option>
                                <option value="Austria">Austria</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Belize">Belize</option>
                                <option value="Benin">Benin</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia">Bolivia</option>
                                <option value="Bosnia">Bosnia & Herzegovina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Brunei">Brunei</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina">Burkina</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Canada">Canada</option>
                                <option value="Cape Verde">Cape Verde</option>
                                <option value="Central African Rep">Central African Rep</option>
                                <option value="Chad">Chad</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Cote d'Ivoire">Cote d'Ivoire</option>
                                <option value="Croatia">Croatia</option>
                                <option value="Cruise Ship">Cruise Ship</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="East Timor">East Timor</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Greece">Greece</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Holy See">Holy See</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Iran">Iran</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Korea, North">Korea North</option>
                                <option value="Korea, South">Korea South</option>
                                <option value="Kosovo">Kosovo</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Laos">Laos</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libya">Libya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macedonia">Macedonia</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Micronesia">Micronesia</option>
                                <option value="Moldova">Moldova</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montenegro">Montenegro</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau">Palau</option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Romania">Romania</option>
                                <option value="Russian Federation">Russian Federation</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="St Lucia">St Lucia</option>
                                <option value="Saint Vincent & the Grenadines">Saint Vincent & the Grenadines</option>
                                <option value="Samoa">Samoa</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Serbia">Serbia</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Slovakia">Slovakia</option>
                                <option value="Slovenia">Slovenia</option>
                                <option value="Solomon Islands">Solomon Islands</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="South Sudan">South Sudan</option>
                                <option value="Spain">Spain</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Swaziland">Swaziland</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syria">Syria</option>
                                <option value="Taiwan">Taiwan</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania">Tanzania</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Togo">Togo</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Vatican City">Vatican City</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Vietnam">Vietnam</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                            </select>

                            <label for="province" class="sr-only">Province:</label>
                            <input class="form-control mb-2 mr-sm-2" id="province" v-model="province" name="province"
                                   type="search" placeholder="Enter province..." @keyup.enter="get($event)">
                            <button type="submit" class="mb-2 btn btn-secondary"
                                    v-on:click="get($event)">Search</button>
                        </form>
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
                        <tr v-for="stat in sorted" v-bind:key="stat.id">
                            <td>{{ stat.country }}</td>
                            <td>{{ stat.province }}</td>
                            <td :class="{ 'text-muted': stat.confirmed <= 100, 'text-amber': stat.confirmed > 100 && stat.confirmed <= 1000, 'text-danger': stat.confirmed > 1000  }">{{ stat.confirmed.toLocaleString() }}</td>
                            <td :class="{ 'text-muted': stat.deaths === 0, 'text-danger': stat.deaths > 0 }">{{ stat.deaths.toLocaleString() }}</td>
                            <td :class="{ 'text-muted': stat.recovered === 0, 'text-success': stat.recovered > 0 }">{{ stat.recovered.toLocaleString() }}</td>
                            <td>{{ stat.last_updated|formatDate }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        <nav class="mx-auto">
                            <ul class="pagination">
                                <li class="page-item">
                                    <button type="button" class="page-link" @click="prevPage">
                                        Previous
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
                                        Next
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
                country: '',
                province: '',
                total_cases: 0,
                total_deaths: 0,
                total_recovered: 0,
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
                    country: this.country,
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
                    history.pushState("", "", this.params)
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
        display: inline-block;

        &.active {
            background: #2c3e50;
            color: white;
        }
    }

    button.page-link {
        color: #2c3e50;
        font-weight: 500;
    }

    .offset{
        width: 500px !important;
        margin: 20px auto;
    }
</style>