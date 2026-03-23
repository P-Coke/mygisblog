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
	wp_enqueue_style(
		'zqlovegis-theme-style',
		get_stylesheet_uri(),
		[],
		wp_get_theme()->get('Version')
	);
});

$zqlovegis_favicon = static function (): void {
	$favicon = get_theme_file_uri('assets/images/favicon.svg');
	echo '<link rel="icon" href="' . esc_url($favicon) . '" type="image/svg+xml" />' . "\n";
};

add_action('wp_head', $zqlovegis_favicon, 1);
add_action('admin_head', $zqlovegis_favicon, 1);
add_action('login_head', $zqlovegis_favicon, 1);

add_filter('get_site_icon_url', function ($url) {
	return get_theme_file_uri('assets/images/favicon.svg');
});
