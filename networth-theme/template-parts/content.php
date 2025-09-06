<?php
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if (is_singular()) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php endif; ?>
		<div class="entry-meta"><?php echo esc_html(get_the_date()); ?></div>
	</header>
	<div class="entry-content">
		<?php if (is_singular()) { the_content(); } else { the_excerpt(); } ?>
	</div>
</article>