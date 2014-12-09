<?php
/**
 * Hideout functions and definitions
 *
 * @package Hideout
 */

include 'ChromePhp.php';
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'hideout_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hideout_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Hideout, use a find and replace
	 * to change 'hideout' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'hideout', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	  /** Register custom size */
  add_image_size('sidebarimg', 210, 140, true);
  add_image_size('eventboard', 900, 450, true);

  set_post_thumbnail_size( 200, 140, true ); // true is for crop mode

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'hideout' ),
		'secondary' => __( 'Secondary Menu', 'hideout' ),
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
	add_theme_support( 'custom-background', apply_filters( 'hideout_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // hideout_setup
add_action( 'after_setup_theme', 'hideout_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function hideout_widgets_init() {
	register_sidebar( array(
		-
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(

		'id'			=> 'sidebar-home',
		'name'			=> 'Home Sidebar',
		'before_widget' => '<li id="%1$s">',
 		'after_widget' => '</li>',
		'description'	=> ''
	) );
}
add_action( 'widgets_init', 'hideout_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

function load_fonts() {

        wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Oswald:400,300,700|Quattrocento:400,700|Oxygen:300,400,700|Playfair+Display:400,700,900|Lato:300,400,700,900|Merriweather:400,300,700|Berkshire+Swash|Halant:300,400,500,600,700');
        

        wp_enqueue_style( 'googleFonts');
    }

function hideout_scripts() {

	 
	wp_enqueue_style( 'hideout-style', get_stylesheet_uri() );

	wp_enqueue_script( 'hideout-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'angular-js', get_template_directory_uri() . '/angular/bower_components/angular/angular.js', false, NULL);

	wp_enqueue_script( 'angular-sanitize-js', get_template_directory_uri() . '/angular/bower_components/angular-sanitize/angular-sanitize.js', false, NULL);

	wp_enqueue_script( 'the-hideout-app', get_template_directory_uri() . '/angular/thehideoutapp.js');

	wp_enqueue_script( 'custom-filters', get_template_directory_uri() . '/angular/filters/customFilters.js', false, NULL);	

	wp_enqueue_script( 'ui-unique', get_template_directory_uri() . '/angular/bower_components/angular-ui-utils/unique.js', false, NULL);

	wp_enqueue_script( 'dir-pagination', get_template_directory_uri() . '/angular/bower_components/angular-utils-pagination/dirPagination.js', false, NULL);

	wp_enqueue_script( 'custom-directives', get_template_directory_uri() . '/angular/customDirectives.js', false, NULL);

	wp_enqueue_script( 'app-model', get_template_directory_uri() . '/angular/models/appModel.js', false, NULL);

	wp_enqueue_script( 'global-services', get_template_directory_uri() . '/angular/globalServices.js', false, NULL);

	wp_enqueue_script( 'flickr-provider', get_template_directory_uri() . '/angular/components/gallery/flickrProvider.js', false, NULL);

	wp_enqueue_script( 'main-controller', get_template_directory_uri() . '/angular/components/main/mainController.js', false, NULL);

	wp_enqueue_script( 'event-controller', get_template_directory_uri() . '/angular/components/event/eventController.js', false, NULL);

	wp_enqueue_script( 'blog-controller', get_template_directory_uri() . '/angular/components/blog/blogController.js', false, NULL);

	wp_enqueue_script( 'gallery-controller', get_template_directory_uri() . '/angular/components/gallery/galleryController.js', false, NULL);

	wp_enqueue_script( 'test-controller', get_template_directory_uri() . '/angular/components/test/testController.js', false, NULL);

	wp_enqueue_script( 'hideout-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_register_script( 'bootstrap-js', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '3.2.0', true );

	wp_register_style( 'bootstrap-css', get_template_directory_uri() . '/bootstrap/css/bootstrap.css', array(), '3.2.0', 'all' );

	wp_enqueue_script( 'bootstrap-js' );

	wp_enqueue_style( 'bootstrap-css' );

	wp_enqueue_style( 'hideout-custom-style', get_template_directory_uri() . '/css/hideout.css' );

	// Load the global scripts first, as some of them are called from later scripts.

	wp_register_script('global-scripts', get_template_directory_uri() . '/js/global-scripts.js');
   
	wp_enqueue_script('global-scripts');
	
	wp_register_script('front-page-scripts', get_template_directory_uri() . '/js/front-page-scripts.js');



	// Enqueue Home Page Scripts
	if (is_page_template( 'my-templates/home-page.php' )) {
	  wp_enqueue_script('front-page-scripts');
	} 

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action('wp_print_styles', 'load_fonts');

add_action( 'wp_enqueue_scripts', 'hideout_scripts' );

	/**
	 * PLUGINS
	**/

// Extend custom fields plugin to allow time

add_action('acf/register_fields', 'my_register_fields');

function my_register_fields()
{
    include_once('/wp-content/plugins/acf-date_time_picker/acf-date_time_picker.php');
}

	// Uncommented the following as is filtering out html data on posts.
// remove_filter('the_content', 'wpautop');

/* Add custom fields to REST API
 * RESPECT to: https://gist.github.com/rileypaulsen
*/

function wp_api_encode_acf($data,$post,$context){
	// check if custom fields exist for the post
	$custom_fields_exist = get_fields($post['ID']); 
	if ($custom_fields_exist) {
		$data['meta'] = array_merge($data['meta'], get_fields($post['ID']));
		$data = array_merge($data, $data['meta']);
	}
	return $data;
}
 
if( function_exists('get_fields') ){
	add_filter('json_prepare_post', 'wp_api_encode_acf', 10, 3);
}

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

// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');
