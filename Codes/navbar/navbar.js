$(".menu li").on("mouseover touchstart", function () {
    let idx = $(this).index();
    $(".goo li").removeClass("hover");
    $("nav li").eq(idx).addClass("hover");
}).on("mouseout touchend", function () {
    $("nav li").removeClass("hover");
});