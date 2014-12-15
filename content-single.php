<?php
/**
 * @package Iemoto Foundation 5
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php do_action( 'iemotof5_before_entry_header' ); ?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php iemotof5_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php do_action( 'iemotof5_after_entry_header' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php do_action( 'iemotof5_before_entry_content' ); ?>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'iemotof5' ),
				'after'  => '</div>',
			) );
		?>
		<?php do_action( 'iemotof5_after_entry_content' ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php iemotof5_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
