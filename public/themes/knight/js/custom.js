$(document).ready(function () {
    //FANCYBOX
    //https://github.com/fancyapps/fancyBox
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});

let Dropdowns = function () {
    let t = $(".dropup, .dropright, .dropdown, .dropleft"), e = $(".dropdown-menu"), r = $(".dropdown-menu .dropdown-menu");
    $(".dropdown-menu .dropdown-toggle").on("click", function () {
        let a;
        return (a = $(this)).closest(t).siblings(t).find(e).removeClass("show"),
            a.next(r).toggleClass("show"),
            !1
    }),
        t.on("hide.bs.dropdown", function () {
            let a, t;
            a = $(this),
                (t = a.find(r)).length && t.removeClass("show")
        })
}()