/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./chosen.jquery');

window.swal = require('./sweetalert.min');

var Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
*/

Vue.component('line-chart', require('./components/LineChart.vue'));
Vue.component('bar-chart', require('./components/BarChart.vue'));
Vue.component('pie-chart', require('./components/PieChart.vue'));

const app = new Vue({
    el: '#app'
});

// Tooltips
$("[data-toggle='tooltip']").tooltip({container:"body"});

// Popovers
$("[data-toggle='popover']").popover();

// Chosen select
$(".chosen-select").chosen({ allow_single_deselect: true });

$(document).ready( function() {
    // Logout button > navigation
    let logout = $('#logout-btn');
    logout.on('click', function(e) {
        e.preventDefault();
        $('#logout-form').submit();
    });
});

window.deleteEntity = function (element, subject) {
    swal({
        title: "Are you sure you want to delete '" + subject + "'?",
        text: 'This cannot be undone',
        type: "warning",
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    }, function () {
        $(element).closest('form').submit();
    });
};

window.deleteSubscription = function (element, subject) {
    swal({
        title: "Are you sure that you want to unsubscribe?",
        text: 'This cannot be undone',
        type: "warning",
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, I'm sure!",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    }, function () {
        $(element).closest('form').submit();
    });
};

