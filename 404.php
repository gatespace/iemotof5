<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Iemoto Foundation 5
 */

get_header(); ?>

	<div id="primary" class="content-area small-12 columns">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'iemotof5' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'iemotof5' ); ?></p>

					<?php get_search_form(); ?>

					<div class="row">
					<div class="large-3 small-12 columns"><?php the_widget( 'WP_Widget_Recent_Posts' ); ?></div>

					<?php if ( iemoto_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
					<div class="large-3 small-12 columns"><div class="widget widget_categories">
						<h2 class="widget-title"><?php _e( 'Most Used Categories', 'iemotof5' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div><!-- .widget --></div>
					<?php endif; ?>

					<div class="large-3 small-12 columns">
					<?php
						/* translators: %1$s: smiley */
						$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'iemotof5' ), convert_smilies( ':)' ) ) . '</p>';
						the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
					?>
					</div>

					<div class="large-3 small-12 columns"><?php the_widget( 'WP_Widget_Tag_Cloud' ); ?></div>
					</div>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
