// open navbar nav on hover 
$(function() {
    $('.navbar-default .dropdown').hover(function() {
            $(this).addClass('open');
        },
        function() {
            $(this).removeClass('open');
        });
});

// get value of url parameter count
param = query_string('count');
$(document).ready(function() {
    $('#items').empty().append(param);
});

//function to search url string and return parameter
function query_string(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i = 0, n = vars.length; i < n; i++) {
        var pair = vars[i].split("=");
        if (pair[0] == variable) {
            return pair[1];
        }
    }
    return false;
}