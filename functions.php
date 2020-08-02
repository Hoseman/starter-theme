<?php
/**
 * Starter Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Starter_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'starter_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function starter_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Starter Theme, use a find and replace
		 * to change 'starter-theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'starter-theme', get_template_directory() . '/languages' );

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
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'starter-theme' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'starter_theme_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'starter_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function starter_theme_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'starter_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'starter_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function starter_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'starter-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'starter-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'starter_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function starter_theme_scripts() {
	wp_enqueue_style( 'starter-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'starter-theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'starter-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'starter_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/* enqueue custom styles */
function ah_enqueue(){
    $uri = get_template_directory_uri();
	wp_register_style('ah_google_fonts_1', 'https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap');
	wp_register_style('ah_google_fonts_2', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700&display=swap');
    wp_register_style('ah_bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css');
    wp_register_style('ah_font_awesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_register_style('ah_main', $uri . '/css/main.css');
	wp_register_style('ah_owl', $uri . '/css/owl.carousel.min.css');

	wp_enqueue_style('ah_google_fonts_1');
	wp_enqueue_style('ah_google_fonts_2');
    wp_enqueue_style('ah_bootstrap');
    wp_enqueue_style('ah_font_awesome');
	wp_enqueue_style('ah_main');
	wp_enqueue_style('ah_owl');

    wp_register_script('ah_jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js', [], false, true);
    wp_register_script('ah_popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', [], false, true);
    wp_register_script('ah_bootstrapjs', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', [], false, true);
	wp_register_script('ah_mainjs', $uri . '/js/main.js', [], false, true);
	wp_register_script('ah_owljs', $uri . '/js/owl.carousel.min.js', [], false, true);

    wp_enqueue_script('ah_jquery');
    wp_enqueue_script('ah_popper');
    wp_enqueue_script('ah_bootstrapjs');
	wp_enqueue_script('ah_mainjs');
	wp_enqueue_script('ah_owljs');
}

add_action( 'wp_enqueue_scripts', 'ah_enqueue' );
/* enqueue custom styles */


/* Enable SVG Support */
function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
  }
  add_filter('upload_mimes', 'cc_mime_types');
  /* Enable SVG Support */


// 1. download the navwalker class from: https://github.com/wp-bootstrap/wp-bootstrap-navwalker
// 2. add the class-wp-bootstrap-navwalker.php to the root of the theme folder 
// 3. add require once to include the navwalker class (below)
// https://code.tutsplus.com/tutorials/how-to-integrate-a-bootstrap-navbar-into-a-wordpress-theme--wp-33410
require_once('class-wp-bootstrap-navwalker.php');