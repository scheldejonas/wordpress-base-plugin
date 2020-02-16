/**
* First we will load all of this project's JavaScript dependencies which
* includes Vue and other libraries. It is a great starting point when
* building robust, powerful web applications using Vue and Laravel.
*/

// Set - lodash for a lot of nice upgraded quick functions
window._lodash = require('lodash');


// Set - moment for use with date formatting
window.moment = require('moment');


// Set - axios for requesting the data
window.axios = require('axios').create({
    withCredentials: true,
    baseURL: window.ajaxurl,
    headers : {
        common: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        post: {
            'Content-Type': 'application/x-www-form-urlencoded',
        }
    }
});


// Set - vue library for components insertion
window.Vue = require('vue');


/**
 * The following registrations are to make it easy to implement different kinds of components
 * into the html of the wordpress layout.
 * This is after wordpress has generated the cached frontend but before we are activating the Vue instance
 */

import DatePicker from 'v-calendar/lib/components/date-picker.umd';

Vue.component('date-picker', DatePicker);

// Vue.component('date-list', require('./DateList').default );

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

jQuery(document).ready(() => {

    const vue = new Vue({
        el: '#plugin_name_body',
    });

});
