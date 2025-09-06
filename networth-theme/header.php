<?php
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="site-header">
	<div class="container">
		<div class="site-branding" style="display:flex;align-items:center;gap:1rem;">
			<?php if (function_exists('the_custom_logo') && has_custom_logo()) { the_custom_logo(); } ?>
			<div>
				<h1 class="site-title" style="margin:0;">
					<a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
				</h1>
				<p class="site-description"><?php bloginfo('description'); ?></p>
			</div>
		</div>
		<nav class="nav-primary" aria-label="<?php esc_attr_e('Primary', 'networth'); ?>">
			<?php
				wp_nav_menu([
					'theme_location' => 'primary',
					'container' => false,
					'menu_class' => 'menu menu-primary',
					'fallback_cb' => '__return_false',
				]);
			?>
		</nav>
	</div>
</header>
<div class="container">
	<div class="content-area">