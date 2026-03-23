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

function zqlovegis_render_icon(string $name): string
{
	$icons = [
		'github' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M12 2C6.477 2 2 6.486 2 12.018c0 4.426 2.865 8.18 6.839 9.504.5.093.682-.217.682-.483 0-.237-.008-.866-.013-1.7-2.782.605-3.369-1.344-3.369-1.344-.455-1.157-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.071 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.091-.647.35-1.088.636-1.338-2.221-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.987 1.029-2.687-.103-.253-.446-1.272.098-2.651 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0 1 12 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.026 2.747-1.026.546 1.379.203 2.398.1 2.651.64.7 1.028 1.594 1.028 2.687 0 3.848-2.338 4.695-4.566 4.943.359.31.678.922.678 1.858 0 1.341-.013 2.422-.013 2.752 0 .269.18.581.688.482A10.02 10.02 0 0 0 22 12.018C22 6.486 17.523 2 12 2Z"/></svg>',
		'email'  => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M3 5.75A2.75 2.75 0 0 1 5.75 3h12.5A2.75 2.75 0 0 1 21 5.75v12.5A2.75 2.75 0 0 1 18.25 21H5.75A2.75 2.75 0 0 1 3 18.25V5.75Zm2.2.25 6.8 5.44L18.8 6H5.2Zm13.05 1.4-5.63 4.5a1 1 0 0 1-1.24 0L5.75 7.4v10.85c0 .414.336.75.75.75h11a.75.75 0 0 0 .75-.75V7.4Z"/></svg>',
	];

	return $icons[$name] ?? '';
}

function zqlovegis_render_site_header(string $current = ''): void
{
	$about_url = home_url('/about/');
	$articles_url = home_url('/#articles');
	$github_url = 'https://github.com/P-Coke';
	?>
	<header class="paper-site-header">
		<div class="paper-site-header__inner">
			<div class="paper-site-brand">
				<p class="paper-site-brand__title">山河与像素</p>
				<p class="paper-site-brand__subtitle">在卫星、地图与代码之间慢慢写</p>
			</div>
			<nav class="paper-site-nav" aria-label="<?php esc_attr_e('Primary navigation', 'zqlovegis-theme'); ?>">
				<a class="<?php echo $current === 'home' ? 'is-active' : ''; ?>" href="<?php echo esc_url(home_url('/')); ?>">首页</a>
				<a class="<?php echo $current === 'about' ? 'is-active' : ''; ?>" href="<?php echo esc_url($about_url); ?>">关于</a>
				<a class="<?php echo $current === 'articles' ? 'is-active' : ''; ?>" href="<?php echo esc_url($articles_url); ?>">文章</a>
				<a href="<?php echo esc_url($github_url); ?>" target="_blank" rel="noreferrer">GitHub</a>
			</nav>
		</div>
	</header>
	<?php
}

function zqlovegis_render_site_footer(): void
{
	$github_url = 'https://github.com/P-Coke';
	?>
	<footer class="paper-site-footer">
		<div class="paper-site-footer__inner">
			<p>这里就是一个慢慢更新的个人博客。写得不会特别快，但基本都会是我自己真的做过、想过、折腾过的东西。</p>
			<div class="paper-site-footer__links">
				<a href="<?php echo esc_url($github_url); ?>" target="_blank" rel="noreferrer">GitHub</a>
				<a href="mailto:hello@zqlovegis.cn">Email</a>
			</div>
		</div>
	</footer>
	<?php
}
