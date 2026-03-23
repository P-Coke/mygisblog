<?php

if (!defined('ABSPATH')) {
	exit;
}

$github_url = 'https://github.com/P-Coke';
$github_avatar = 'https://github.com/P-Coke.png?size=240';
$lab_url = 'https://github.com/P-Coke';
$about_url = home_url('/about/');

$article_query = new WP_Query(
	[
		'post_type'           => 'post',
		'posts_per_page'      => 6,
		'ignore_sticky_posts' => false,
	]
);
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class('paper-dashboard-page'); ?>>
<?php wp_body_open(); ?>
<?php zqlovegis_render_site_header('home'); ?>

<main class="paper-dashboard" aria-label="<?php esc_attr_e('Academic dashboard homepage', 'zqlovegis-theme'); ?>">
	<section class="paper-main-column">
		<section class="paper-panel paper-hero">
			<div class="paper-hero-top">
				<div class="paper-hero-copy">
					<p class="paper-kicker">山河与像素 / zqlovegis.cn</p>
					<h1>把地图、影像和代码，慢慢记下来</h1>
					<p class="paper-english-desc">Notes on maps, imagery, code, and the work between them.</p>
					<p class="paper-lead">写地图，记影像，也记那些在代码里绕了很久才慢慢想明白的东西。</p>
				</div>
				<div class="paper-map-frame" aria-hidden="true">
					<span class="paper-map-frame__label">Map Frame</span>
					<div class="paper-map-frame__grid"></div>
					<span class="paper-map-frame__axis paper-map-frame__axis--north">N</span>
					<span class="paper-map-frame__axis paper-map-frame__axis--east">E</span>
				</div>
			</div>
			<div class="paper-action-buttons">
				<a class="paper-btn paper-btn--primary" href="#articles">进入文章</a>
				<a class="paper-btn paper-btn--outline" href="<?php echo esc_url($about_url); ?>">了解我</a>
			</div>
		</section>

		<section class="paper-panel paper-lab">
			<span class="paper-label">实验小站</span>
			<h2>葵花卫星火点监测</h2>
			<p>这里以后会放一些还在打磨中的页面。它们也许还不够完整，但至少能看见思路是怎么一点点长出来的。</p>
			<a class="paper-lab-link" href="<?php echo esc_url($lab_url); ?>" target="_blank" rel="noreferrer">进去看看 →</a>
		</section>

		<section id="articles" class="paper-panel paper-articles">
			<span class="paper-label">最近更新</span>
			<h2>最近文章</h2>

			<?php if ($article_query->have_posts()) : ?>
				<ul class="paper-article-list">
					<?php while ($article_query->have_posts()) : ?>
						<?php $article_query->the_post(); ?>
						<li class="paper-article-item">
							<div class="paper-article-date"><?php echo esc_html(get_the_date('Y.m.d')); ?></div>
							<div class="paper-article-info">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 28, '...')); ?></p>
							</div>
						</li>
					<?php endwhile; ?>
				</ul>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<div class="paper-empty-state">
					<p>第一篇文章还没有发布。请在 WordPress 后台“文章”里创建内容，这里会自动更新。</p>
				</div>
			<?php endif; ?>
		</section>
	</section>

	<aside class="paper-sidebar" aria-label="<?php esc_attr_e('Sidebar', 'zqlovegis-theme'); ?>">
		<section class="paper-panel">
			<span class="paper-label">关于我</span>
			<div class="paper-profile-head paper-profile-head--compact">
				<img class="paper-profile-avatar" src="<?php echo esc_url($github_avatar); ?>" alt="Pcoke GitHub Avatar">
				<div class="paper-profile-links">
					<a href="<?php echo esc_url($github_url); ?>" target="_blank" rel="noreferrer">
						<?php echo zqlovegis_render_icon('github'); ?>
						<span class="paper-profile-link-text">
							<strong>GitHub</strong>
							<small>github.com/P-Coke</small>
						</span>
					</a>
					<a href="mailto:zq.2004@outlook.com">
						<?php echo zqlovegis_render_icon('email'); ?>
						<span class="paper-profile-link-text">
							<strong>邮箱</strong>
							<small>zq.2004@outlook.com</small>
						</span>
					</a>
				</div>
			</div>
			<h2>Pcoke</h2>
			<p class="paper-real-name">张琦</p>
			<p class="paper-bio">太原理工大学 · 测绘工程</p>
			<p class="paper-profile-note">比起把事情做完，我更在意它能不能留下来，能不能继续被修改，能不能说得明白。</p>
			<div class="paper-skill-badge-list">
				<?php echo zqlovegis_render_skill_badge('python', 'Python'); ?>
				<?php echo zqlovegis_render_skill_badge('fastapi', 'FastAPI'); ?>
				<?php echo zqlovegis_render_skill_badge('gdal', 'GDAL'); ?>
				<?php echo zqlovegis_render_skill_badge('csharp', 'C#'); ?>
				<?php echo zqlovegis_render_skill_badge('postgresql', 'PostgreSQL'); ?>
				<?php echo zqlovegis_render_skill_badge('code', 'MATLAB'); ?>
				<?php echo zqlovegis_render_skill_badge('code', 'JavaScript'); ?>
				<?php echo zqlovegis_render_skill_badge('stack', 'WPF'); ?>
				<?php echo zqlovegis_render_skill_badge('stack', 'Redis'); ?>
				<?php echo zqlovegis_render_skill_badge('server', 'Linux'); ?>
				<?php echo zqlovegis_render_skill_badge('server', 'Docker'); ?>
				<?php echo zqlovegis_render_skill_badge('server', 'Nginx'); ?>
				<?php echo zqlovegis_render_skill_badge('server', 'Shell'); ?>
				<?php echo zqlovegis_render_skill_badge('map', 'GEE'); ?>
				<?php echo zqlovegis_render_skill_badge('map', 'ArcGIS'); ?>
			</div>
		</section>

		<section class="paper-panel">
			<span class="paper-label">GitHub</span>
			<div class="paper-github-card">
				<img src="/api/github-stats" alt="GitHub Statistics">
			</div>
			<div class="paper-github-card">
				<img src="/api/github-top-langs" alt="GitHub Top Languages">
			</div>
		</section>

		<section class="paper-panel">
			<span class="paper-label">会写到的东西</span>
			<div class="paper-track">
				<span class="paper-track-id">一</span>
				<strong>生态遥感</strong>
				<p>像火点监测、多源遥感数据处理、生态变化分析这些内容，后面多半会反复出现。</p>
			</div>
			<div class="paper-track">
				<span class="paper-track-id">二</span>
				<strong>空间数据工程</strong>
				<p>比如 Python、GDAL、数据库和脚本处理流程，更多会写那些真正做事时绕不开的问题。</p>
			</div>
			<div class="paper-track">
				<span class="paper-track-id">三</span>
				<strong>WebGIS 与系统实现</strong>
				<p>还有 WebGIS、接口、小工具、部署这些偏工程的东西，我也会记，因为很多时间其实都花在它们身上。</p>
			</div>
		</section>

		<section class="paper-panel">
			<span class="paper-label">平时怎么做</span>
			<h2>我更习惯边做边记</h2>
			<p class="paper-sidebar-copy">我不太喜欢把事情只停在“跑通一次”这里。能整理成脚本的就整理成脚本，能做成接口或小工具的就继续往下做，顺手把过程记下来，后面回头看也方便。</p>
			<p class="paper-sidebar-copy">所以这里会有代码、流程、地图，也会有一些不那么正式的碎碎念。很多时候，真正留下来的反而是这些当时随手记下来的东西。</p>
		</section>
	</aside>
</main>
<?php zqlovegis_render_site_footer(); ?>

<?php wp_footer(); ?>
</body>
</html>
