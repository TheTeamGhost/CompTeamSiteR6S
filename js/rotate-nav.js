$(document).ready(function () {
    var scroll_pos = 0;
    $(document).scroll(function () {
        scroll_pos = $(this).scrollTop();
        if (scroll_pos > 100) {
            $(".mainWrapper").removeClass("tilted-nav")
        } else {
            $(".mainWrapper").addClass("tilted-nav")
        }
    });
});
