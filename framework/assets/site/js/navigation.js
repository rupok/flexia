(function($) {
    $.fn.flexiaNav = function() {
        $(this).each(function() {
            var $scope = $(this)

            // insert indicator
            $('.nav-menu > li.menu-item-has-children', $scope).each(function() {
                $('> a', $(this)).append('<span class="fa fa-angle-down"></span>')
                $(this).append('<span class="flexia-menu-indicator"></span>')
            })
            $('.nav-menu > li ul li.menu-item-has-children', $scope).each(function() {
                $('> a', $(this)).append('<span class="fa fa-angle-right"></span>')
                $(this).append('<span class="flexia-menu-indicator"></span>')
            })

            // insert responsive menu toggle, text
            $('.nav-menu', $scope).after('<button class="flexia-menu-toggle"></button>')

            // responsive menu slide		
            $($scope).on('click', '.flexia-menu-toggle', function(e) {
                e.preventDefault()
                $(this).toggleClass('flexia-menu-toggle-open').siblings('.nav-menu').css('display') == 'none' ? $(this).siblings('.nav-menu').slideDown(300) : $(this).siblings('.nav-menu').slideUp(300)
            })

            // clear responsive props
            $(window).on('resize load', function() {
                if (window.matchMedia('(max-width: 991px)').matches) {
                    $('.nav-menu', $scope).addClass('flexia-menu-responsive')
                } else {
                    $('.nav-menu', $scope).removeClass('flexia-menu-responsive')
                    $('.flexia-menu-toggle', $scope).removeClass('flexia-menu-toggle-open')
                    $('.flexia-menu-indicator', $scope).removeClass('flexia-menu-indicator-open')
                    $('.nav-menu, .nav-menu ul', $scope).css('display', '')
                }
            })

            // menu toggle		
            $($scope).on('click', '.flexia-menu-indicator', function(e) {
                e.preventDefault()
                $(this).toggleClass('flexia-menu-indicator-open')
                $(this).hasClass('flexia-menu-indicator-open') ? $(this).siblings('ul').slideDown(300) : $(this).siblings('ul').slideUp(300)
            })
        })
    }
})(jQuery);

(function($) {
    $(document).ready(function() {
        $('.main-navigation').flexiaNav()
        $('.topbar-navigation').flexiaNav()
    })
})(jQuery);