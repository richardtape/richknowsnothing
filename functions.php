<?php
/**
 * Theme Functions File.
 *
 * @package RKN
 * @since 0.1.0
 */

add_action( 'init', 'rkn_clean_slate__init' );

/**
 * WP has a lot of initial...err...stuff even with a completely blank theme. Let's remove quite a bit
 * of that.
 *
 * @since 0.1.0
 * @return void
 */
function rkn_clean_slate__init() {

	// Remove Emoji.
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );

	// Remove EditURI as I don't use a 3rd-party editing tool.
	remove_action ( 'wp_head', 'rsd_link' );

	// Remove the manifest link.
	remove_action( 'wp_head', 'wlwmanifest_link' );

	// Remove the shortlink.
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );

	// Remove the Link header for the REST API.
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );

	// Remove oEmbed Discovery Links.
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

	// Remove WordPress.org Dns-prefetch.
	remove_action( 'wp_head', 'wp_resource_hints', 2 );

	// Remove WP Generator Tag.
	remove_action( 'wp_head', 'wp_generator' );

	// Remove default generated SkipLink. I'll have my own.
	remove_action( 'wp_footer', 'the_block_template_skip_link' );

	// disable comments feed.
	add_filter( 'feed_links_show_comments_feed', '__return_false' );

	// Remove meta robots tag.
	remove_filter( 'wp_robots', 'wp_robots_max_image_preview_large' );

	// Remove unwanted SVG filter injection WP.
	remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

	// Remove default "global" styles.
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );

	// Remove Block Style Library.
	add_action( 'wp_enqueue_scripts', 'rkn_remove_wp_block_library_css__wp_enqueue_scripts', 10 );

}//end rkn_clean_slate()


/**
 * Specifically remove the CSS that WP enqueues for the block library as we'll be starting clean.
 *
 * @since 0.1.0
 * @return void
 */
function rkn_remove_wp_block_library_css__wp_enqueue_scripts() {
	
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );

}//end rkn_remove_wp_block_library_css__wp_enqueue_scripts()


add_action( 'after_setup_theme', 'rkn_theme_support__after_setup_theme' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook.
 */
function rkn_theme_support__after_setup_theme() {

	// Add support for block styles.
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'html5', array( 'style','script', 'search-form', 'navigation-widgets' ) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'editor-font-sizes', array() );
	add_theme_support( 'custom-line-height' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-color-palette', array() );
	add_theme_support( 'editor-gradient-presets', array() );
	add_theme_support( 'custom-spacing' );
	add_theme_support( 'custom-units', array() );

	// Enqueue editor styles.
	add_editor_style( 'editor-style.css' );

}//end rkn_theme_support__after_setup_theme()

