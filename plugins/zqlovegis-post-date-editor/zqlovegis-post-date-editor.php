<?php
/**
 * Plugin Name: ZQLoveGIS Post Date Editor
 * Description: 在后台文章列表页直接修改文章发布日期。
 * Version: 0.1.0
 * Author: zq
 */

if (!defined('ABSPATH')) {
	exit;
}

add_action('admin_enqueue_scripts', function (string $hook): void {
	if ($hook !== 'edit.php') {
		return;
	}

	$screen = get_current_screen();

	if (!$screen || $screen->base !== 'edit' || $screen->post_type !== 'post') {
		return;
	}

	$base_url = plugin_dir_url(__FILE__) . 'assets/';

	wp_enqueue_style(
		'zqlovegis-post-date-editor',
		$base_url . 'post-date-editor.css',
		[],
		'0.1.0'
	);

	wp_enqueue_script(
		'zqlovegis-post-date-editor',
		$base_url . 'post-date-editor.js',
		['jquery'],
		'0.1.0',
		true
	);

	wp_localize_script(
		'zqlovegis-post-date-editor',
		'zqPostDateEditor',
		[
			'ajaxUrl' => admin_url('admin-ajax.php'),
			'nonce'   => wp_create_nonce('zq-post-date-editor'),
			'labels'  => [
				'edit'    => '修改日期',
				'cancel'  => '取消',
				'save'    => '保存',
				'loading' => '读取中...',
				'saving'  => '保存中...',
				'error'   => '日期更新失败，请稍后重试。',
			],
		]
	);
});

add_action('admin_footer-edit.php', function (): void {
	$screen = get_current_screen();

	if (!$screen || $screen->base !== 'edit' || $screen->post_type !== 'post') {
		return;
	}
	?>
	<div id="zq-post-date-editor-root" class="zq-post-date-editor-root" hidden></div>
	<?php
});

add_action('wp_ajax_zq_get_post_date', function (): void {
	check_ajax_referer('zq-post-date-editor', 'nonce');

	$post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;

	if (!$post_id || !current_user_can('edit_post', $post_id)) {
		wp_send_json_error(['message' => '没有权限修改这篇文章。'], 403);
	}

	$post = get_post($post_id);

	if (!$post || $post->post_type !== 'post') {
		wp_send_json_error(['message' => '文章不存在。'], 404);
	}

	$timezone = wp_timezone();
	$datetime = get_date_from_gmt($post->post_date_gmt ?: get_gmt_from_date($post->post_date), 'Y-m-d H:i:s');
	$local = new DateTimeImmutable($datetime, $timezone);

	wp_send_json_success(
		[
			'postId'      => $post_id,
			'title'       => get_the_title($post),
			'datetime'    => $local->format('Y-m-d\TH:i'),
			'displayDate' => get_the_date('Y.m.d', $post),
		]
	);
});

add_action('wp_ajax_zq_update_post_date', function (): void {
	check_ajax_referer('zq-post-date-editor', 'nonce');

	$post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;
	$raw_date = isset($_POST['post_date']) ? wp_unslash($_POST['post_date']) : '';

	if (!$post_id || !current_user_can('edit_post', $post_id)) {
		wp_send_json_error(['message' => '没有权限修改这篇文章。'], 403);
	}

	if (!$raw_date) {
		wp_send_json_error(['message' => '请选择一个有效时间。'], 400);
	}

	$timezone = wp_timezone();
	$date = DateTimeImmutable::createFromFormat('Y-m-d\TH:i', $raw_date, $timezone);

	if (!$date) {
		wp_send_json_error(['message' => '时间格式不正确。'], 400);
	}

	$post_date = $date->format('Y-m-d H:i:s');
	$post_date_gmt = get_gmt_from_date($post_date);

	$result = wp_update_post(
		[
			'ID'                => $post_id,
			'post_date'         => $post_date,
			'post_date_gmt'     => $post_date_gmt,
			'post_modified'     => $post_date,
			'post_modified_gmt' => $post_date_gmt,
			'edit_date'         => true,
		],
		true
	);

	if (is_wp_error($result)) {
		wp_send_json_error(['message' => $result->get_error_message()], 500);
	}

	wp_send_json_success(
		[
			'postId'      => $post_id,
			'displayDate' => get_the_date('Y.m.d', $post_id),
			'reload'      => true,
		]
	);
});
