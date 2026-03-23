<?php

if (!defined('ABSPATH')) {
	exit;
}

$github_url = 'https://github.com/P-Coke';
$github_avatar = 'https://github.com/P-Coke.png?size=240';
$home_url = home_url('/');
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class('paper-dashboard-page paper-about-page'); ?>>
<?php wp_body_open(); ?>

<header class="paper-site-header">
	<div class="paper-site-header__inner">
		<div class="paper-site-brand">
			<p class="paper-site-brand__title">Pcoke / GIS Notes</p>
			<p class="paper-site-brand__subtitle">张琦 · 关于地图、遥感与代码的个人博客</p>
		</div>
		<nav class="paper-site-nav" aria-label="<?php esc_attr_e('Primary navigation', 'zqlovegis-theme'); ?>">
			<a href="<?php echo esc_url($home_url); ?>">首页</a>
			<a href="<?php echo esc_url(home_url('/about/')); ?>">关于</a>
			<a href="<?php echo esc_url($home_url); ?>#articles">文章</a>
			<a href="<?php echo esc_url($github_url); ?>" target="_blank" rel="noreferrer">GitHub</a>
		</nav>
	</div>
</header>

<main class="paper-about">
	<section class="paper-panel paper-about-hero">
		<span class="paper-label">About</span>
		<div class="paper-profile-head">
			<img class="paper-profile-avatar" src="<?php echo esc_url($github_avatar); ?>" alt="Pcoke GitHub Avatar">
		</div>
		<h1>关于我</h1>
		<p class="paper-lead">我是张琦，常用网名 Pcoke，目前就读于太原理工大学测绘工程专业。本科阶段的兴趣主要集中在生态遥感、空间信息工程、WebGIS 系统实现，以及如何把研究问题转化为真正可运行的工具和流程。</p>
	</section>

	<section class="paper-about-grid">
		<section class="paper-panel">
			<span class="paper-label">Research Focus</span>
			<h2>研究兴趣</h2>
			<div class="paper-track">
				<strong>生态遥感</strong>
				<p>关注多源卫星数据在环境监测和生态变化分析中的应用，尤其关心时序观测、区域尺度分析和结果表达。</p>
			</div>
			<div class="paper-track">
				<strong>火点监测</strong>
				<p>当前重点包括基于 Himawari-8/9 的实时火点监测、热异常识别，以及相关处理流程的自动化组织。</p>
			</div>
			<div class="paper-track">
				<strong>土壤侵蚀与生态评估</strong>
				<p>围绕 RUSLE、CSLE 以及人类活动强度等方向，尝试把模型计算与空间分析真正结合起来。</p>
			</div>
		</section>

		<section class="paper-panel">
			<span class="paper-label">Engineering</span>
			<h2>技术与实现</h2>
			<p>我不是只停留在分析和做图层面。相比单一脚本，我更希望把数据处理、接口服务、数据库、地图表达和前端交互串成完整系统。</p>
			<div class="paper-tags">
				<span>Python</span>
				<span>FastAPI</span>
				<span>GDAL</span>
				<span>PostgreSQL</span>
				<span>Redis</span>
				<span>C#</span>
				<span>Linux</span>
				<span>Nginx</span>
			</div>
		</section>
	</section>

	<section class="paper-panel">
		<span class="paper-label">Work Style</span>
		<h2>我希望这个站点呈现什么</h2>
		<p>这个站点不只是展示“我会什么”，更想呈现“我是如何工作”的。这里会持续记录研究问题的拆解方式、空间数据处理流程、WebGIS 原型、部署经验，以及我对地图表达和技术写作的判断。</p>
		<p>如果你是通过这个站点认识我，我希望你看到的是一个愿意把研究和工程同时做扎实的人：既能写分析脚本，也能设计接口、部署服务，并把结果表达成别人读得懂、用得上的形式。</p>
	</section>

	<section class="paper-panel">
		<span class="paper-label">Links</span>
		<h2>站点与链接</h2>
		<div class="paper-about-links">
			<a class="paper-btn paper-btn--primary" href="<?php echo esc_url($github_url); ?>" target="_blank" rel="noreferrer">访问 GitHub</a>
			<a class="paper-btn paper-btn--outline" href="<?php echo esc_url($home_url); ?>">返回首页</a>
		</div>
	</section>
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
