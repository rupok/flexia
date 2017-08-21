<?php
/**
 * Flexia fcustom search form
 *
 * @package Flexia
 */
?>

<form action="<?php echo site_url();?>" class="search-form" method="get" role="search">
	<span class="screen-reader-text">Search for :</span>
	<input type="search"  title="Search for:" name="s" value="" placeholder="Search ..." class="form-control search-field">
	<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
</form>