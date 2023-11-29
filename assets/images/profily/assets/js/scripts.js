var profily_ready = (callback) => {
    if (document.readyState != "loading") callback();
    else document.addEventListener("DOMContentLoaded", callback);
}

profily_ready(() => { 
    const is_reduced_motion = window.matchMedia(`(prefers-reduced-motion: reduce)`) === true || window.matchMedia(`(prefers-reduced-motion: reduce)`).matches === true;
    if( is_reduced_motion ) {
        console.info( "%cBased on the accessibility settings of your operating system, this website has limited animations.", 'font-weight: bold' );
    }

    /*
    ** Navigation - Fullscreen dropdown collapse
    */
    var navigation_items = document.querySelectorAll('.wp-block-navigation-submenu__toggle');
    if( navigation_items ) {
        navigation_items.forEach( item => {
            item.addEventListener("click", ( item2 ) => {
                item2.target.previousSibling.classList.toggle('is-menu-open');
                item2.target.nextSibling.classList.toggle('is-menu-open');
            });
        });
    }

    /*
    ** Mobile navigation menu and X syncer
    */
    var navigation_icons = document.querySelectorAll('.wp-block-navigation__responsive-container-open');
    if( navigation_icons ) {
        navigation_icons.forEach( item => {
            item.addEventListener("click", () => {
                var top = item.getBoundingClientRect().top;
                document.querySelector('.wp-block-navigation__responsive-dialog').style.paddingTop = ( top ) + 'px';
                if( top > 40 ) {
                    document.querySelector('.wp-block-navigation__responsive-container-close').style.top = top + 'px';
                }
            });
        });
    }


});