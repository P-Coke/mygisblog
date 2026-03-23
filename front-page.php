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

<header class="paper-site-header">
	<div class="paper-site-header__inner">
		<div class="paper-site-brand">
			<p class="paper-site-brand__title">山河与像素</p>
			<p class="paper-site-brand__subtitle">在卫星、地图与代码之间慢慢写</p>
		</div>
		<nav class="paper-site-nav" aria-label="<?php esc_attr_e('Primary navigation', 'zqlovegis-theme'); ?>">
			<a href="<?php echo esc_url(home_url('/')); ?>">首页</a>
			<a href="<?php echo esc_url($about_url); ?>">关于</a>
			<a href="#articles">文章</a>
			<a href="<?php echo esc_url($github_url); ?>" target="_blank" rel="noreferrer">GitHub</a>
		</nav>
	</div>
</header>

<main class="paper-dashboard" aria-label="<?php esc_attr_e('Academic dashboard homepage', 'zqlovegis-theme'); ?>">
	<section class="paper-main-column">
		<section class="paper-panel paper-hero">
			<p class="paper-kicker">山河与像素 / zqlovegis.cn</p>
			<h1>把看过的山河、读过的影像、写下的代码，都慢慢留在这里</h1>
			<p class="paper-english-desc">Notes on remote sensing, maps, code, and the quiet work behind them.</p>
			<p class="paper-lead">这里会写我在地图、遥感、GIS、WebGIS 和日常开发里碰到的东西。有的是正经做过的项目，有的是一时兴起记下来的想法，也有一些只是还没完全想明白、但不想让它就这么散掉的片段。</p>
			<p class="paper-hero-note">它更像一本长期更新的工作手记，而不是一份写给别人看的标准说明书。</p>
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
					<a href="<?php echo esc_url($github_url); ?>" target="_blank" rel="noreferrer">GitHub</a>
					<a href="mailto:hello@zqlovegis.cn">邮箱</a>
				</div>
			</div>
			<h2>Pcoke</h2>
			<p class="paper-real-name">张琦</p>
			<p class="paper-bio">太原理工大学 · 测绘工程<br>平时在遥感、GIS 和开发之间慢慢来回走</p>
			<p class="paper-profile-note">比起把事情做完，我更在意它能不能留下来，能不能继续被修改，能不能说得明白。</p>
			<div class="paper-tags">
				<span>Python</span>
				<span>FastAPI</span>
				<span>GDAL</span>
				<span>C#</span>
				<span>PostgreSQL</span>
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

<footer class="paper-site-footer">
	<div class="paper-site-footer__inner">
		<p>这里就是一个慢慢更新的个人博客。写得不会特别快，但基本都会是我自己真的做过、想过、折腾过的东西。</p>
		<div class="paper-site-footer__links">
			<a href="<?php echo esc_url($github_url); ?>" target="_blank" rel="noreferrer">GitHub</a>
			<a href="mailto:hello@zqlovegis.cn">Email</a>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
