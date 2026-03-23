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
<body <?php body_class('paper-dashboard-page paper-reading-page'); ?>>
<?php wp_body_open(); ?>
<?php zqlovegis_render_site_header('articles'); ?>

<main class="paper-content-shell">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<article <?php post_class('paper-reading-card'); ?>>
				<header class="paper-reading-header">
					<p class="paper-reading-kicker"><?php echo esc_html(get_the_date('Y.m.d')); ?></p>
					<h1><?php the_title(); ?></h1>
					<?php if (has_excerpt()) : ?>
						<p class="paper-reading-summary"><?php echo esc_html(get_the_excerpt()); ?></p>
					<?php endif; ?>
				</header>
				<div class="paper-reading-body">
					<?php the_content(); ?>
				</div>
			</article>
		<?php endwhile; ?>
	<?php endif; ?>
</main>

<?php zqlovegis_render_site_footer(); ?>
<?php wp_footer(); ?>
</body>
</html>
