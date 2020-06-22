/**
 * Script Name: flexia-load-blog 
 */
(function($) {
	'use strict';
	if( parseInt(settings.per_page, 10) >= parseInt(settings.posts_count, 10) ) {
		$( '#load-more-post' ).remove();
    }
    
    var loadBtn = $( '#load-more-post' );
	loadBtn.on( 'click', function() {
		var self = $(this);
        // Ajax Call for Button
    
        if (settings.is_pro_active === 'true') {
            $.ajax({
                url: settings.ajax_url,
                data: {
                    action: 'load_more_post_cat',
                    postType: 'post',
                    categories: JSON.stringify( settings.selected_cats )
                },
                type: 'POST',
                success: function( data ) {
                    $( '.flexia-post-filter-control' ).html( '' ).prepend( data );
                }
            });
        }
		
		// Ajax Call for load more posts
		var data = {
			action: 			'load_more_posts',
			blogLayout: 		settings.blog_layout,
			masonryGridCols: 	settings.masonry_grid_cols,
			blogMetaPosition: 	settings.post_meta_position,
			perPage: 			settings.per_page,
			offset: 			settings.offset,
			excerptCount: 		settings.excerpt_count,
			postsCount: 		settings.posts_count,
			magnificPopup: 		settings.magnific_popup,
			showFilter: 		settings.show_filter,
			showLoadMore: 		settings.show_load_more,
			loadMoreText: 		settings.load_more_text,
			loadingText: 		settings.loading_text,
			categories: 		JSON.stringify( settings.selected_cats )
		};
		$.ajax({
			url: settings.ajax_url,
			data: data,
			type: 'POST',
			beforeSend: function( e ) {
				self.addClass( 'button--loading' );
				self.find( 'span' ).html( settings.loading_text );
			},
			success: function( data ) {

				self.find( 'span' ).html( settings.load_more_text );
				self.removeClass( 'button--loading' );
				$('.js-flexia-load-post').append( data );
				settings.offset = parseInt( settings.offset, 10 ) + parseInt( settings.per_page, 10 );
				if( settings.offset >= settings.posts_count ) {
					self.remove();
				}

				// Magnific Popup Re-Called for Portfolio when load more clicked.
				if( settings.magnific_popup == true ) {
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
	function flexia_magnific_popup( anchor ) {
		$( anchor ).magnificPopup({
			type: 'image',
			gallery: {
				enabled: true
			}
		});
	}
	// Magnific Popup Called for Portfolio
	if( settings.magnific_popup == true ) {
		flexia_magnific_popup('.flexia-magnific-popup');
	}

})(jQuery);