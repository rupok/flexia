<?php

/**
 * This method will generate blog layout based on theme customizer option
 * Hooked: 'flexia_blog_layout' 
 * @since  v1.0.1
 */
function flexia_blog_layout()
{
	/**
	 * Customizer Values
	 */
	$flexia_blog_per_page			= flexia_get_option('flexia_blog_per_page');
	$flexia_blog_layout 			= flexia_get_option('flexia_blog_content_layout');
	$flexia_blog_grid_cols 			= flexia_get_option('flexia_blog_grid_column');
	$flexia_blog_excerpt_count 		= flexia_get_option('flexia_blog_excerpt_count');

	$flexia_blog_post_meta 			= 'meta-on-bottom';
	$flexia_magnific_popup 			= false;
	$flexia_show_filter 			= false;
	$flexia_blog_categories			= '';

	if (class_exists('Flexia_Pro')) {
		$flexia_blog_post_meta 			= flexia_pro_get_option('flexia_blog_post_meta');
		$flexia_magnific_popup 			= flexia_pro_get_option('flexia_blog_image_popup');
		$flexia_show_filter 			= flexia_pro_get_option('flexia_blog_filterable');
		$flexia_blog_categories			= get_theme_mod('flexia_blog_categories', '');
	}

?>

	<?php
	/**
	 * If Flex Layout Selected
	 */
	if ('flexia_blog_content_layout_grid' === $flexia_blog_layout) : ?>
		<div class="flexia-post-grid flexia-post-block">
			<?php if (class_exists('Flexia_Pro') && $flexia_show_filter == true && !empty($flexia_blog_categories)) : ?>
				<div class="flexia-post-filter-control">
					<?php if (!empty($flexia_blog_categories)) : ?>
						<button class="button control is-checked" data-filter="*"><?php _e('All', 'flexia'); ?></button>
					<?php endif ?>
					<?php
					// Post Arguments
					$args = [
						'post_type' => 'post',
						'post_status' => 'publish',
						'posts_per_page' => $flexia_blog_per_page,
						'tax_query' => array(
							array(
								'taxonomy' => 'category',
								'field'    => 'slug',
								'terms'    => $flexia_blog_categories,
							),
						),
					];

					// Init WP_Query
					$posts = new WP_Query($args);

					// Loop Begins
					while ($posts->have_posts()) : $posts->the_post();
						$terms = get_the_category();
						foreach ($terms as $term) :
							$term_unique_name[] = $term->name;
							$term_unique_slug[] = $term->slug;
						endforeach;
					endwhile;
					// Removing repeated categories
					$term_unique_name = array_values(array_unique($term_unique_name));
					$term_unique_slug = array_values(array_unique($term_unique_slug));

					// Looping through and choose those categories that comes with the post loop.
					for ($i = 0; $i < count($term_unique_name); $i++) {
						if (in_array($term_unique_slug[$i], (array)$flexia_blog_categories)) {
							echo '<button class="button control" data-filter="' . $term_unique_slug[$i] . '">' . $term_unique_name[$i] . '</button>';
						}
					}
					?>
				</div>
			<?php endif; ?>

			<div class="js-flexia-load-post flexia-post-block-grid flexia-col-<?php echo $flexia_blog_grid_cols; ?>">
				<?php
				if (!empty($flexia_blog_categories)) {
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$args = [
						'paged'           => $paged,
						'post_type' => 'post',
						'post_status' => 'publish',
						'posts_per_page' => $flexia_blog_per_page,
						'tax_query' => array(
							array(
								'taxonomy' => 'category',
								'field'    => 'slug',
								'terms'    => $flexia_blog_categories,
							),
						),
					];
				} else {
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$args = [
						'paged'           => $paged,
						'post_type' => 'post',
						'post_status' => 'publish',
						'posts_per_page' => $flexia_blog_per_page,
					];
				}

				$loop = new WP_Query($args);
				while ($loop->have_posts()) : $loop->the_post();
					$terms = get_the_category();
					$categories_list = get_the_category_list(esc_html__(', ', 'flexia'));

				?>
					<article class="flexia-post-block-item flexia-post-block-column <?php foreach ($terms as $term) : echo $term->slug . ' ';
																					endforeach; ?>">
						<div class="flexia-post-block-item-holder">
							<div class="flexia-post-block-item-holder-inner">
								<div class="flexia-entry-media">
									<div class="flexia-entry-overlay">
										<?php if (has_post_thumbnail()) : ?>
											<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
												<g>
													<g>
														<path d="M506.134,241.843c-0.006-0.006-0.011-0.013-0.018-0.019l-104.504-104c-7.829-7.791-20.492-7.762-28.285,0.068 c-7.792,7.829-7.762,20.492,0.067,28.284L443.558,236H20c-11.046,0-20,8.954-20,20c0,11.046,8.954,20,20,20h423.557 l-70.162,69.824c-7.829,7.792-7.859,20.455-0.067,28.284c7.793,7.831,20.457,7.858,28.285,0.068l104.504-104 c0.006-0.006,0.011-0.013,0.018-0.019C513.968,262.339,513.943,249.635,506.134,241.843z" />
													</g>
												</g>
												<g> </g>
												<g> </g>
												<g> </g>
												<g> </g>
												<g> </g>
												<g> </g>
												<g> </g>
												<g> </g>
												<g> </g>
												<g> </g>
												<g> </g>
												<g> </g>
												<g> </g>
												<g> </g>
												<g> </g>
											</svg>
										<?php endif; ?>
										<?php if ($flexia_magnific_popup == true) : ?>
											<a href="<?php echo esc_url(the_post_thumbnail_url()); ?>" class="flexia-magnific-popup"></a>
										<?php else : ?>
											<a href="<?php the_permalink(); ?>"></a>
										<?php endif; ?>
									</div>
									<?php if (has_post_thumbnail()) : ?>
										<div class="flexia-entry-thumbnail">
											<?php the_post_thumbnail('full'); ?>
										</div>
									<?php endif; ?>
								</div>
								<div class="flexia-entry-wrapper">
									<header class="flexia-entry-header">
										<h2 class="flexia-entry-title"><a class="flexia-grid-post-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
										<?php
										/**
										 * If Meta On Top Selected
										 */
										if ('meta-on-top' === $flexia_blog_post_meta) : ?>
											<div class="flexia-entry-meta">
												<span class="flexia-posted-by"><?php the_author_posts_link(); ?></span>
												<span class="flexia-posted-on"><time datetime="<?php echo get_the_date(); ?>"><?php echo get_the_date(); ?></time></span>
											</div>
										<?php endif; ?>
									</header>
									<div class="flexia-entry-content">
										<div class="flexia-grid-post-excerpt">
											<?php
											$content = get_the_excerpt();
											$trimmed_content = wp_trim_words($content, $flexia_blog_excerpt_count);
											echo $trimmed_content;
											?>
										</div>
									</div>
								</div>
								<?php
								/**
								 * If Meta On Bottom Selected
								 */
								if ('meta-on-bottom' === $flexia_blog_post_meta) : ?>
									<div class="flexia-entry-footer">
										<div class="flexia-author-avatar">
											<a href="<?php echo get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename')); ?>"><?php echo get_avatar(get_the_author_meta('ID'), 96); ?> </a>
										</div>
										<div class="flexia-entry-meta">
											<div class="flexia-posted-by"><?php the_author_posts_link(); ?></div>
											<div class="flexia-posted-on">
												<time datetime="<?php echo get_the_date(); ?>"><?php echo get_the_date(); ?></time>
											</div>
										</div>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</article>
				<?php endwhile; ?>

			</div>

		</div>

	<?php elseif ('flexia_blog_content_layout_masonry' === $flexia_blog_layout && !class_exists('Flexia_Pro')) : ?>

		<h2>Masonry Layout is availbale on <a href="https://flexia.pro/">Flexia Pro</a></h2>

	<?php endif; ?>



	<?php
}
add_action('flexia_blog_layout', 'flexia_blog_layout', 2);


