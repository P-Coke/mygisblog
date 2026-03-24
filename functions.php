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

	if (is_front_page()) {
		wp_enqueue_style(
			'zqlovegis-leaflet',
			'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css',
			[],
			'1.9.4'
		);

		wp_enqueue_script(
			'zqlovegis-leaflet',
			'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js',
			[],
			'1.9.4',
			true
		);

		wp_enqueue_script(
			'zqlovegis-hero-map',
			get_theme_file_uri('assets/js/hero-map.js'),
			['zqlovegis-leaflet'],
			$style_version,
			true
		);
	}
});

function zqlovegis_get_favicon_url(): string
{
	$path = get_theme_file_path('assets/images/favicon.svg');
	$uri = get_theme_file_uri('assets/images/favicon.svg');
	$version = file_exists($path) ? (string) filemtime($path) : wp_get_theme()->get('Version');

	return add_query_arg('v', $version, $uri);
}

add_filter('get_site_icon_url', function ($url) {
	return zqlovegis_get_favicon_url();
});

add_filter('document_title_parts', function ($parts) {
	$brand = '山河与像素';

	if (is_front_page()) {
		return ['title' => $brand];
	}

	$parts['site'] = $brand;

	return $parts;
});

function zqlovegis_get_github_profile(): array
{
	$fallback = [
		'login'      => 'P-Coke',
		'name'       => 'Pcoke',
		'bio'        => '在卫星、地图与代码之间慢慢写。',
		'html_url'   => 'https://github.com/P-Coke',
		'avatar_url' => 'https://github.com/P-Coke.png?size=240',
	];

	$cached = get_transient('zqlovegis_github_profile');

	if (is_array($cached) && !empty($cached['html_url'])) {
		return array_merge($fallback, $cached);
	}

	$response = wp_remote_get(
		'https://api.github.com/users/P-Coke',
		[
			'timeout' => 12,
			'headers' => [
				'Accept'     => 'application/vnd.github+json',
				'User-Agent' => 'zqlovegis-theme',
			],
		]
	);

	if (is_wp_error($response)) {
		return $fallback;
	}

	$payload = json_decode((string) wp_remote_retrieve_body($response), true);

	if (!is_array($payload) || empty($payload['html_url'])) {
		return $fallback;
	}

	$profile = [
		'login'      => $payload['login'] ?? $fallback['login'],
		'name'       => $payload['name'] ?: $fallback['name'],
		'bio'        => $payload['bio'] ?: $fallback['bio'],
		'html_url'   => $payload['html_url'] ?? $fallback['html_url'],
		'avatar_url' => !empty($payload['avatar_url']) ? add_query_arg('size', '240', $payload['avatar_url']) : $fallback['avatar_url'],
	];

	set_transient('zqlovegis_github_profile', $profile, 12 * HOUR_IN_SECONDS);

	return $profile;
}

