/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// plugins
import VueSweetalert2 from 'vue-sweetalert2';
import VeeValidate from 'vee-validate';
import VueCurrencyFilter from 'vue-currency-filter'

import Inputmask from "inputmask";

Vue.use(VueCurrencyFilter, {
    symbol: 'Rp'
});
Vue.use(VueSweetalert2);
Vue.use(VeeValidate);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('form-sales', require('./components/FormSales.vue').default);

// setup axios interceptor
window.axios.interceptors.response.use(function (response) {
    // Do something before request is sent
    return response;
}, function (error) {

    if (error.response.status == 422) {
        let errorMessages = _.map(error.response.data.errors, err => {
            return err[0]
        });

        Vue.swal({
            title: 'Validation Failed!',
            html: errorMessages.join('<br>'),
            type: 'error',
        })
    } else if (error.response.status == 500) {
        Vue.swal({
            type: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
        })
    } else if (error.response.status == 401) {
        // window.location = '/login'
    }

    return Promise.reject(error.response);
});

/*
 * By extending the Vue prototype with a new '$bus' property
 * we can easily access our global event bus from any child component.
 */
Object.defineProperty(Vue.prototype, '$bus', {
    get() {
        return this.$root.bus;
    }
});

window.bus = new Vue({});

const app = new Vue({
    el: '#app',
    data() {
        return {
            bus: bus
        }
    }
});

