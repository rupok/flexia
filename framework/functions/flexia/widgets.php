<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function flexia_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Left', 'flexia' ),
		'id'            => 'sidebar-left',
		'description'   => esc_html__( 'Add widgets here.', 'flexia' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Right', 'flexia' ),
		'id'            => 'sidebar-right',
		'description'   => esc_html__( 'Add widgets here.', 'flexia' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Header 1', 'flexia' ),
		'id'            => 'header-1',
		'description'   => esc_html__( 'Add widgets here.', 'flexia' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Header 2', 'flexia' ),
		'id'            => 'header-2',
		'description'   => esc_html__( 'Add widgets here.', 'flexia' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Header 3', 'flexia' ),
		'id'            => 'header-3',
		'description'   => esc_html__( 'Add widgets here.', 'flexia' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Header 4', 'flexia' ),
		'id'            => 'header-4',
		'description'   => esc_html__( 'Add widgets here.', 'flexia' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'flexia' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'flexia' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'flexia' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'flexia' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'flexia' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'flexia' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'flexia' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here.', 'flexia' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'flexia_widgets_init' );