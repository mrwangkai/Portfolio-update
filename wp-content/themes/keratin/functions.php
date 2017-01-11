<?php
/**
 * Keratin functions and definitions
 *
 * @package Keratin
 */

if ( ! function_exists( 'keratin_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function keratin_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Keratin, use a find and replace
	 * to change 'keratin' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'keratin', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 200,
		'width'       => 580,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'keratin-featured-image',         1576, 1182, true );
	add_image_size( 'keratin-featured-image-archive', 776, 584, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'keratin' ),
	) );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'editor-style.css', keratin_google_fonts_url() ) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'gallery', 'image', 'link', 'quote', 'video',
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'keratin_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

}
endif; // keratin_setup
add_action( 'after_setup_theme', 'keratin_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function keratin_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'keratin_content_width', 343 );
}
add_action( 'after_setup_theme', 'keratin_content_width', 0 );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function keratin_widgets_init() {

	// Widget Areas
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'keratin' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'keratin_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function keratin_scripts() {

	/**
	 * Enqueue JS files
	 */

	// Masonry
	wp_enqueue_script( 'masonry' );

	// Modernizr
	wp_enqueue_script( 'keratin-modernizr', get_template_directory_uri() . '/js/modernizr.js', array( 'jquery' ), '2.7.1', true );

	// Superfish Menu
	wp_enqueue_script( 'keratin-hover-intent', get_template_directory_uri() . '/js/hover-intent.js', array( 'jquery' ), 'r7', true );
	wp_enqueue_script( 'keratin-superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ), '1.7.5', true );

	// Fitvids
	wp_enqueue_script( 'keratin-fitvids', get_template_directory_uri() . '/js/fitvids.js', array( 'jquery' ), '1.0.3', true );

	// Comment Reply
	if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Keyboard image navigation support
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keratin-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20140127', true );
	}

	// Custom Script
	wp_enqueue_script( 'keratin-custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '1.0', true );

	/**
	 * Enqueue CSS files
	 */

	// Bootstrap
	wp_enqueue_style( 'keratin-bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );

	// Fontawesome
	wp_enqueue_style( 'keratin-fontawesome', get_template_directory_uri() . '/css/font-awesome.css' );

	// Google Fonts
	wp_enqueue_style( 'keratin-fonts', keratin_google_fonts_url(), array(), null );

	// Theme Stylesheet
	wp_enqueue_style( 'keratin-style', get_stylesheet_uri() );

}
add_action( 'wp_enqueue_scripts', 'keratin_scripts' );

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
