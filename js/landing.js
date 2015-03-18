var curView = "dashboard";

function autoScrollTo(el) {
    var top = $("#" + el).offset().top;
    $("html, body").animate({ scrollTop: top }, 400);
}

function switchTo(panel) {
    $(document).ready(function() {

        if (curView == panel) {
          if (curView == "dashboard") {
            return;
          }
          panel = "dashboard";
        }

        $("." + panel).slideToggle(300);
        $("." + curView).slideToggle(300);
        curView = panel;
        
    });
}
