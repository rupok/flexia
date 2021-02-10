//Flexia Navigation Scripts
(function ($) {
    $.fn.flexiaNav = function () {
        $(this).each(function () {
            var $scope = $(this)

            // insert indicator
            $('.nav-menu > li.menu-item-has-children', $scope).each(function () {
                $('> a', $(this)).append('<span class="parent-menu-dropdown-icon"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve"> <g> <g> <path d="M265.2,390.7l218.9-218.9c5.1-5.1,7.9-11.8,7.9-19s-2.8-14-7.9-19L468,117.5c-10.5-10.5-27.6-10.5-38.1,0L246.1,301.4 L62,117.3c-5.1-5.1-11.8-7.9-19-7.9c-7.2,0-14,2.8-19,7.9L7.9,133.5c-5.1,5.1-7.9,11.8-7.9,19s2.8,14,7.9,19L227,390.7 c5.1,5.1,11.9,7.9,19.1,7.8C253.3,398.5,260.1,395.8,265.2,390.7z"/> </g> </g> </svg></span>')
                $(this).append('<span class="flexia-menu-indicator"></span>')
            })
            $('.nav-menu > li ul li.menu-item-has-children', $scope).each(function () {
                $('> a', $(this)).append('<span class="submenu-menu-dropdown-icon"><svg version="1.1" viewBox="0 0 290 492" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g transform="translate(145 246) rotate(-90) translate(-246 -145)" fill="#000"><path d="m265.2 281.7 218.9-218.9c5.1-5.1 7.9-11.8 7.9-19s-2.8-14-7.9-19l-16.1-16.3c-10.5-10.5-27.6-10.5-38.1 0l-183.8 183.9-184.1-184.1c-5.1-5.1-11.8-7.9-19-7.9s-14 2.8-19 7.9l-16.1 16.2c-5.1 5.1-7.9 11.8-7.9 19s2.8 14 7.9 19l219.1 219.2c5.1 5.1 11.9 7.9 19.1 7.8 7.2 0 14-2.7 19.1-7.8z"/></g></g></svg></span>')
                $(this).append('<span class="flexia-menu-indicator"></span>')
            })

            // insert responsive menu toggle, text
            $('.nav-menu', $scope).after('<button class="flexia-menu-toggle"></button>')

            // responsive menu slide		
            $($scope).on('click', '.flexia-menu-toggle', function (e) {
                e.preventDefault()
                $(this).toggleClass('flexia-menu-toggle-open').siblings('.nav-menu').css('display') == 'none' ? $(this).siblings('.nav-menu').slideDown(300) : $(this).siblings('.nav-menu').slideUp(300)
            })

            // clear responsive props
            $(window).on('resize load', function () {
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
            $($scope).on('click', '.flexia-menu-indicator', function (e) {
                e.preventDefault()
                $(this).toggleClass('flexia-menu-indicator-open')
                $(this).hasClass('flexia-menu-indicator-open') ? $(this).siblings('ul').slideDown(300) : $(this).siblings('ul').slideUp(300)
            })
        })
    }
})(jQuery);

(function ($) {
    $(document).ready(function () {
        $('.main-navigation').flexiaNav()
        $('.topbar-navigation').flexiaNav()
    })
})(jQuery);


//Flexia Body Scripts
jQuery(document).ready(function ($) {
    'use strict';
    // Back to top
    var _amountScrolled = $('.flexia-back-to-top').data('start-scroll'),
        _scrollSpeed = $('.flexia-back-to-top').data('scroll-speed'),
        _button = $('a.flexia-back-to-top'),
        _window = $(window);

    _window.scroll(function () {
        if (_window.scrollTop() > _amountScrolled) {
            $(_button).css({
                'opacity': '1',
                'visibility': 'visible'
            });
        } else {
            $(_button).css({
                'opacity': '0',
                'visibility': 'hidden'
            });
        }
    });

    $(_button).on('click', function (e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, _scrollSpeed);
    });

    // Open header widgets

    $('.header-widget-toggle').on('click', function () {
        $(this).toggleClass('toggle-collapsed');
        $('.flexia-header-widget-area').toggleClass('header-widget-open');
    });

    _window.scroll(function () {
        if (_window.scrollTop() > 300) {
            $('.toggle-collapsed').css({
                'opacity': '0',
                'visibility': 'hidden'
            });
        } else {
            $('.toggle-collapsed').css({
                'opacity': '1',
                'visibility': 'visible'
            });
        }
    });


    // smooth scroll for anchors
    $('.nav-menu a[href^="#"]:not([href="#"])').on('click', function (e) {
        e.preventDefault();

        var target = this.hash,
            $target = $(target);

        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 800, 'swing');

        return false;

    });


    // smooth scroll for anchors
    $('a.scroll-down, a.scroll-to-comments').on('click', function (e) {
        e.preventDefault();
        var stickyNavbarHeight = $('.flexia-navbar-fixed-top').height();
        var target = this.hash,
            $target = $(target);

        $('html, body').stop().animate({
            'scrollTop': $target.offset().top - stickyNavbarHeight
        }, 800, 'swing');

        return false;

    });


    // Sticky menu

    $(window).scroll(function () {
        var scrollPos = $(window).scrollTop(),
            navbar = 'flexia-navbar-static-top';
        if ($('.flexia-navbar').hasClass('flexia-navbar-fixed-top')) {
            navbar = $('.flexia-navbar-fixed-top');
        } else if ($('.flexia-navbar').hasClass('flexia-navbar-transparent-sticky-top')) {
            navbar = $('.flexia-navbar-transparent-sticky-top');
        } else {
            return false;
        }

        if (scrollPos > 350) {
            navbar.addClass('flexia-sticky-navbar');
        } else {
            navbar.removeClass('flexia-sticky-navbar');
        }
    });

    var headerContentHeight = $('.header-content').height() + 200;
    var halfWindowHeight = $(window).height() / 2;
    if (halfWindowHeight < (headerContentHeight)) {
        var height = headerContentHeight;
    } else {
        height = halfWindowHeight;
    }

    $('.blog-header').css({
        'height': height
    });
    $(window).on('resize', function () {

        $('.blog-header').css({
            'height': height
        });
        $('body').css({
            'width': $(window).width()
        })
    });


    // Header parallax

    $(window).scroll(function (e) {
        parallax();
    });


    function parallax() {
        var scrollPosition = $(window).scrollTop();
        $('.page-header.blog-header .header-content').css('margin-top', (0 - (scrollPosition * .8)) + 'px');
    }

    $(window).load(function () {
        /**
         * menu indicator height 
         */
        $('.flexia-menu-indicator').on('click', function (e) {
            e.preventDefault();
            const anchor = $(this).parent('li').find('a');
            $(this).css('height', anchor.innerHeight());
        });
    })

});


