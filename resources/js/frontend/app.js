/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../bootstrap');
require('../plugins');
require('datatables.net-bs4');

import Vue from 'vue';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });

$(document).ready(function(){
    var body = $('body.lazy-load');
    var image = body.data('image');
    var img = $('<img />').attr({
        'src': image,
    }).on('load', function() {
        body.css('background', 'url("'+image+'") center center fixed');
        body.css('background-size', 'cover');
    });

    $('.lazy-load').each(function(){
        var image = $(this).data('image');
        var img = $('<img />').attr({
            'src': image,
        }).on('load', function() {
            //TODO set each image
        //     $(this).css('background', 'url("'+image+'") center center fixed');
        //     $(this).css('background-size', 'cover');
        });
    });
});
