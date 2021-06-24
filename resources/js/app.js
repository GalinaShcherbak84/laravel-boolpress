/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */



window.Vue = require('vue');

//INIT VUE MAIN INSTANCE
import App from './App.vue';
const root = new Vue({
    el: '#root',
    render: h1 => h1(App)
});
