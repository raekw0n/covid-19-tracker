import Vue from 'vue'
import App from './App.vue';
import axios from 'axios';
import moment from 'moment';
import _ from 'lodash';

import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

import {library} from '@fortawesome/fontawesome-svg-core'
import {faGithub} from "@fortawesome/free-brands-svg-icons";
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'

import { VuejsDatatableFactory } from 'vuejs-datatable';

Vue.use( VuejsDatatableFactory );

library.add(faGithub);
Vue.component('font-awesome-icon', FontAwesomeIcon);

Vue.prototype.$_ = _;
Vue.prototype.$http = axios;
Vue.config.productionTip = false;

Vue.filter('formatDate', value => {
    if (value) {
        return moment(value, 'YYYY-MM-DD HH:mm:ss').format('lll');
    }
});

new Vue({
    render: h => h(App),
    methods: {
        buildQueryString(params) {
            let query = '';
            Object.keys(params).forEach(k => {
                if (params[k] != null) {
                    query += (query === '') ? '?' : '&';
                    query += k + '=' + params[k];
                }
            });

            return query;
        }
    },
    data: {
        columns: [
            {label: 'id', field: 'id'},
            {label: 'Username', field: 'user.username', headerClass: 'class-in-header second-class'},
            {label: 'First Name', field: 'user.firstName'},
            {label: 'Last Name', field: 'user.lastName'},
            {label: 'Email', field: 'user.email'},
            {label: 'Address', representedAs: ({address, city, state}) => `${address}<br />${city}, ${state}`, interpolate: true}
        ],
        rows: [
            //...
            {
                id: 1,
                user: {
                    username: "dprice0",
                    firstName: "Daniel",
                    lastName: "Price",
                    email: "dprice0@blogs.com"
                },
                address: "3 Toban Park",
                city: "Pocatello",
                state: "Idaho"
            }
            //...
        ]
    }
}).$mount('#app');