//Show Load More Button
function flexia_load_more_button()
{
	$flexia_show_load_more 			= flexia_get_option('flexia_blog_load_more');
	$flexia_load_more_text 			= flexia_get_option('flexia_blog_load_more_text');

	if ($flexia_show_load_more) : ?>
		<div class="flexia-load-more-button-wrap">
			<button id="load-more-post" class="flexia-load-more-button">
				<div class="flexia-btn-loader button__loader"></div>
				<span><?php echo $flexia_load_more_text; ?></span>
			</button>
		</div>
	<?php endif; ?>
	<?php
}
add_action('flexia_blog_layout', 'flexia_load_more_button', 5);


/**
 * This method is used with ajax call for load more portfolios
 * Hooked: 'wp_ajax_load_more_posts'
 * @since   v1.0.0
 */
function flexia_pro_load_more_posts()
{
	/**
	 * Localized Values
	 */
	$flexia_blog_per_page 			= $_POST['perPage'];
	$flexia_blog_offset 			= $_POST['offset'];
	$flexia_blog_layout 			= $_POST['blogLayout'];
	$flexia_blog_grid_cols 			= $_POST['masonryGridCols'];
	$flexia_blog_post_meta_position = $_POST['blogMetaPosition'];
	$flexia_blog_excerpt_count 		= $_POST['excerptCount'];
	$flexia_magnific_popup 			= $_POST['magnificPopup'];
	$flexia_show_filter 			= $_POST['showFilter'];
	$flexia_show_load_more 			= $_POST['showLoadMore'];
	$flexia_load_more_text 			= $_POST['loadMoreText'];
	$flexia_loading_text 			= $_POST['loadingText'];
	$flexia_blog_categories    		= json_decode(stripslashes($_POST['categories']));

	/**
	 * Post Arguments
	 */
	global $post;

	$tax_query_args = "";
	if (!empty($flexia_blog_categories)) {
		$tax_query_args = array(
			'taxonomy' => 'category',
			'field' => 'slug',
			'terms' => $flexia_blog_categories,
		);
	}
	$args = [
		'post_type' 		=> 'post',
		'post_status' 		=> 'publish',
		'posts_per_page' 	=> $flexia_blog_per_page,
		'offset' 			=> isset($flexia_blog_offset) ? $flexia_blog_offset : 0,
		'tax_query' => array(
			$tax_query_args,
		),
	];

	/**
	 * Init WP_Query
	 */
	$posts = new WP_Query($args);

	/**
	 * Init WP_Query
	 */
	while ($posts->have_posts()) : $posts->the_post();
		$terms = get_the_category();
		$categories_list = get_the_category_list(esc_html__(', ', 'flexia'));
	?>
		<?php if ('flexia_blog_content_layout_masonry' === $flexia_blog_layout) : ?>
			<div class="flexia-grid-post flexia-post-grid-column  <?php foreach ($terms as $term) : echo $term->slug . ' ';
																	endforeach; ?>">
				<div class="flexia-grid-post-holder">
					<div class="flexia-grid-post-holder-inner">
						<div class="flexia-entry-media">
							<div class="flexia-entry-overlay">
								<?php if (has_post_thumbnail()) : ?>
									<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
										<g>
											<g>
												<path d="M506.134,241.843c-0.006-0.006-0.011-0.013-0.018-0.019l-104.504-104c-7.829-7.791-20.492-7.762-28.285,0.068 c-7.792,7.829-7.762,20.492,0.067,28.284L443.558,236H20c-11.046,0-20,8.954-20,20c0,11.046,8.954,20,20,20h423.557 l-70.162,69.824c-7.829,7.792-7.859,20.455-0.067,28.284c7.793,7.831,20.457,7.858,28.285,0.068l104.504-104 c0.006-0.006,0.011-0.013,0.018-0.019C513.968,262.339,513.943,249.635,506.134,241.843z" />
											</g>
										</g>
										<g> </g>
										<g> </g>
										<g> </g>
										<g> </g>
										<g> </g>
										<g> </g>
										<g> </g>
										<g> </g>
										<g> </g>
										<g> </g>
										<g> </g>
										<g> </g>
										<g> </g>
										<g> </g>
										<g> </g>
									</svg>
								<?php endif; ?>
								<?php if ($flexia_magnific_popup == true) : ?>
									<a href="<?php echo esc_url(the_post_thumbnail_url()); ?>" class="flexia-magnific-popup"></a>
								<?php else : ?>
									<a href="<?php the_permalink(); ?>"></a>
								<?php endif; ?>
							</div>
							<?php if (has_post_thumbnail()) : ?>
								<div class="flexia-entry-thumbnail">
									<?php the_post_thumbnail('full'); ?>
								</div>
							<?php endif; ?>
						</div>
						<div class="flexia-entry-wrapper">
							<header class="flexia-entry-header">
								<h2 class="flexia-entry-title"><a class="flexia-grid-post-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
								<?php
								/**
								 * If Meta On Top Selected
								 */
								if ('meta-on-top' === $flexia_blog_post_meta_position) : ?>
									<div class="flexia-entry-meta">
										<span class="flexia-posted-by"><?php the_author_posts_link(); ?></span>
										<span class="flexia-posted-on"><time datetime="<?php echo get_the_date(); ?>"><?php echo get_the_date(); ?></time></span>
									</div>
								<?php endif; ?>
							</header>
							<div class="flexia-entry-content">
								<div class="flexia-grid-post-excerpt">
									<?php
									$content = get_the_excerpt();
									$trimmed_content = wp_trim_words($content, $flexia_blog_excerpt_count);
									echo $trimmed_content;
									?>
								</div>
							</div>
						</div>
						<?php
						/**
						 * If Meta On Bottom Selected
						 */
						if ('meta-on-bottom' === $flexia_blog_post_meta_position) : ?>
							<div class="flexia-entry-footer">
								<div class="flexia-author-avatar">
									<a href="<?php echo get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename')); ?>"><?php echo get_avatar(get_the_author_meta('ID'), 96); ?> </a>
								</div>
								<div class="flexia-entry-meta">
									<div class="flexia-posted-by"><?php the_author_posts_link(); ?></div>
									<div class="flexia-posted-on">
										<time datetime="<?php echo get_the_date(); ?>"><?php echo get_the_date(); ?></time>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if ('flexia_blog_content_layout_grid' === $flexia_blog_layout) : ?>
			<article class="flexia-post-block-item flexia-post-block-column <?php foreach ($terms as $term) : echo $term->slug . ' ';
																			endforeach; ?>">
				<div class="flexia-post-block-item-holder">
					<div class="flexia-post-block-item-holder-inner">
						<div class="flexia-entry-media">
							<div class="flexia-entry-overlay">
								<?php if (has_post_thumbnail()) : ?>
									<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
										<g>
											<g>
												<path d="M506.134,241.843c-0.006-0.006-0.011-0.013-0.018-0.019l-104.504-104c-7.829-7.791-20.492-7.762-28.285,0.068 c-7.792,7.829-7.762,20.492,0.067,28.284L443.558,236H20c-11.046,0-20,8.954-20,20c0,11.046,8.954,20,20,20h423.557 l-70.162,69.824c-7.829,7.792-7.859,20.455-0.067,28.284c7.793,7.831,20.457,7.858,28.285,0.068l104.504-104 c0.006-0.006,0.011-0.013,0.018-0.019C513.968,262.339,513.943,249.635,506.134,241.843z" />
											</g>
										</g>
										<g> </g>
										<g> </g>
										<g> </g>
										<g> </g>
										<g> </g>
										<g> </g>
										<g> </g>
										<g> </g>
										<g> </g>
										<g> </g>
										<g> </g>
										<g> </g>
										<g> </g>
										<g> </g>
										<g> </g>
									</svg>
								<?php endif; ?>
								<?php if ($flexia_magnific_popup == true) : ?>
									<a href="<?php echo esc_url(the_post_thumbnail_url()); ?>" class="flexia-magnific-popup"></a>
								<?php else : ?>
									<a href="<?php the_permalink(); ?>"></a>
								<?php endif; ?>
							</div>
							<?php if (has_post_thumbnail()) : ?>
								<div class="flexia-entry-thumbnail">
									<?php the_post_thumbnail('full'); ?>
								</div>
							<?php endif; ?>
						</div>
						<div class="flexia-entry-wrapper">
							<header class="flexia-entry-header">
								<h2 class="flexia-entry-title"><a class="flexia-grid-post-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
								<?php
								/**
								 * If Meta On Top Selected
								 */
								if ('meta-on-top' === $flexia_blog_post_meta_position) : ?>
									<div class="flexia-entry-meta">
										<span class="flexia-posted-by"><?php the_author_posts_link(); ?></span>
										<span class="flexia-posted-on"><time datetime="<?php echo get_the_date(); ?>"><?php echo get_the_date(); ?></time></span>
									</div>
								<?php endif; ?>
							</header>
							<div class="flexia-entry-content">
								<div class="flexia-grid-post-excerpt">
									<?php
									$content = get_the_excerpt();
									$trimmed_content = wp_trim_words($content, $flexia_blog_excerpt_count);
									echo $trimmed_content;
									?>
								</div>
							</div>
						</div>
						<?php
						/**
						 * If Meta On Bottom Selected
						 */
						if ('meta-on-bottom' === $flexia_blog_post_meta_position) : ?>
							<div class="flexia-entry-footer">
								<div class="flexia-author-avatar">
									<a href="<?php echo get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename')); ?>"><?php echo get_avatar(get_the_author_meta('ID'), 96); ?> </a>
								</div>
								<div class="flexia-entry-meta">
									<div class="flexia-posted-by"><?php the_author_posts_link(); ?></div>
									<div class="flexia-posted-on">
										<time datetime="<?php echo get_the_date(); ?>"><?php echo get_the_date(); ?></time>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</article>
		<?php endif; ?>
	<?php
	endwhile;
	die();
	// End of Loop
}
add_action('wp_ajax_load_more_posts', 'flexia_pro_load_more_posts');


