$(function() {
    $(".display-comment input[type='submit']").css("display", "none");
    $(".traloi").click(function() {
        var $this = $(this);
        if ($this.data("clicked")) {
            console.log("clicked");
        } else {
            $this.data("clicked", true);

            $this
                .parents("form")
                .find("input[type='text']")
                .css("display", "block");

            $this
                .parents("form")
                .find("input[type='submit']")
                .css("display", "inline-block");
        }
    });
});
