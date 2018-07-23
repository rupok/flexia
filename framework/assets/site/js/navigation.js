(function($) {
    $.fn.flexiaMegaNav = function(options) {
        var flexiaMenu = $(this),
            settings = $.extend({
                format: "dropdown",
                sticky: false
            }, options);
        return this.each(function() {
            // $(this).find(".flexia-nav-btn").on('click', function() {
            //     $(this).toggleClass('menu-opened');
            //     var flexiaNavMenu = $(this).next('ul.nav-menu');
            //     if (flexiaNavMenu.hasClass('open')) {
            //         flexiaNavMenu.slideToggle().removeClass('open');
            //     } else {
            //         flexiaNavMenu.slideToggle().addClass('open');
            //         if (settings.format === "dropdown") {
            //             flexiaNavMenu.find('ul').show();
            //         }
            //     }
            // });
            // flexiaMenu.find('li ul').parent().addClass('has-sub');
            // multiTg = function() {
            //     flexiaMenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
            //     flexiaMenu.find('.submenu-button').on('click', function() {
            //         $(this).toggleClass('submenu-opened');
            //         if ($(this).siblings('ul').hasClass('open')) {
            //             $(this).siblings('ul').removeClass('open').slideToggle();
            //         } else {
            //             $(this).siblings('ul').addClass('open').slideToggle();
            //         }
            //     });
            // };
            // if (settings.format === 'multitoggle') multiTg();
            // else flexiaMenu.addClass('dropdown');
            // if (settings.sticky === true) flexiaMenu.css('position', 'fixed');
            // resizeFix = function() {
            //     var mediasize = 767;
            //     if ($(window).width() > mediasize) {
            //         flexiaMenu.find('ul').show();
            //     }
            //     if ($(window).width() <= mediasize) {
            //         flexiaMenu.find('ul').hide().removeClass('open');
            //     }
            // };
            // resizeFix();
            // return $(window).on('resize', resizeFix);
        });
    };
})(jQuery);

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

            console.log( flexiaMenu );

            var megaNavParent;

            flexiaMegaMenu = function(){
                if( flexiaMenu.hasClass( 'main-navigation' ) ) {
                    megaNavParent = flexiaMenu.find('li.flexia-mega-menu');
                    var megaNavContent = megaNavParent.children( 'ul.sub-menu' );

                        if( megaNavParent ) flexiaMenu.parents('.flexia-navbar-inner').addClass( 'flexia-has-mega' );

                        mainContent = '';

                        megaNavContent.children('li').each(function(i, item){
                            var title = '<h3>' + $( item ).children('a').text() + '</h3>',
                                tempContent = $( item ).has('ul').length > 0 ? '<ul>' + $( item ).children('ul').html() + '</ul>' : '',
                                content = title + tempContent;

                            mainContent += "<div class='flexia-mega-column column-"+ i +"'>" + content + "</div>";
                        });

                    // Mega Menu Wrapped with a Div Element.
                    megaNavParent.append( "<div class='flexia-mega-menu-wrapper'>" + mainContent + "</div>" );
                }
                return;
            }

            flexiaMegaMenu();

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
                var mediasize = 767;
                if ($(window).width() > mediasize) {
                    flexiaMenu.find('ul').show();
                    megaNavParent.find('ul.sub-menu').hide();
                }
                if ($(window).width() <= mediasize) {
                    flexiaMenu.find('ul').hide().removeClass('open');
                    $('.flexia-mega-menu-wrapper').hide();
                }
            };
            resizeFix();
            return $(window).on('resize', resizeFix);
        });
    };
})(jQuery);

(function($) {
    $(document).ready(function() {
        $(".main-navigation").flexiaNav({
            format: "multitoggle"
        });
    });
    $(document).ready(function() {
        $(".topbar-navigation").flexiaNav({
            format: "multitoggle"
        });
    });
})(jQuery);