require('./bootstrap');

window.swal = require('sweetalert2');

import 'sweetalert2/dist/sweetalert2.css';

require('./chosen.jquery');

// Vue.component('line-chart', require('./components/LineChart.vue'));
// Vue.component('bar-chart', require('./components/BarChart.vue'));
// Vue.component('pie-chart', require('./components/PieChart.vue'));

const app = new Vue({
    el: '#app'
});

$(document).ready( function() {
    // Tooltips
    $("[data-toggle='tooltip']").tooltip({container:"body"});

    // Popovers
    $("[data-toggle='popover']").popover();

    // Chosen select
    $(".chosen-select").chosen({ allow_single_deselect: true });

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
