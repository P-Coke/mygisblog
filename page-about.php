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
			<p class="paper-site-brand__subtitle">在卫星、地图与代码之间慢慢写</p>
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
		<div class="paper-profile-head paper-profile-head--compact">
			<img class="paper-profile-avatar" src="<?php echo esc_url($github_avatar); ?>" alt="Pcoke GitHub Avatar">
			<div class="paper-profile-links">
				<a href="<?php echo esc_url($github_url); ?>" target="_blank" rel="noreferrer">GitHub</a>
				<a href="mailto:hello@zqlovegis.cn">邮箱</a>
			</div>
		</div>
		<h1>关于我</h1>
		<p class="paper-lead">我是张琦，平时更常用 Pcoke 这个名字。目前在太原理工大学读测绘工程。这个页面也不想写得太像简历，就当作是把自己这些年慢慢在意起来的东西，安静地摆在这里。</p>
		<p class="paper-hero-note">如果首页更像随手写下来的笔记，这一页就算是把这些笔记的来处交代清楚一点。</p>
	</section>

	<section class="paper-about-grid">
		<section class="paper-panel">
			<span class="paper-label">我在关注</span>
			<h2>研究兴趣</h2>
			<div class="paper-track">
				<strong>生态遥感</strong>
				<p>我一直挺喜欢卫星数据这种东西。它们一头连着天空，一头连着地面，最后还会落到具体的问题里，而不只是停在图像本身。</p>
			</div>
			<div class="paper-track">
				<strong>火点监测</strong>
				<p>现在更想往下做的是 Himawari-8/9 火点监测，包括实时识别、热异常判断，还有后面那些不太显眼、但很费工夫的自动处理流程。</p>
			</div>
			<div class="paper-track">
				<strong>土壤侵蚀与生态评估</strong>
				<p>RUSLE、CSLE、人类活动强度这些方向我也一直在碰。比起模型本身，我其实更在意它们最后怎么和空间分析、地图表达真正接上。</p>
			</div>
		</section>

		<section class="paper-panel">
			<span class="paper-label">我平时怎么做</span>
			<h2>技术与实现</h2>
			<p>我做事的习惯一直比较慢，也比较拧。相比只把分析跑通一次，我更喜欢继续往下做一点，看看它能不能变成脚本、接口、页面，或者一个以后还能继续改的小工具。</p>
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
		<p>我一直觉得，很多真正有用的东西都藏在过程里。比如一个数据怎么清，一个脚本怎么改，一个页面为什么最后会长成现在这样。这些东西如果当时不记，过一阵就会散掉。</p>
		<p>所以这个站点对我来说更像一本慢慢写下去的工作笔记。它不一定每篇都很完整，但我希望尽量都是真实做过、真实想过的东西，而不是那种看起来很像样、其实没留下什么的介绍。</p>
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
