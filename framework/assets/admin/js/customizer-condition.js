(function ($) {
	'use strict';
	/**
	 * Run function when customizer is ready.
	 */
	function customizer_controls_show(setting,controler_name,controler_val){
		wp.customize.control( controler_name, function( control ) { 
			var controler_array = controler_val.split(',');
			var visibility = function() {
				if ( $.inArray(setting.get(), controler_array) > -1 ) {
					control.container.slideDown( 180 );
				} else {
					control.container.slideUp( 180 );
				}
			};           
			visibility();         
			setting.bind( visibility ); 
		});	
	}

	function customizer_controls_hide(setting,controler_name,controler_val){
		wp.customize.control( controler_name, function( control ) {
			var controler_array = controler_val.split(',');
			var visibility = function() {
				if ( $.inArray(setting.get(), controler_array) > -1 ) {
					control.container.slideUp( 180 );
				} else {
					control.container.slideDown( 180 );
				}
			};   
			visibility();   
			setting.bind( visibility ); 
		});	
	}

	function customizer_conditional_setting_return_toggle(setting,controler_name,controler_val){
		wp.customize.control( controler_name, function( control ) { 
			var visibility = function() {
				if ( setting.get() == true ) { 
					control.container.slideDown( 180 );     
				} else {
					control.container.slideUp( 180 );
				}
			};           
			visibility();         
			setting.bind( visibility ); 
		});	
	}

	

	$(document).ready(function () {
		wp.customize.bind( 'ready', function() {
			var dimensionReset  = jQuery('.flexia-dimension .flexia-customizer-reset');
			dimensionReset.each(function() {
				$(dimensionReset).on( 'click', function (e) {
					e.preventDefault();
					var dimensionId = $(this).parent('.flexia-dimension').attr('id');
					$('.'+dimensionId).each(function() {
						var dimensionDefaultVal = $(this).data('default-val');
						$(this).val(dimensionDefaultVal).trigger('change');
					});
				});
			});
			var selectReset  = jQuery('.flexia-select .flexia-customizer-reset');
			selectReset.each(function() {
				$(selectReset).on( 'click', function (e) {
					e.preventDefault();
					var dimensionId = $(this).parent('.flexia-select').attr('id');
					$('.'+dimensionId).each(function() {
						var dimensionDefaultVal = $(this).data('default-val');
						$(this).val(dimensionDefaultVal).change().trigger('change');
					});
				});
			});

			wp.customize( 'site_background_image_enable_button', function( setting ) {
				customizer_conditional_setting_return_toggle(setting,'site_background_image',true);
				customizer_conditional_setting_return_toggle(setting,'site_background_property',true);
				customizer_conditional_setting_return_toggle(setting,'site_background_image_size',true);
				customizer_conditional_setting_return_toggle(setting,'site_background_image_position',true);
				customizer_conditional_setting_return_toggle(setting,'site_background_image_repeat',true);
				customizer_conditional_setting_return_toggle(setting,'site_background_image_attachment',true);
			});			
		});
	});
})(jQuery);