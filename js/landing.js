function autoScrollTo(el) {
    var top = $("#" + el).offset().top;
    $("html, body").animate({ scrollTop: top }, 400);
}

$(document).ready(function() {
    $('#signup').click(function() {
        $('.signup').slideToggle(300);
    });
});