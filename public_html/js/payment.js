// hide credit card info div
$("#cc-info").css({
    //'display': 'none',
    'visibility': 'hidden',
});

// show credit card info on button click
$("#cc").on('click', function(e) {
    if ($("#cc-info").css({ 'visibility': 'hidden' }))
        $("#cc-info").show().attr('aria-hidden', true).css('visibility', 'visible');

    return false;
});