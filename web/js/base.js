$(function () {
    $("[class^=flash-]").each(function (index) {

        var message = $(this).text();

        delayOpenDuration = index * 2500;

        if ($(this).hasClass("flash-notice")) {
            var color = "blue";
        } else {
            var color = "red";
        }

        new jBox("notice", {
            addClass: "jBox-wrapper jBox-Notice jBox-NoticeFancy jBox-Notice-color jBox-Notice-" + color,
            autoClose: 2500,
            fixed: true,
            position: { x: "left", y: "bottom" },
            offset: { x: 0, y: -20 },
            responsiveWidth: true,
            content: message,
            overlay: false,
            delayOpen: delayOpenDuration,
            closeOnClick: "box",
            onCloseComplete: function () {
              this.destroy();
            }
        }).open();
        
        $(this).remove();
    });
});