function zqlovegis_render_icon(string $name): string
{
	$icons = [
		'github' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M12 2C6.477 2 2 6.486 2 12.018c0 4.426 2.865 8.18 6.839 9.504.5.093.682-.217.682-.483 0-.237-.008-.866-.013-1.7-2.782.605-3.369-1.344-3.369-1.344-.455-1.157-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.071 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.091-.647.35-1.088.636-1.338-2.221-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.987 1.029-2.687-.103-.253-.446-1.272.098-2.651 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0 1 12 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.026 2.747-1.026.546 1.379.203 2.398.1 2.651.64.7 1.028 1.594 1.028 2.687 0 3.848-2.338 4.695-4.566 4.943.359.31.678.922.678 1.858 0 1.341-.013 2.422-.013 2.752 0 .269.18.581.688.482A10.02 10.02 0 0 0 22 12.018C22 6.486 17.523 2 12 2Z"/></svg>',
		'email'  => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M3 5.75A2.75 2.75 0 0 1 5.75 3h12.5A2.75 2.75 0 0 1 21 5.75v12.5A2.75 2.75 0 0 1 18.25 21H5.75A2.75 2.75 0 0 1 3 18.25V5.75Zm2.2.25 6.8 5.44L18.8 6H5.2Zm13.05 1.4-5.63 4.5a1 1 0 0 1-1.24 0L5.75 7.4v10.85c0 .414.336.75.75.75h11a.75.75 0 0 0 .75-.75V7.4Z"/></svg>',
		'code'   => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M9.53 7.47a.75.75 0 0 1 0 1.06L6.06 12l3.47 3.47a.75.75 0 1 1-1.06 1.06l-4-4a.75.75 0 0 1 0-1.06l4-4a.75.75 0 0 1 1.06 0Zm4.94 0a.75.75 0 0 1 1.06 0l4 4a.75.75 0 0 1 0 1.06l-4 4a.75.75 0 1 1-1.06-1.06L17.94 12l-3.47-3.47a.75.75 0 0 1 0-1.06ZM12.97 5.15a.75.75 0 0 1 .53.92l-2 12a.75.75 0 1 1-1.48-.24l2-12a.75.75 0 0 1 .95-.68Z"/></svg>',
		'stack'  => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M12 3 3.5 7.5 12 12l8.5-4.5L12 3Zm-8.5 7.5V15L12 19.5 20.5 15v-4.5L12 15l-8.5-4.5Zm0 6V21L12 25.5 20.5 21v-4.5L12 21l-8.5-4.5Z" transform="translate(0 -1.5) scale(1 .84)"/></svg>',
		'server' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M4 5.75A1.75 1.75 0 0 1 5.75 4h12.5A1.75 1.75 0 0 1 20 5.75v3.5A1.75 1.75 0 0 1 18.25 11H5.75A1.75 1.75 0 0 1 4 9.25v-3.5Zm1.75-.25a.25.25 0 0 0-.25.25v3.5c0 .138.112.25.25.25h12.5a.25.25 0 0 0 .25-.25v-3.5a.25.25 0 0 0-.25-.25H5.75ZM4 14.75A1.75 1.75 0 0 1 5.75 13h12.5A1.75 1.75 0 0 1 20 14.75v3.5A1.75 1.75 0 0 1 18.25 20H5.75A1.75 1.75 0 0 1 4 18.25v-3.5Zm1.75-.25a.25.25 0 0 0-.25.25v3.5c0 .138.112.25.25.25h12.5a.25.25 0 0 0 .25-.25v-3.5a.25.25 0 0 0-.25-.25H5.75ZM7.5 7.5a1 1 0 1 0 0 .001V7.5Zm0 9a1 1 0 1 0 0 .001v-.001Z"/></svg>',
		'map'    => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M15.5 4a1 1 0 0 1 .447.106l4 2A1 1 0 0 1 20.5 7v11a1 1 0 0 1-1.447.894L15 16.618l-5.053 2.276a1 1 0 0 1-.894 0l-4-2A1 1 0 0 1 4.5 16V5a1 1 0 0 1 1.447-.894L10 6.382l5.053-2.276A1 1 0 0 1 15.5 4ZM15 5.882l-4 1.8v9.436l4-1.8V5.882Zm1.5.236v9.2l2.5 1.25v-9.2l-2.5-1.25ZM6 6.632v9.2l3.5 1.75v-9.2L6 6.632Z"/></svg>',
		'python' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M11.61 2c-1.16 0-2.26.1-3.22.27C5.57 2.76 5 3.8 5 5.46v2.17h6.89v.72H2.47C1.11 8.35 0 9.5 0 10.92v2.16C0 14.5 1.1 15.65 2.47 15.65h1.42v-2.04c0-1.66 1.43-3.12 3.11-3.12h5.17c1.44 0 2.6-1.18 2.6-2.63V5.46c0-1.36-1.15-2.38-2.6-2.63C11.26 2.15 12.5 2 11.61 2Zm-3.77 1.51c.7 0 1.27.57 1.27 1.28 0 .7-.57 1.27-1.27 1.27a1.27 1.27 0 0 1 0-2.55Zm4.55 16.98c1.16 0 2.26-.1 3.22-.27 2.82-.49 3.39-1.53 3.39-3.19v-2.17h-6.89v-.72h9.42c1.36 0 2.47-1.15 2.47-2.57V9.42C24 8 22.9 6.85 21.53 6.85h-1.42v2.04c0 1.66-1.43 3.12-3.11 3.12h-5.17c-1.44 0-2.6 1.18-2.6 2.63v2.39c0 1.36 1.15 2.38 2.6 2.63.91.68-.33.83.56.83Zm3.77-1.51a1.27 1.27 0 1 1 0-2.55 1.27 1.27 0 0 1 0 2.55Z"/></svg>',
		'fastapi' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M13.977 2 6.34 11.166h4.44L9.999 22l7.66-11.165h-4.477L13.977 2Z"/></svg>',
		'gdal' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M4.5 5.5 12 2l7.5 3.5v13L12 22l-7.5-3.5v-13Zm1.5.97v10.96l5.25 2.45V9.03L6 6.47Zm6.75 12.41L18 17.43V6.47l-5.25 2.56v9.85Zm-.75-11.14 3.96-1.93L12 4.06 8.04 5.8 12 7.74Z"/></svg>',
		'csharp' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M14.5 2.6 5.9 7.55v8.9L14.5 21.4l8.6-4.95v-8.9L14.5 2.6Zm-4.44 12.15a3.74 3.74 0 0 1 0-5.5 3.9 3.9 0 0 1 5.2-.2l-1 1.14a2.22 2.22 0 0 0-2.97.1 2.1 2.1 0 0 0 0 3.12 2.22 2.22 0 0 0 2.97.1l1 1.14a3.9 3.9 0 0 1-5.2-.2Zm8.83-2.24h-.89v.88h-.92v-.88h-.9v-.9h.9v-.9H18v.9h.89v.9Zm2.18 0h-.89v.88h-.92v-.88h-.9v-.9h.9v-.9h.92v.9h.89v.9Z"/></svg>',
		'postgresql' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M12.61 2.05c-2.68 0-4.75 1.52-5.58 4.04-.52 1.58-.56 3.46-.35 5.15-.63.42-1.02 1.08-1 1.86.03 1.18.92 2.1 2 2.26.28 1.47.78 2.78 1.69 3.97.62.8 1.7 1.64 2.83 1.64.8 0 1.44-.29 1.87-.76.2.06.42.1.65.1.72 0 1.36-.37 1.76-.93.43-.05.98-.19 1.52-.48 1.36-.74 1.95-2.14 2.17-3.52.77-.29 1.32-1.05 1.33-1.95.01-.9-.53-1.67-1.29-1.97.33-1.87.2-4.19-.71-5.9-.98-1.83-2.88-2.98-4.89-2.98ZM9.75 7.1c.32-.74.78-1.3 1.4-1.67.34-.2.86-.4 1.46-.34.74.08 1.28.5 1.6 1.14.14.3.24.66.29 1.08-.14-.03-.29-.04-.44-.04-.58 0-1.11.18-1.54.49-.34-.62-.94-1-1.63-1-.64 0-1.3.14-1.92.34.19-.15.39-.28.62-.4.54-.29 1.1-.42 1.69-.42.58 0 1.1.11 1.55.31.52.24.94.63 1.22 1.15.28.51.43 1.18.43 2v.55c0 1.1-.1 1.94-.28 2.52-.18.59-.46 1.01-.84 1.3-.38.28-.83.42-1.36.42-.4 0-.78-.08-1.12-.24-.35-.17-.64-.44-.88-.83l.95-.86c.12.19.27.33.45.43.18.09.38.14.6.14.35 0 .61-.12.8-.37.18-.25.27-.7.27-1.36v-.1c-.42.3-.9.45-1.44.45-.74 0-1.34-.24-1.82-.73-.48-.48-.72-1.11-.72-1.87 0-.57.11-1.06.34-1.48Zm.98 1.1c-.2.24-.3.56-.3.97 0 .42.1.75.3 1 .2.24.48.37.84.37.35 0 .64-.11.87-.33.23-.23.35-.54.35-.94 0-.41-.12-.73-.35-.96a1.14 1.14 0 0 0-.87-.35c-.36 0-.64.12-.84.36Z"/></svg>',
	];

	return $icons[$name] ?? '';
}

function zqlovegis_render_skill_badge(string $icon, string $label): string
{
	$icon_markup = zqlovegis_render_icon($icon);

	return sprintf(
		'<span class="paper-skill-badge">%s<span>%s</span></span>',
		$icon_markup,
		esc_html($label)
	);
}

function zqlovegis_render_site_header(string $current = ''): void
{
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
				<a href="mailto:zq.2004@outlook.com">Email</a>
			</div>
		</div>
	</footer>
	<?php
}
