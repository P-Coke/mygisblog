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
			<p class="paper-site-brand__title">Pcoke 的博客</p>
			<p class="paper-site-brand__subtitle">张琦 · 关于地图、遥感与代码的个人博客</p>
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
			<p class="paper-kicker">Pcoke / zqlovegis.cn</p>
			<h1>这儿主要写点和地图、遥感、代码有关的东西</h1>
			<p class="paper-english-desc">A personal blog about GIS, remote sensing, coding, and everyday work.</p>
			<p class="paper-lead">平时做项目、写代码、处理数据的时候，总会踩到不少坑，也会冒出一些想法。这个站点就是拿来记这些东西的，写得会比较杂一点，但基本都跟 GIS、遥感、WebGIS、Linux 和小工具开发有关。</p>
			<p class="paper-hero-note">有些文章会偏技术细节，有些会更像工作笔记，更新节奏不一定固定，但尽量都写自己真正做过的内容。</p>
			<div class="paper-action-buttons">
				<a class="paper-btn paper-btn--primary" href="#articles">进入文章</a>
				<a class="paper-btn paper-btn--outline" href="<?php echo esc_url($about_url); ?>">了解我</a>
			</div>
		</section>

		<section class="paper-intro-grid" aria-label="首页摘要">
			<section class="paper-panel paper-mini-panel">
				<span class="paper-label">最近在看</span>
				<h2>这段时间主要折腾什么</h2>
				<p>最近花得比较多的时间还是在生态遥感、多源卫星数据、火点监测，还有土壤侵蚀估算这些方向上。有些是课程和研究里的东西，有些是自己真感兴趣想继续往下挖的。</p>
				<p class="paper-mini-meta">大多还是和卫星数据、空间分析、研究里的具体问题有关。</p>
			</section>

			<section class="paper-panel paper-mini-panel">
				<span class="paper-label">平时怎么做</span>
				<h2>我更习惯边做边记</h2>
				<p>我不太喜欢把东西只停在“跑通一次”这个阶段。能整理成脚本的就整理成脚本，能做成接口或小工具的就继续往下做，顺手把过程记下来，后面自己回头看也方便。</p>
				<p class="paper-mini-meta">所以这里会有代码、流程、地图，也会有一些不那么正式的碎碎念。</p>
			</section>
		</section>

		<section class="paper-panel paper-focus">
			<span class="paper-label">最近在忙</span>
			<h2>手头几件事</h2>
			<div class="paper-focus-list">
				<div class="paper-focus-item">
					<strong>Himawari-8/9 火点监测</strong>
					<p>主要在看怎么把静止气象卫星的数据真正用起来，做成比较稳定的火点识别和自动处理流程。</p>
				</div>
				<div class="paper-focus-item">
					<strong>RUSLE / CSLE 土壤侵蚀估算</strong>
					<p>一边补模型和方法，一边琢磨怎么把空间因子整理得更清楚，最后算出来的结果也更像回事。</p>
				</div>
				<div class="paper-focus-item">
					<strong>WebGIS 和一些小工具</strong>
					<p>有些东西光分析还不够，我还是想把它做成能看、能点、能继续用的小系统，而不是只留在脚本里。</p>
				</div>
			</div>
		</section>

		<section class="paper-panel paper-lab">
			<span class="paper-label">实验小站</span>
			<h2>葵花卫星火点监测</h2>
			<p>这个位置以后会放我正在做的一些实验页面。和博客文章不一样，这里更偏“边做边试”，会放一些还在打磨中的东西。</p>
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
			<div class="paper-profile-head">
				<img class="paper-profile-avatar" src="<?php echo esc_url($github_avatar); ?>" alt="Pcoke GitHub Avatar">
			</div>
			<h2>Pcoke</h2>
			<p class="paper-real-name">张琦</p>
			<p class="paper-bio">太原理工大学 · 测绘工程<br>平时主要在遥感、GIS 和开发之间来回切换</p>
			<p class="paper-profile-note">更喜欢把事情做成能复用、能继续改、也能讲清楚的东西。</p>
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
			<span class="paper-label">平时会写</span>
			<div class="paper-track">
				<span class="paper-track-id">一</span>
				<strong>生态遥感</strong>
				<p>像火点监测、多源遥感数据处理、生态变化分析这些内容，后面应该会慢慢写得比较多。</p>
			</div>
			<div class="paper-track">
				<span class="paper-track-id">二</span>
				<strong>空间数据工程</strong>
				<p>比如 Python、GDAL、数据库、脚本处理流程，主要是一些真正做事时会碰到的问题和整理方法。</p>
			</div>
			<div class="paper-track">
				<span class="paper-track-id">三</span>
				<strong>WebGIS 与系统实现</strong>
				<p>还有 WebGIS、接口、小工具、部署这些偏工程的东西，我也会记，毕竟很多时候真正花时间的都在这部分。</p>
			</div>
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
