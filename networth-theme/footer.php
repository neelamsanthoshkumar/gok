<?php
?>
	</div><!-- .content-area -->
</div><!-- .container -->
<footer class="site-footer">
	<div class="container" style="padding:1rem 0;display:flex;justify-content:space-between;align-items:center;gap:1rem;flex-wrap:wrap;">
		<div>&copy; <span data-current-year></span> <?php echo esc_html(get_bloginfo('name')); ?></div>
		<div>
			<?php printf(esc_html__('Powered by %s', 'networth'), '<a href="https://wordpress.org">WordPress</a>'); ?>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>