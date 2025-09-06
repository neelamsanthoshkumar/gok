<?php
/**
 * NetWorth Theme functions and definitions
 */

if (!defined('NETWORTH_VERSION')) {
	define('NETWORTH_VERSION', '1.0.0');
}

// Theme setup
add_action('after_setup_theme', function () {
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
	add_theme_support('custom-logo', [
		'height'      => 64,
		'width'       => 220,
		'flex-width'  => true,
		'flex-height' => true,
	]);

	register_nav_menus([
		'primary' => __('Primary Menu', 'networth'),
	]);
});

// Widgets
add_action('widgets_init', function () {
	register_sidebar([
		'name'          => __('Primary Sidebar', 'networth'),
		'id'            => 'sidebar-1',
		'description'   => __('Add widgets here to appear in your sidebar.', 'networth'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	]);
});

// Enqueue scripts and styles
add_action('wp_enqueue_scripts', function () {
	$theme_version = NETWORTH_VERSION;
	wp_enqueue_style('networth-style', get_stylesheet_uri(), [], $theme_version);
	wp_enqueue_script('networth-script', get_template_directory_uri() . '/assets/js/theme.js', [], $theme_version, true);
});

// Register Celebrity CPT
add_action('init', function () {
	$labels = [
		'name'               => _x('Celebrities', 'post type general name', 'networth'),
		'singular_name'      => _x('Celebrity', 'post type singular name', 'networth'),
		'menu_name'          => _x('Celebrities', 'admin menu', 'networth'),
		'name_admin_bar'     => _x('Celebrity', 'add new on admin bar', 'networth'),
		'add_new'            => _x('Add New', 'celebrity', 'networth'),
		'add_new_item'       => __('Add New Celebrity', 'networth'),
		'new_item'           => __('New Celebrity', 'networth'),
		'edit_item'          => __('Edit Celebrity', 'networth'),
		'view_item'          => __('View Celebrity', 'networth'),
		'all_items'          => __('All Celebrities', 'networth'),
		'search_items'       => __('Search Celebrities', 'networth'),
		'parent_item_colon'  => __('Parent Celebrities:', 'networth'),
		'not_found'          => __('No celebrities found.', 'networth'),
		'not_found_in_trash' => __('No celebrities found in Trash.', 'networth')
	];

	$args = [
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => [ 'slug' => 'celebrity' ],
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-star-filled',
		'supports'           => [ 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ],
		'show_in_rest'       => true,
	];

	register_post_type('celebrity', $args);
});

// Meta boxes for Celebrity data
add_action('add_meta_boxes', function () {
	add_meta_box('celebrity_details', __('Celebrity Details', 'networth'), function ($post) {
		wp_nonce_field('celebrity_details_nonce', 'celebrity_details_nonce');
		$fields = [
			'net_worth'  => __('Net Worth (USD)', 'networth'),
			'profession' => __('Profession', 'networth'),
			'birth_date' => __('Birth Date (YYYY-MM-DD)', 'networth'),
			'nationality'=> __('Nationality', 'networth'),
		];

		echo '<table class="form-table">';
		foreach ($fields as $key => $label) {
			$value = get_post_meta($post->ID, $key, true);
			echo '<tr>';
			echo '<th><label for="' . esc_attr($key) . '">' . esc_html($label) . '</label></th>';
			echo '<td><input type="text" id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '" class="regular-text" /></td>';
			echo '</tr>';
		}
		echo '</table>';
	}, 'celebrity', 'normal', 'default');
});

add_action('save_post_celebrity', function ($post_id) {
	if (!isset($_POST['celebrity_details_nonce']) || !wp_verify_nonce($_POST['celebrity_details_nonce'], 'celebrity_details_nonce')) {
		return;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	$keys = ['net_worth', 'profession', 'birth_date', 'nationality'];
	foreach ($keys as $key) {
		if (isset($_POST[$key])) {
			update_post_meta($post_id, $key, sanitize_text_field(wp_unslash($_POST[$key])));
		}
	}
});

// Helper: format currency
function networth_format_currency($value) {
	if ($value === '' || $value === null) {
		return '';
	}
	$float = floatval(str_replace([',', ' '], '', (string) $value));
	if ($float >= 1000000000) {
		return '$' . number_format($float / 1000000000, 2) . 'B';
	}
	if ($float >= 1000000) {
		return '$' . number_format($float / 1000000, 2) . 'M';
	}
	return '$' . number_format($float, 0);
}