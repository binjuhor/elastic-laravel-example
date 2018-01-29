
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./template/jquery-1.10.2');
// require('./sweetalert');
// require('./bootstrap');
// require('./template/bootstrap-checkbox-radio-switch');
// require('./template/chartist.min');
// require('./template/bootstrap-notify');
// require('./template/light-bootstrap-dashboard');
// require('./template/bootstrap-select');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: 'body'
});
