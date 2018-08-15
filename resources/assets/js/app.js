
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueSweetalert2 from 'vue-sweetalert2';

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('sidebar-component', require('./components/SidebarComponent.vue'));
Vue.component('campaign-component', require('./components/CampaignComponent.vue'));

Vue.filter('uppercase', function (value) {
	return value.toUpperCase()
})

Vue.use(VueSweetalert2);

const app = new Vue({
    el: '#app'
});

