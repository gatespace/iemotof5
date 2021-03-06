<?php
/**
 * The template for displaying all single posts.
 *
 * @package Iemoto Foundation 5
 */

get_header(); ?>

	<div id="primary" class="content-area large-8 medium-8 small-12 columns">
		<?php do_action( 'iemotof5_before_primary' ); ?>
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php iemotof5_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
		<?php do_action( 'iemotof5_after_primary' ); ?>
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
