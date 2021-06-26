/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */



window.Vue = require('vue');

//INIT VUE MAIN INSTANCE
import App from './App.vue';
import router from './routes';
const root = new Vue({
    el: '#root',
    router,
    render: h1 => h1(App)
});
