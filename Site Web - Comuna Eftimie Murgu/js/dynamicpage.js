$(function() {

    var newHash      = "",
        $mainContent = $("#main-content"),
        $pageWrap    = $(""),
        baseHeight   = 0,
        $el;

    $pageWrap.height($pageWrap.height());
    baseHeight = $pageWrap.height() - $mainContent.height();

    $("#Menu").delegate("a", "click", function() {
        window.location.hash = $(this).attr("href");
        return false;
    });

    $(window).bind('hashchange', function(){

        newHash = window.location.hash.substring(1);

        if (newHash) {
            $mainContent
                .find("#container")
                .fadeOut(200, function() {
                    $mainContent.hide().load(newHash + " #container", function() {
                        $mainContent.fadeIn(200, function() {
                            $pageWrap.animate({
                                height: baseHeight + $mainContent.height() + "px"
                            });
                        });
                        $("#Menu a").removeClass("current");
                        $("#Menu a[href="+newHash+"]").addClass("current");
                    });
                });
        };

    });

    $(window).trigger('hashchange');

});