// /**
//  * This method will generate archive layout based on theme customizer option
//  * Hooked: 'flexia_archive_layout' 
//  * @since  v1.0.1
//  */
// function flexia_archive_layout()
// {
// 	/**
// 	 * Customizer Values
// 	 */
// 	$flexia_archive_per_page			= flexia_get_option('flexia_archive_per_page');
// 	$flexia_archive_layout 				= flexia_get_option('flexia_archive_content_layout');
// 	$flexia_archive_grid_cols 			= flexia_get_option('flexia_archive_grid_column');
// 	$flexia_archive_excerpt_count 		= flexia_get_option('flexia_archive_excerpt_count');

// 	$flexia_archive_post_meta 			= 'meta-on-bottom';
// 	$flexia_magnific_popup 				= false;

// 	if (class_exists('Flexia_Pro')) {
// 		$flexia_archive_post_meta 		= flexia_pro_get_option('flexia_pro_archive_post_meta');
// 		$flexia_magnific_popup 			= flexia_pro_get_option('flexia_pro_archive_image_popup');
// 	}

// 	/**
// 	 * If Flex Layout Selected
// 	 */
// 	if ('flexia_blog_content_layout_grid' === $flexia_archive_layout) : ?>
// 		<div class="flexia-post-grid flexia-post-block">

