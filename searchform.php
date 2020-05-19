<?php

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Flexia fcustom search form
 *
 * @package Flexia
 */
?>

<form action="<?php echo site_url();?>" class="search-form" method="get" role="search">
	<span class="screen-reader-text">Search for :</span>
	<input type="search"  title="Search for:" name="s" value="" placeholder="Search ..." class="form-control search-field">
	<button type="submit" class="search-submit">
		<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 448.1 448.1" style="enable-background:new 0 0 448.1 448.1;" xml:space="preserve"><path d="M438.6,393.4L334.8,289.5c21-29.9,33.3-66.3,33.3-105.5C368,82.4,285.7,0.1,184.1,0C82.5,0,0.1,82.4,0.1,184 s82.4,184,184,184c39.2,0,75.6-12.3,105.4-33.2l103.8,103.9c12.5,12.5,32.8,12.5,45.3,0C451.1,426.2,451.1,405.9,438.6,393.4z M184.1,304c-66.3,0-120-53.7-120-120s53.7-120,120-120s120,53.7,120,120C304,250.2,250.3,303.9,184.1,304z"/></svg>
	</button>
</form>