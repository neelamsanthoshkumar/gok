<?php get_header(); ?>
<main id="primary" class="site-main">
	<header class="page-header">
		<h1 class="page-title"><?php post_type_archive_title(); ?></h1>
	</header>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<?php get_template_part('template-parts/content', 'celebrity'); ?>
		<?php endwhile; ?>
		<nav class="pagination" aria-label="<?php esc_attr_e('Celebrities', 'networth'); ?>">
			<?php the_posts_pagination(['mid_size' => 1]); ?>
		</nav>
	<?php else : ?>
		<?php get_template_part('template-parts/content', 'none'); ?>
	<?php endif; ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>