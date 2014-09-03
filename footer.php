<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Iemoto Foundation 5
 */
?>

		<?php do_action( 'iemotof5_after_content' ); ?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo"><div class="row">
		<?php do_action( 'iemotof5_before_footer' ); ?>
		<div class="site-info large-12 columns">
			<?php do_action( 'iemotof5_footer' ); ?>
		</div><!-- .site-info -->
		<?php do_action( 'iemotof5_after_footer' ); ?>
	</div></footer><!-- #colophon -->
</div><!-- #page -->

<?php do_action( 'iemotof5_after_body' ); ?>

<?php wp_footer(); ?>

</body>
</html>
