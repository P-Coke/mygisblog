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
			<p class="paper-site-brand__title">山河与像素</p>
			<p class="paper-site-brand__subtitle">张琦 · 在卫星、地图与代码之间慢慢写</p>
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
		<span class="paper-label">关于</span>
		<div class="paper-profile-head">
			<img class="paper-profile-avatar" src="<?php echo esc_url($github_avatar); ?>" alt="Pcoke GitHub Avatar">
		</div>
		<h1>关于我</h1>
		<p class="paper-lead">我是张琦，平时更常用 Pcoke 这个名字。目前在太原理工大学读测绘工程。这个页面不想写得太像简历，就简单说说我平时在做什么、在关心什么。</p>
		<p class="paper-hero-note">如果首页更像随手写下来的笔记，这一页就算是稍微正式一点的自我说明。</p>
	</section>

	<section class="paper-about-grid">
		<section class="paper-panel">
			<span class="paper-label">我在关注</span>
			<h2>研究兴趣</h2>
			<div class="paper-track">
				<strong>生态遥感</strong>
				<p>我对多源卫星数据一直挺感兴趣，尤其是它们怎么被用在环境监测和生态变化分析里，而不是只停留在“看图”和“出图”这一步。</p>
			</div>
			<div class="paper-track">
				<strong>火点监测</strong>
				<p>现在比较想往下做的是 Himawari-8/9 火点监测，包括实时识别、热异常判断，还有后面的自动处理流程。</p>
			</div>
			<div class="paper-track">
				<strong>土壤侵蚀与生态评估</strong>
				<p>RUSLE、CSLE、人类活动强度这些方向我也一直在接触，主要还是想把模型、空间分析和最后的表达真正连起来。</p>
			</div>
		</section>

		<section class="paper-panel">
			<span class="paper-label">我平时怎么做</span>
			<h2>技术与实现</h2>
			<p>相比只把分析跑通一次，我更喜欢把东西继续往下做。能写成脚本的就写成脚本，能做成接口的就做成接口，能顺手做个页面或小工具的，也会尽量补上。</p>
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
		<span class="paper-label">为什么要写这个站</span>
		<h2>这个博客想留下什么</h2>
		<p>我一直觉得，很多真正有用的东西都藏在过程里，比如一个数据怎么清、一个脚本怎么改、一个页面为什么最后长成这样。这些东西如果不记，过一阵就忘了。</p>
		<p>所以这个站点对我来说更像一本长期更新的工作笔记。它不一定每篇都很正式，但我希望尽量写自己真的做过的东西，而不是拼一些看起来很完整、其实没什么内容的介绍。</p>
	</section>

	<section class="paper-panel">
		<span class="paper-label">链接</span>
		<h2>站点与链接</h2>
		<div class="paper-about-links">
			<a class="paper-btn paper-btn--primary" href="<?php echo esc_url($github_url); ?>" target="_blank" rel="noreferrer">访问 GitHub</a>
			<a class="paper-btn paper-btn--outline" href="<?php echo esc_url($home_url); ?>">返回首页</a>
		</div>
	</section>
</main>

<footer class="paper-site-footer">
	<div class="paper-site-footer__inner">
		<p>这里会慢慢更新一些我自己关心、也确实花时间做过的内容。写得不一定快，但尽量都是真东西。</p>
		<div class="paper-site-footer__links">
			<a href="<?php echo esc_url($github_url); ?>" target="_blank" rel="noreferrer">GitHub</a>
			<a href="mailto:hello@zqlovegis.cn">Email</a>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
