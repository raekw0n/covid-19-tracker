import Vue from 'vue'
import App from './App.vue';
import axios from 'axios';
import moment from 'moment';

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
    }
}).$mount('#app');