// Overlay search

(function (window) {

    'use strict';

    var openCtrl = document.getElementById('btn-search'),
        closeCtrl = document.getElementById('btn-search-close'),
        searchContainer = document.querySelector('.flexia-search-overlay'),
        inputWrapper = document.querySelector(".search--input-wrapper"),
        inputSearch = document.querySelector('.search__input');

    function init() {
        initEvents();
    }

    function initEvents() {
        if (openCtrl) {
            openCtrl.addEventListener('click', openSearch);
            closeCtrl.addEventListener('click', closeSearch);
            document.addEventListener('keyup', function (ev) {
                // escape key.
                if (ev.keyCode == 27) {
                    closeSearch();
                }
            });
        }
    }

    function openSearch() {
        if (searchContainer) {
            searchContainer.classList.add('search--open');
            inputSearch.focus();
        }
    }

    function closeSearch() {
        searchContainer.classList.remove('search--open');
        inputSearch.blur();
        inputSearch.value = '';
        inputWrapper.setAttribute("data-text", '');
    }

    if (searchContainer) {
        inputSearch.addEventListener("keyup", event => {
            inputWrapper.setAttribute("data-text", event.target.value);
        })
    };

    init();

})(window);

/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
(function () {
    var isIe = /(trident|msie)/i.test(navigator.userAgent);

    if (isIe && document.getElementById && window.addEventListener) {
        window.addEventListener('hashchange', function () {
            var id = location.hash.substring(1),
                element;

            if (!(/^[A-z0-9_-]+$/.test(id))) {
                return;
            }

            element = document.getElementById(id);

            if (element) {
                if (!(/^(?:a|select|input|button|textarea)$/i.test(element.tagName))) {
                    element.tabIndex = -1;
                }

                element.focus();
            }
        }, false);
    }
})();



/**
 * Script Name: flexia-load-blog 
 */
