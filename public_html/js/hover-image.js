// style button
$("button").css({
    'background': 'transparent',
    'border': 'none',
});

// initialize popover 
$(document).on('ready', function() {
    // initalize popover on hover of #myPopover
    $("#btn1").popoverButton({
        target: '#myPopover',
        trigger: 'manual'
    });
});

// show popover when mouse enter image
$("#btn1").on('mouseenter.popoverX', function(e) {
    $("#myPopover").popoverX('show');
});

// keep popover open, close if mouse leave
$("#btn1").on('mouseleave.popoverX', function(e) {
    setTimeout(function() {
        if (!$(".popover:hover").length)
            $("#myPopover").popoverX('hide');
    }, 300);
});