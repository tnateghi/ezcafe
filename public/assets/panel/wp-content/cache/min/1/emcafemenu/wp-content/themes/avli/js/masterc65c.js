jQuery(document).on("click", ".show-full a", function (e) {
    e.preventDefault();
    jQuery(".show-full").toggleClass("my-rotate");
    jQuery(".full-menu").toggleClass("height-menu");
    jQuery(".overlay").toggleClass("show-over");
    jQuery(".full-menu h2.show-full a").toggleClass("go-bottom");
    jQuery(this).text(
        jQuery(this).text() == "همه دسته بندی ها"
            ? "صفحه اصلی"
            : "همه دسته بندی ها"
    );
});
jQuery(document).on("click", ".overlay", function (e) {
    e.preventDefault();
    jQuery(".full-menu").removeClass("height-menu");
    jQuery(".overlay").removeClass("show-over");
    jQuery(".overlay").removeClass("show-over2");
    jQuery(".description").removeClass("activepops");
    jQuery(".full-menu h2.show-full a").removeClass("go-bottom");
});
jQuery(document).on("click", ".inner-item", function (e) {
    e.preventDefault();
    jQuery(this).find(".description").addClass("activepops");
    jQuery(".overlay").addClass("show-over2");
});
jQuery(".header-item-container").click(function () {
    jQuery(".full-menu").removeClass("height-menu");
    jQuery(".show-full").removeClass("my-rotate");
    jQuery(".show-full > a").removeClass("go-bottom");
    jQuery(".overlay").removeClass("show-over");
    jQuery(".show-full a").text("همه دسته بندی ها");
});
jQuery("#gotomenu").click(function () {
    jQuery(".main-page").addClass("goleft");
    jQuery("body, .main").css("overflow", "unset");
    jQuery("body, .main").css("max-height", "unset");
});
jQuery(".gotohome a").click(function () {
    jQuery(".main-page").removeClass("goleft");
    jQuery("body, .main").css("overflow", "hidden");
    jQuery("body, .main").css("max-height", "100vh");
});
jQuery("#showork").click(function () {
    jQuery(".working").addClass("show");
    jQuery(".working").removeClass("hide");
});
jQuery("#showabout").click(function () {
    jQuery(".about").addClass("show");
    jQuery(".about").removeClass("hide");
});
jQuery("#workout").click(function () {
    jQuery(".working").addClass("hide");
    jQuery(".working").removeClass("show");
});
jQuery("#aboutout").click(function () {
    jQuery(".about").addClass("hide");
    jQuery(".about").removeClass("show");
});
var flag = !0;
var heighthead = jQuery(".header").height() + 45;
jQuery(document).on("click", 'a[href^="#"]', function (e) {
    e.preventDefault();
    var id = jQuery(this).attr("href");
    var $id = jQuery(id);
    if ($id.length === 0) {
        return;
    }
    var pos = $id.offset().top - heighthead - 50;
    jQuery("body, html").animate({ scrollTop: pos }, 1000);
});
jQuery(document).ready(function () {
    var mySwiper = new Swiper(".swiper-container", {
        slidesPerView: 8,
        spaceBetween: 1,
        touchRatio: 1,
        allowTouchMove: !0,
        centeredSlides: !0,
        breakpoints: {
            1024: { slidesPerView: 8, spaceBetween: 1 },
            768: { slidesPerView: 5, spaceBetween: 1 },
            640: { slidesPerView: 3, spaceBetween: 1 },
            320: { slidesPerView: 2.3, spaceBetween: 1 },
        },
    });
    jQuery(window).scroll(function () {
        console.log(flag);
        var st = jQuery(window).scrollTop();
        jQuery(".each-menu").each(function () {
            var in_item = jQuery(this).index();
            var this_pos = jQuery(this).offset().top;
            var this_hei = jQuery(this).height();
            var data_class = jQuery(this).attr("data-class");
            if (
                st + jQuery(window).height() - 100 >= this_pos &&
                st + jQuery(window).height() - 100 <= this_pos + this_hei
            ) {
                jQuery(".menu-h .swiper-slide").removeClass(
                    "swiper-slide-active"
                );
                jQuery(".menu-h .swiper-slide." + data_class).addClass(
                    "swiper-slide-active"
                );
                console.log(in_item);
                if (flag) {
                    mySwiper.slideTo(in_item);
                }
                jQuery(".header-item").removeClass("active");
                jQuery(".header-item-container." + data_class)
                    .find(".header-item")
                    .addClass("active");
            }
        });
    });
    mySwiper.on("touchEnd", () => {
        setTimeout(function () {
            jQuery(".swiper-slide-active").find("a").trigger("click");
        }, 1500);
    });
});