(function ($) {
    'use strict';

    // Achive Load More
    var archive_total_page = parseInt(settings.archive_total_page) || '',
        archive_count = parseInt(settings.archive_count) || '',
        archiveLoadBtn = $('#load-more-post-archive');
    if (archive_count > archive_total_page) {
        archiveLoadBtn.remove();
    }
    archiveLoadBtn.on('click', function (event) {
        event.preventDefault();
        if (archive_count != 'undefined' && archive_count != '' && archive_total_page != 'undefined' && archive_total_page != '') {
            if (archive_count > archive_total_page) {
                return false;
            }
            loadNextPosts(archive_count, $(this));
            archive_count++;
        }
    });

    // call the ajax for archive load more
    function loadNextPosts(pageNumber, self) {
        var data = {
            action: 'flexia_archive_load_more',
            page_no: pageNumber,
            posts_per_page: settings.archive_per_page,
            nonce: settings.archive_nonce,
            query_vars: settings.query_vars,
            archiveLayout: settings.archive_layout,
            archiveMasonryGridCols: settings.archive_masonry_grid_cols,
            archivePostMetaPosition: settings.archive_post_meta_position,
            archiveExcerptCount: settings.archive_excerpt_count,
            archiveMagnificPopup: settings.archive_magnific_popup,
            archiveLoadMoreText: settings.archive_load_more_text,
            archiveLoadingText: settings.archive_loading_text,
        }

        $.ajax({
            url: settings.ajax_url,
            data: data,
            type: 'POST',
            beforeSend: function (e) {
                self.addClass('button--loading');
                self.find('span').html(settings.archive_loading_text);
            },
            success: function (data) {
                console.log(data)
                self.find('span').html(settings.archive_load_more_text);
                self.removeClass('button--loading');
                $('.js-flexia-load-post').append(data);
                if (pageNumber >= archive_total_page) {
                    self.remove();
                }

                // Magnific Popup Re-Called for Portfolio when load more clicked.
                if (settings.is_pro_active === 'true' && settings.archive_magnific_popup == true) {
                    flexia_magnific_popup('.flexia-magnific-popup');
                }

                if (settings.archive_layout === 'flexia_blog_content_layout_masonry') {
                    masonaryResize();
                }

            }
        });
    }



    // Blog Load More
    if (parseInt(settings.per_page, 10) >= parseInt(settings.posts_count, 10)) {
        $('#load-more-post').remove();
    }

    var loadBtn = $('#load-more-post');
    loadBtn.on('click', function () {
        var self = $(this);
        // Ajax Call for Button

        if (settings.is_pro_active === 'true') {
            $.ajax({
                url: settings.ajax_url,
                data: {
                    action: 'load_more_post_cat',
                    postType: 'post',
                    categories: JSON.stringify(settings.selected_cats)
                },
                type: 'POST',
                success: function (data) {
                    $('.flexia-post-filter-control').html('').prepend(data);
                }
            });
        }

        // Ajax Call for load more posts
        var data = {
            action: 'load_more_posts',
            blogLayout: settings.blog_layout,
            masonryGridCols: settings.masonry_grid_cols,
            blogMetaPosition: settings.post_meta_position,
            perPage: settings.per_page,
            offset: settings.offset,
            excerptCount: settings.excerpt_count,
            postsCount: settings.posts_count,
            magnificPopup: settings.magnific_popup,
            showFilter: settings.show_filter,
            showLoadMore: settings.show_load_more,
            loadMoreText: settings.load_more_text,
            loadingText: settings.loading_text,
            categories: JSON.stringify(settings.selected_cats)
        };
        $.ajax({
            url: settings.ajax_url,
            data: data,
            type: 'POST',
            beforeSend: function (e) {
                self.addClass('button--loading');
                self.find('span').html(settings.loading_text);
            },
            success: function (data) {

                self.find('span').html(settings.load_more_text);
                self.removeClass('button--loading');
                $('.js-flexia-load-post').append(data);
                settings.offset = parseInt(settings.offset, 10) + parseInt(settings.per_page, 10);
                if (settings.offset >= settings.posts_count) {
                    self.remove();
                }

                // Magnific Popup Re-Called for Portfolio when load more clicked.
                if (settings.is_pro_active === 'true' && settings.magnific_popup == true) {
                    flexia_magnific_popup('.flexia-magnific-popup');
                }

                if (settings.blog_layout === 'flexia_blog_content_layout_masonry') {
                    masonaryResize();
                }

            }
        });
    });

    /**
     * Magnific Popup
     */
    function flexia_magnific_popup(anchor) {
        $(anchor).magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    }
    // Magnific Popup Called for Portfolio
    if (settings.is_pro_active === 'true' && settings.magnific_popup == true) {
        flexia_magnific_popup('.flexia-magnific-popup');
    }
    // magnific Popup called for archive
    if(settings.is_pro_active === 'true' && settings.archive_magnific_popup == true) {
        flexia_magnific_popup('.flexia-magnific-popup');
    }

})(jQuery);