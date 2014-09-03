<?php
/**
 * Iemoto functions and definitions
 *
 * @package Iemoto Foundation 5
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'iemotof5_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function iemotof5_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Iemoto, use a find and replace
	 * to change 'iemotof5' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'iemotof5', get_template_directory() . '/languages' );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style();

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'iemotof5' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'iemotof5_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // iemotof5_setup
add_action( 'after_setup_theme', 'iemotof5_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function iemotof5_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'iemotof5' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'iemotof5_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function iemotof5_scripts() {

	$iemotof5_theme_data = wp_get_theme();
	$iemotof5_theme_ver  = $iemotof5_theme_data->get( 'Version' );
	$foundation_ver  = '5.1.0';

	$iemotof5_stylesheet     = get_stylesheet_uri();

	if ( defined( 'WP_DEBUG' ) && ( WP_DEBUG == true ) ) { // WP_DEBUG = ture
		$iemotof5_stylesheet     = get_template_directory_uri() . '/css/style.css';
	}

	// style
	wp_enqueue_style(
		'iemotof5-style',
		$iemotof5_stylesheet,
		array(),
		$iemotof5_theme_ver
	);

	// script
	wp_enqueue_script(
		'modernizr',
		get_template_directory_uri() . '/bower_components/modernizr/modernizr.js',
		array(),
		'v2.8.3',
		false
	);

	wp_enqueue_script(
		'iemotof5-skip-link-focus-fix',
		get_template_directory_uri() . '/js/skip-link-focus-fix.js',
		array(),
		'20130115',
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script(
		'foundation',
		get_template_directory_uri() . '/bower_components/foundation/js/foundation.min.js',
		array( 'jquery' ),
		$foundation_ver,
		true
	);

	wp_enqueue_script(
		'iemotof5-script',
		get_stylesheet_directory_uri() . '/js/iemotof5.min.js',
		array( 'foundation' ),
		$iemotof5_theme_ver,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'iemotof5_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
