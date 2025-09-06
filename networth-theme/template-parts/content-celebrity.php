<?php
$net_worth   = get_post_meta(get_the_ID(), 'net_worth', true);
$profession  = get_post_meta(get_the_ID(), 'profession', true);
$birth_date  = get_post_meta(get_the_ID(), 'birth_date', true);
$nationality = get_post_meta(get_the_ID(), 'nationality', true);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="celebrity-card">
		<div class="thumb">
			<?php if (has_post_thumbnail()) { the_post_thumbnail('thumbnail'); } ?>
		</div>
		<div>
			<?php if (is_singular('celebrity')) : ?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php else : ?>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php endif; ?>
			<div class="meta">
				<?php
					$bits = array_filter([
						$profession ? esc_html($profession) : '',
						$nationality ? esc_html($nationality) : '',
						$birth_date ? esc_html($birth_date) : ''
					]);
					echo esc_html(implode(' • ', $bits));
				?>
			</div>
			<?php if (!empty($net_worth)) : ?>
				<div class="celebrity-networth"><?php echo esc_html(function_exists('networth_format_currency') ? networth_format_currency($net_worth) : $net_worth); ?></div>
			<?php endif; ?>
		</div>
	</div>
	<?php if (is_singular('celebrity')) : ?>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	<?php endif; ?>
</article>