// 			<div class="js-flexia-load-post flexia-post-block-grid flexia-col-<?php echo $flexia_archive_grid_cols; ?>">
// 				<?php
// 				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
// 				$args = [
// 					'paged'           => $paged,
// 					'post_type' => 'post',
// 					'post_status' => 'publish',
// 					'posts_per_page' => $flexia_archive_per_page,
// 				];

// 				$loop = new WP_Query($args);
// 				while ($loop->have_posts()) : $loop->the_post();
// 					$terms = get_the_category();
// 					$categories_list = get_the_category_list(esc_html__(', ', 'flexia'));

// 				?>
// 					<article class="flexia-post-block-item flexia-post-block-column <?php foreach ($terms as $term) : echo $term->slug . ' ';
// 																					endforeach; ?>">
// 						<div class="flexia-post-block-item-holder">
// 							<div class="flexia-post-block-item-holder-inner">
// 								<div class="flexia-entry-media">
// 									<div class="flexia-entry-overlay">
// 										<?php if (has_post_thumbnail()) : ?>
// 											<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
// 												<g>
// 													<g>
// 														<path d="M506.134,241.843c-0.006-0.006-0.011-0.013-0.018-0.019l-104.504-104c-7.829-7.791-20.492-7.762-28.285,0.068 c-7.792,7.829-7.762,20.492,0.067,28.284L443.558,236H20c-11.046,0-20,8.954-20,20c0,11.046,8.954,20,20,20h423.557 l-70.162,69.824c-7.829,7.792-7.859,20.455-0.067,28.284c7.793,7.831,20.457,7.858,28.285,0.068l104.504-104 c0.006-0.006,0.011-0.013,0.018-0.019C513.968,262.339,513.943,249.635,506.134,241.843z" />
// 													</g>
// 												</g>
// 												<g> </g>
// 												<g> </g>
// 												<g> </g>
// 												<g> </g>
// 												<g> </g>
// 												<g> </g>
// 												<g> </g>
// 												<g> </g>
// 												<g> </g>
// 												<g> </g>
// 												<g> </g>
// 												<g> </g>
// 												<g> </g>
// 												<g> </g>
// 												<g> </g>
// 											</svg>
// 										<?php endif; ?>
// 										<?php if ($flexia_magnific_popup == true) : ?>
// 											<a href="<?php echo esc_url(the_post_thumbnail_url()); ?>" class="flexia-magnific-popup"></a>
// 										<?php else : ?>
// 											<a href="<?php the_permalink(); ?>"></a>
// 										<?php endif; ?>
// 									</div>
// 									<?php if (has_post_thumbnail()) : ?>
// 										<div class="flexia-entry-thumbnail">
// 											<?php the_post_thumbnail('full'); ?>
// 										</div>
// 									<?php endif; ?>
// 								</div>
// 								<div class="flexia-entry-wrapper">
// 									<header class="flexia-entry-header">
// 										<h2 class="flexia-entry-title"><a class="flexia-grid-post-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
// 										<?php
// 										/**
// 										 * If Meta On Top Selected
// 										 */
// 										if ('meta-on-top' === $flexia_archive_post_meta) : ?>
// 											<div class="flexia-entry-meta">
// 												<span class="flexia-posted-by"><?php the_author_posts_link(); ?></span>
// 												<span class="flexia-posted-on"><time datetime="<?php echo get_the_date(); ?>"><?php echo get_the_date(); ?></time></span>
// 											</div>
// 										<?php endif; ?>
// 									</header>
// 									<div class="flexia-entry-content">
// 										<div class="flexia-grid-post-excerpt">
// 											<?php
// 											$content = get_the_excerpt();
// 											$trimmed_content = wp_trim_words($content, $flexia_archive_excerpt_count);
// 											echo $trimmed_content;
// 											?>
// 										</div>
// 									</div>
// 								</div>
// 								<?php
// 								/**
// 								 * If Meta On Bottom Selected
// 								 */
// 								if ('meta-on-bottom' === $flexia_archive_post_meta) : ?>
// 									<div class="flexia-entry-footer">
// 										<div class="flexia-author-avatar">
// 											<a href="<?php echo get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename')); ?>"><?php echo get_avatar(get_the_author_meta('ID'), 96); ?> </a>
// 										</div>
// 										<div class="flexia-entry-meta">
// 											<div class="flexia-posted-by"><?php the_author_posts_link(); ?></div>
// 											<div class="flexia-posted-on">
// 												<time datetime="<?php echo get_the_date(); ?>"><?php echo get_the_date(); ?></time>
// 											</div>
// 										</div>
// 									</div>
// 								<?php endif; ?>
// 							</div>
// 						</div>
// 					</article>
// 				<?php endwhile; ?>

// 			</div>

// 		</div>

// 	<?php elseif ('flexia_blog_content_layout_masonry' === $flexia_archive_layout && !class_exists('Flexia_Pro')) : ?>

// 		<h2>Masonry Layout is availbale on <a href="https://flexia.pro/">Flexia Pro</a></h2>

// 	<?php endif; ?>

// 	<?php
// }
// add_action('flexia_archive_layout', 'flexia_archive_layout', 2);

// /**
//  * Show load more button on archive page
//  */
// function flexia_archive_load_more_button()
// {
// 	$flexia_show_load_more 			= flexia_get_option('flexia_archive_load_more');
// 	$flexia_load_more_text 			= flexia_get_option('flexia_archive_load_more_text');

// 	if ($flexia_show_load_more) : ?>
// 		<div class="flexia-load-more-button-wrap">
// 			<button id="load-more-post" class="flexia-load-more-button">
// 				<div class="flexia-btn-loader button__loader"></div>
// 				<span><?php echo $flexia_load_more_text; ?></span>
// 			</button>
// 		</div>
// 	<?php endif; ?>
// <?php
// }
// add_action('flexia_archive_layout', 'flexia_archive_load_more_button', 5);