<?php

if (!defined('ABSPATH')) {
	exit;
}

add_action('after_setup_theme', function () {
	add_theme_support('wp-block-styles');
	add_theme_support('responsive-embeds');
	add_theme_support('editor-styles');
	add_editor_style('style.css');
	add_theme_support('post-thumbnails');
});

add_action('wp_enqueue_scripts', function () {
	$style_path = get_theme_file_path('style.css');
	$style_version = file_exists($style_path) ? (string) filemtime($style_path) : wp_get_theme()->get('Version');

	wp_enqueue_style(
		'zqlovegis-theme-style',
		get_stylesheet_uri(),
		[],
		$style_version
	);
});

add_filter('get_site_icon_url', function ($url) {
	return get_theme_file_uri('assets/images/favicon.svg');
});
