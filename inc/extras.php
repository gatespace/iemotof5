<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Iemoto Foundation 5
 */

/**
 * wp_nav_menu() walker.
 *
 */

class iemotof5_Walker_Nav_Menu extends Walker_Nav_Menu {

function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
	$element->has_children = !empty( $children_elements[$element->ID] );
	$element->classes[] = ( $element->current || $element->current_item_ancestor ) ? 'active' : '';
	$element->classes[] = ( $element->has_children && $max_depth !== 1 ) ? 'has-dropdown' : '';
	
	parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
}

function start_lvl( &$output, $depth = 0, $args = array() ) {
	$output .= "\n<ul class=\"sub-menu dropdown\">\n";
}
} // iemotof5_Walker_Nav_Menu


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function iemotof5_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'iemotof5_body_classes' );

if ( ! function_exists( '_wp_render_title_tag' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function iemotof5_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'iemotof5' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'iemotof5_wp_title', 10, 2 );
endif;

if ( ! function_exists( '_wp_render_title_tag' ) ) :
	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function iemotof5_render_title() {
		echo '<title>' . wp_title( '|', false, 'right' ) . "</title>\n";
	}
	add_action( 'wp_head', 'iemotof5_render_title' );
endif;

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function iemotof5_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'iemotof5_setup_author' );

/**
 * Custom search form.
 *
 * @param string $form form HTML.
 * @return string form HTML.
 */
function iemotof5_search_form( $form ) {

	$form = '<form role="search" method="get" class="search-form" action="'.home_url( '/' ).'" >
	<div class="row collapse">
		<div class="small-9 columns">
		<label>
			<span class="screen-reader-text">' . _x( 'Search for:', 'label', 'iemotof5' ) . '</span>
			<input type="search" class="search-field" placeholder="' . _x( 'Search &hellip;', 'placeholder', 'iemotof5' ) . '" value="' . get_search_query() . '" name="s" title="Search for:" />
		</label>
		</div>
		<div class="small-3 columns">
			<input type="submit" class="search-submit button postfix" value="'. esc_attr__( 'Search', 'iemotof5') .'" />
		</div>
	</div>
	</form>';

	return $form;
}
add_filter( 'get_search_form', 'iemotof5_search_form' );

/**
 * Custom password form.
 *
 * @param string $form password form HTML.
 * @return string password form HTML.
 */
function iemotof5_password_form( $output ) {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$output = '
	<p>' . __( 'This content is password protected. To view it please enter your password below:', 'iemotof5' ) . '</p>
	<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post"><div class="row collapse">
	<div class="small-3 columns"><label for="' . $label . '" class="prefix">' . __( 'Password:', 'iemotof5' ) . '</label></div>
	<div class="small-6 columns"><input name="post_password" id="' . $label . '" type="password" size="20" /></div>
	<div class="small-3 columns"><input type="submit" class="button postfix" name="Submit" value="' . esc_attr__( 'Submit', 'iemotof5' ) . '" /></div>
	</div></form>
	';

	return $output;
}
add_filter( 'the_password_form', 'iemotof5_password_form' );