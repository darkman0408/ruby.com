// array that stores id as checkbox is checked
var categoryId = [];

// start change listener for checkboxes
$('input[type=checkbox]').on('change', function() {
    event.preventDefault();

    // find index for specific checkbox
    var categoryIdIndex = categoryId.indexOf($(this).attr('id'));

    if (!$(this).is(':checked')) {
        // when checkbox is clicked, store it's value in array 
        categoryId.push($(this).attr('id'));

    } else {
        // when unchecked, remove it's value from array
        categoryId.splice(categoryIdIndex, 1);
    }

    // send data to php
    $.ajax({
        url: "?r=site%2Ffilter-images",
        type: "POST",
        async: true,
        cache: false,
        data: { 'product_subcategory': categoryId },
        success: function(response) {
            $('#data-container').html(response);
        },
        error: function(e) {
            console.log(e);
        }
    });
});