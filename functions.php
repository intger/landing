<?php
/**
 * sellics-challenge functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package sellics-challenge
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'code_challange_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function code_challange_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on sellics-challenge, use a find and replace
		 * to change 'code-challange' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'code-challange', get_template_directory() . '/languages' );

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
				'menu-1' => esc_html__( 'Primary', 'code-challange' ),
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
				'code_challange_custom_background_args',
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
add_action( 'after_setup_theme', 'code_challange_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function code_challange_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'code_challange_content_width', 640 );
}
add_action( 'after_setup_theme', 'code_challange_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function code_challange_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'code-challange' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'code-challange' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'code_challange_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function code_challange_scripts() {
	wp_enqueue_style( 'code-challange-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'code-challange-style', 'rtl', 'replace' );

	wp_enqueue_script( 'code-challange-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script('jquery');

	wp_enqueue_script( 'code-challange-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), _S_VERSION, true );
	/* Enqueue custom js file */
	wp_enqueue_script( 'custom-functions', get_template_directory_uri() . '/js/custom-functions.js', array(), _S_VERSION, true );
    wp_localize_script( 'custom-functions', 'gpAjax', array(
        'ajaxURL'           => admin_url( 'admin-ajax.php' ),
        'homeURL'           => get_home_url(),
        'hubspotFormURL'    => "https://api.hsforms.com/submissions/v3/integration/submit/7688750/3f1b8237-17d4-4862-8583-a8de8ba11e59"
        ) );


    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'code_challange_scripts' );

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

/* SVG on wordpress upload */
function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
  }
  add_filter('upload_mimes', 'cc_mime_types');


/* ACF option page  */

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

add_action( "wp_ajax_nopriv_saveFormDataToDB", 'saveFormDataToDB' );
add_action( "wp_ajax_saveFormDataToDB",        'saveFormDataToDB' );

function saveFormDataToDB() {
    global $wpdb;

    // Form data to post
    $Email 			= $_REQUEST['email'];
    $Firstname 		= $_REQUEST['firstname'];
    $Lastname		= $_REQUEST['lastname'];
    $Tastes		    = $_REQUEST['ice_cream'];
    $Servings 		= $_REQUEST['servings'];
    $Months_supply	= $_REQUEST['month_supply'];


    $result = $wpdb->insert('form', array(
        'email'         => $Email,
        'firstname'     => $Firstname,
        'lastname'      => $Lastname,
        'tastes'        => $Tastes,
        'servings'      => $Servings,
        'month_supply'  => $Months_supply
    ));

    if (!$result) {
        wp_send_json_error(array(
            "success" => false,
            "error_message" => mysqli_error()
        ));
    }
    else {
        wp_send_json_success(array(
            "success" => true
        ));
    }
}