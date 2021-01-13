$(function() {

    var newHash      = "",
        $mainContent = $("#main-container"),
        $pageWrap    = $("body"),
        baseHeight   = 0,
        $el;

    $pageWrap.height($pageWrap.height());
    baseHeight = $pageWrap.height() - $mainContent.height();

    $("#Content").delegate("a", "click", function() {
        window.location.hash = $(this).attr("href");
        return false;
    });

    $(window).bind('hashchange', function(){

        newHash = window.location.hash.substring(1);

        if (newHash) {
            $mainContent
                .find("#container")
                .fadeOut(200, function() {
                    $mainContent.hide().load(newHash + " #cocntainer", function() {
                        $mainContent.fadeIn(200, function() {
                            $pageWrap.animate({
                                height: baseHeight + $mainContent.height() + "px"
                            });
                        });
                        $("#Content a").removeClass("current");
                        $("#Content a[href="+newHash+"]").addClass("current");
                    });
                });
        };

    });

    $(window).trigger('hashchange');

});