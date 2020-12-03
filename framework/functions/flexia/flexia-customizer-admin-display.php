<?php

/**
 * @link       https://www.codetic.net
 * @since      2.2.0
 *
 * @package    Flexia
 */


// write header script

function flexia_add_custom_js_in_wp_head() {
	$flexia_header_script = get_theme_mod('flexia_header_script', '');

	if ( ! empty( $flexia_header_script)) { ?>
	<script type="text/javascript">
		/* <![CDATA[ */
			<?php echo $flexia_header_script; ?>
		/* ]]> */
	</script>
	<?php }

}
add_action( 'wp_head', 'flexia_add_custom_js_in_wp_head' );


// write footer script

function flexia_add_custom_js_in_wp_footer() {
	$flexia_footer_script = get_theme_mod('flexia_footer_script', '');
	
	if (! empty( $flexia_footer_script)) { ?>
	<script type="text/javascript">
		/* <![CDATA[ */
			<?php echo $flexia_footer_script; ?>
		/* ]]> */
	</script>
	<?php }

}
add_action( 'wp_footer', 'flexia_add_custom_js_in_wp_footer' );

// write Google Analytics script

function flexia_add_ga_script_in_wp_footer() {
	$flexia_ga_script = get_theme_mod('flexia_ga_script', '');

	if (! empty( $flexia_ga_script)) {
		echo $flexia_ga_script;
	}

}
add_action( 'wp_footer', 'flexia_add_ga_script_in_wp_footer' );
