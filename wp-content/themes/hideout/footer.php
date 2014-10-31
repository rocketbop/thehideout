<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Hideout
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="site-info">
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'hideout' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'hideout' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( __( 'Theme: %1$s by %2$s.', 'hideout' ), 'Hideout', '<a href="http://www.alternativestofighting.com" rel="designer">Paul Byrne</a>' ); ?>
			</div><!-- .site-info -->
		</div>	
	</footer><!-- #colophon -->



	  </div> <!-- page container-fluid -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
