<?php

if (!defined('ABSPATH')) {
	exit;
}

$github_url = 'https://github.com/P-Coke';
$lab_url = 'https://github.com/P-Coke';

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

<header class="paper-site-header">
	<div class="paper-site-header__inner">
		<div class="paper-site-brand">
			<p class="paper-site-brand__title">Pcoke / GIS Notes</p>
			<p class="paper-site-brand__subtitle">张琦 · 测绘与空间信息工程博客</p>
		</div>
		<nav class="paper-site-nav" aria-label="<?php esc_attr_e('Primary navigation', 'zqlovegis-theme'); ?>">
			<a href="#articles">文章</a>
			<a href="<?php echo esc_url($github_url); ?>" target="_blank" rel="noreferrer">GitHub</a>
		</nav>
	</div>
</header>

<main class="paper-dashboard" aria-label="<?php esc_attr_e('Academic dashboard homepage', 'zqlovegis-theme'); ?>">
	<section class="paper-main-column">
		<section class="paper-panel paper-hero">
			<p class="paper-kicker">Pcoke / zqlovegis.cn</p>
			<h1>测绘与空间信息工程</h1>
			<p class="paper-english-desc">Geomatics, Python for GIS, WebGIS engineering, and remote sensing notes.</p>
			<p class="paper-lead">这里记录空间数据处理、遥感工作流、WebGIS 架构、地图表达与科研型技术实现。我更关心如何把数据、方法、系统与可解释表达组织成可复用的工程能力。</p>
			<div class="paper-action-buttons">
				<a class="paper-btn paper-btn--primary" href="#articles">进入文章</a>
				<a class="paper-btn paper-btn--outline" href="<?php echo esc_url($github_url); ?>" target="_blank" rel="noreferrer">GitHub</a>
			</div>
		</section>

		<section class="paper-panel paper-lab">
			<span class="paper-label">The Lab</span>
			<h2>Live Demo: 葵花卫星火点实时监测</h2>
			<p>一个用于展示遥感监测与实时可视化工作流的实验入口。承接长期实验、轻量 Demo 和方法验证。</p>
			<a class="paper-lab-link" href="<?php echo esc_url($lab_url); ?>" target="_blank" rel="noreferrer">进入独立实验舱 →</a>
		</section>

		<section id="articles" class="paper-panel paper-articles">
			<span class="paper-label">Latest Writing</span>
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
			<span class="paper-label">Profile</span>
			<h2>Pcoke</h2>
			<p class="paper-real-name">张琦</p>
			<p class="paper-bio">太原理工大学 · 测绘工程<br>Undergraduate Researcher</p>
			<div class="paper-tags">
				<span>Python</span>
				<span>FastAPI</span>
				<span>GDAL</span>
				<span>C#</span>
			</div>
		</section>

		<section class="paper-panel">
			<span class="paper-label">GitHub Activity</span>
			<div class="paper-github-card">
				<img src="/api/github-stats" alt="GitHub Statistics">
			</div>
			<div class="paper-github-card">
				<img src="/api/github-top-langs" alt="GitHub Top Languages">
			</div>
		</section>

		<section class="paper-panel">
			<span class="paper-label">Taxonomy</span>
			<div class="paper-track">
				<span class="paper-track-id">Track A</span>
				<strong>遥感算法</strong>
				<p>RUSLE / CSLE、火点监测、影像处理链路。</p>
			</div>
			<div class="paper-track">
				<span class="paper-track-id">Track B</span>
				<strong>WebGIS 架构</strong>
				<p>接口设计、服务拆分、可视化交互与部署。</p>
			</div>
			<div class="paper-track">
				<span class="paper-track-id">Track C</span>
				<strong>算法平差笔记</strong>
				<p>测绘基础理论、误差传播、课程复盘与研究记录。</p>
			</div>
		</section>
	</aside>
</main>

<footer class="paper-site-footer">
	<div class="paper-site-footer__inner">
		<p>记录遥感、Python for GIS、WebGIS 与测绘工程笔记。这里首先是博客与研究记录，其次才是个人主页。</p>
		<div class="paper-site-footer__links">
			<a href="<?php echo esc_url($github_url); ?>" target="_blank" rel="noreferrer">GitHub</a>
			<a href="mailto:hello@zqlovegis.cn">Email</a>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
