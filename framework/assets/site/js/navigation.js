(function($) {
    $.fn.flexiaNav = function(options) {
        var flexiaMenu = $(this),
            settings = $.extend({
                format: "dropdown",
                sticky: false
            }, options);
        return this.each(function() {
            $(this).find(".flexia-nav-btn").on('click', function() {
                $(this).toggleClass('menu-opened');
                var flexiaNavMenu = $(this).next('ul.nav-menu');
                if (flexiaNavMenu.hasClass('open')) {
                    flexiaNavMenu.slideToggle().removeClass('open');
                } else {
                    flexiaNavMenu.slideToggle().addClass('open');
                    if (settings.format === "dropdown") {
                        flexiaNavMenu.find('ul').show();
                    }
                }
            });
            flexiaMenu.find('li ul').parent().addClass('has-sub');
            multiTg = function() {
                flexiaMenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
                flexiaMenu.find('.submenu-button').on('click', function() {
                    $(this).toggleClass('submenu-opened');
                    if ($(this).siblings('ul').hasClass('open')) {
                        $(this).siblings('ul').removeClass('open').slideToggle();
                    } else {
                        $(this).siblings('ul').addClass('open').slideToggle();
                    }
                });
            };
            if (settings.format === 'multitoggle') multiTg();
            else flexiaMenu.addClass('dropdown');
            if (settings.sticky === true) flexiaMenu.css('position', 'fixed');
            resizeFix = function() {
                var mediasize = 768;
                if ($(window).width() > mediasize) {
                    flexiaMenu.find('ul').show();
                }
                if ($(window).width() <= mediasize) {
                    flexiaMenu.find('ul').hide().removeClass('open');
                }
            };
            resizeFix();
            return $(window).on('resize', resizeFix);
        });
    };
})(jQuery);

(function($) {
    $(document).ready(function() {
        $(".flexia-menu").flexiaNav({
            format: "multitoggle"
        });
    });
})(jQuery);