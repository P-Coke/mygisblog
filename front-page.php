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
			<p class="paper-site-brand__title">Pcoke / GIS Notes</p>
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
			<h1>关于地图、遥感与代码的个人笔记</h1>
			<p class="paper-english-desc">Personal notes on GIS, remote sensing, coding, and the work behind them.</p>
			<p class="paper-lead">这里主要写我平时在做和在学的内容：Python for GIS、生态遥感、WebGIS、小工具开发、Linux 折腾，以及项目推进过程中遇到的问题、思路和复盘。它首先是个人博客，其次才是作品展示。</p>
			<div class="paper-action-buttons">
				<a class="paper-btn paper-btn--primary" href="#articles">进入文章</a>
				<a class="paper-btn paper-btn--outline" href="<?php echo esc_url($about_url); ?>">了解我</a>
			</div>
		</section>

		<section class="paper-intro-grid" aria-label="首页摘要">
			<section class="paper-panel paper-mini-panel">
				<span class="paper-label">研究方向</span>
				<h2>我主要关注什么</h2>
				<p>当前工作重点放在生态遥感、多源卫星数据分析、火点监测、土壤侵蚀估算，以及人类活动强度与区域生态变化之间的关系。</p>
			</section>

			<section class="paper-panel paper-mini-panel">
				<span class="paper-label">工程能力</span>
				<h2>我如何把研究做成系统</h2>
				<p>我更偏向把研究问题工程化处理：用 Python 和 GIS 工具组织数据流程，用 WebGIS 或服务端接口做可复用的系统，再用地图和界面把结果清楚表达出来。</p>
			</section>
		</section>

		<section class="paper-panel paper-focus">
			<span class="paper-label">Current Focus</span>
			<h2>近期重点</h2>
			<div class="paper-focus-list">
				<div class="paper-focus-item">
					<strong>Himawari-8/9 火点监测</strong>
					<p>围绕静止气象卫星开展实时火点识别、热异常追踪与自动化处理。</p>
				</div>
				<div class="paper-focus-item">
					<strong>RUSLE / CSLE 土壤侵蚀估算</strong>
					<p>把模型计算、空间因子组织和区域尺度表达整合进统一分析流程。</p>
				</div>
				<div class="paper-focus-item">
					<strong>WebGIS 与研究型工具</strong>
					<p>把遥感分析、空间接口和前端表达做成真正可展示、可复用的应用。</p>
				</div>
			</div>
		</section>

		<section class="paper-panel paper-lab">
			<span class="paper-label">The Lab</span>
			<h2>Live Demo: 葵花卫星火点实时监测</h2>
			<p>这里会放置我正在推进的实验型项目。相比普通作品展示，我更想把研究思路、处理流程、接口能力和最终表达放在同一个页面里。</p>
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
			<div class="paper-profile-head">
				<img class="paper-profile-avatar" src="<?php echo esc_url($github_avatar); ?>" alt="Pcoke GitHub Avatar">
			</div>
			<h2>Pcoke</h2>
			<p class="paper-real-name">张琦</p>
			<p class="paper-bio">太原理工大学 · 测绘工程<br>本科阶段，关注生态遥感与空间信息工程</p>
			<div class="paper-tags">
				<span>Python</span>
				<span>FastAPI</span>
				<span>GDAL</span>
				<span>C#</span>
				<span>PostgreSQL</span>
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
				<strong>生态遥感</strong>
				<p>围绕火点监测、生态变化识别和多源遥感分析组织研究流程。</p>
			</div>
			<div class="paper-track">
				<span class="paper-track-id">Track B</span>
				<strong>空间数据工程</strong>
				<p>用 Python、GDAL、数据库和自动化脚本把数据链路真正跑通。</p>
			</div>
			<div class="paper-track">
				<span class="paper-track-id">Track C</span>
				<strong>WebGIS 与系统实现</strong>
				<p>把分析接口、地图表达和前端交互整合成研究型应用。</p>
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
