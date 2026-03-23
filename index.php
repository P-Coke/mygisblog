<?php

if (!defined('ABSPATH')) {
	exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class('paper-dashboard-page paper-archive-page'); ?>>
<?php wp_body_open(); ?>
<?php zqlovegis_render_site_header('articles'); ?>

<main class="paper-content-shell">
	<section class="paper-reading-card paper-archive-card">
		<header class="paper-reading-header">
			<p class="paper-reading-kicker">文章</p>
			<h1><?php single_post_title('文章归档'); ?></h1>
		</header>

		<?php if (have_posts()) : ?>
			<ul class="paper-archive-list">
				<?php while (have_posts()) : the_post(); ?>
					<li class="paper-archive-item">
						<div class="paper-article-date"><?php echo esc_html(get_the_date('Y.m.d')); ?></div>
						<div class="paper-article-info">
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 30, '...')); ?></p>
						</div>
					</li>
				<?php endwhile; ?>
			</ul>

			<div class="paper-pagination">
				<?php the_posts_pagination(); ?>
			</div>
		<?php else : ?>
			<div class="paper-empty-state">
				<p>这里还没有文章。</p>
			</div>
		<?php endif; ?>
	</section>
</main>

<?php zqlovegis_render_site_footer(); ?>
<?php wp_footer(); ?>
</body>
</html>
