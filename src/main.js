import Vue from 'vue'
import VueGtag from "vue-gtag";
import App from './App.vue';
import axios from 'axios';
import moment from 'moment';
import _ from 'lodash';

import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

import {library} from '@fortawesome/fontawesome-svg-core'
import {faGithub} from "@fortawesome/free-brands-svg-icons";
import {faCaretLeft, faCaretRight, faFileCsv} from "@fortawesome/free-solid-svg-icons";
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'

library.add(faGithub, faCaretLeft, faCaretRight, faFileCsv);
Vue.component('font-awesome-icon', FontAwesomeIcon);

Vue.prototype.$_ = _;
Vue.prototype.$http = axios;
Vue.config.productionTip = false;

Vue.filter('formatDate', value => {
    if (value) {
        return moment(value, 'YYYY-MM-DD HH:mm:ss').format('lll');
    }
});

Vue.use(VueGtag, {
    config: { id: "UA-147973519-3" }
});

new Vue({
    el: '#app',
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
    }
});
