<?php
/**
 * longhoa functions and definitions
 *
 * @package longhoa
 * @since longhoa 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since longhoa 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

/*
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.php' );

if ( ! function_exists( 'longhoa_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since longhoa 1.0
 */
function longhoa_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on longhoa, use a find and replace
	 * to change 'longhoa' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'longhoa', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'longhoa' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Adding image sizes support
	 */
	add_image_size( '650x250', 650, 250, true );
	add_image_size( '200x200', 200, 200, true );
}
endif; // longhoa_setup
add_action( 'after_setup_theme', 'longhoa_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for WordPress 3.3
 * using feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Remove the 3.3 support when WordPress 3.6 is released.
 *
 * Hooks into the after_setup_theme action.
 */
function longhoa_register_custom_background() {
	$args = array(
		'default-color' => 'ffffff',
		'default-image' => '',
	);

	$args = apply_filters( 'longhoa_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		if ( ! empty( $args['default-image'] ) )
			define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_custom_background();
	}
}
add_action( 'after_setup_theme', 'longhoa_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since longhoa 1.0
 */
function longhoa_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'longhoa' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'longhoa_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function longhoa_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'fancybox-css', get_template_directory_uri() . '/inc/fancybox/jquery.fancybox.css', array(), '2.1.4', 'screen' );
	wp_enqueue_style( 'bxslider-css', get_template_directory_uri() . '/inc/bxslider/jquery.bxslider.css', array(), '4.0', 'screen' );
	wp_enqueue_style( 'style-css', get_template_directory_uri() . '/css/style.css' );

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/inc/fancybox/jquery.fancybox.pack.js', array( 'jquery' ), '2.1.4', true );
	wp_enqueue_script( 'bxslider', get_template_directory_uri() . '/inc/bxslider/jquery.bxslider.min.js', array( 'jquery' ), '4.0', true);
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.min.js', array( 'jquery', 'fancybox', 'bxslider' ), '1.0', true);
	//wp_enqueue_script( 'prefix-free', get_template_directory_uri() . '/js/prefixfree.min.js', array( 'jquery' ), '1.0.7', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'longhoa_scripts' );


/**
 * Add excerpt to page
 */
function longhoa_add_excerpts_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'longhoa_add_excerpts_to_pages' );

/**
 * Change the excerpt length
 */
function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999);
/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Test if a page is a subpage of another page
 * @param mixed $parent - ID, title or slug of parent page
 * @return bool True if current page's parent is same as $parent, false otherwise
 * reference: query.php
 */
function is_subpage( $parent = '' ) {
	global $post;
	if ( !is_page() )
		return false;

	$page_parents = get_post_ancestors( $post->ID );
	/* Get the top Level page->ID count base 1, array base 0 so -1 */
	$parent_id = ( $page_parents ) ? $page_parents[ count( $page_parents )-1 ]: $post->ID;

	/* Get the parent and set the $class with the page slug (post_name) */
	$parent_page = get_page( $parent_id );

	$parent = (array) $parent;

	if ( in_array( $parent_page->ID, $parent ) ) {
		return true;
	}
	elseif ( in_array( $parent_page->post_title, $parent ) ) {
		return true;
	}
	elseif ( in_array( $parent_page->post_name, $parent ) ) {
		return true;
	}
	return false;
}

/**
 * Display gallery images
 * @param string customized class name for wrapper
 * @return html
 *
 */

function get_the_gallery( $class = '' ) {
	$html = '';
	if ( function_exists( 'get_field' ) ){
		if ( get_field( 'gallery' ) ) {
			$html .= '<section class="gallery ' . $class . '">';
			$images = get_field( 'gallery' );
			foreach ( $images as $image ) {
				$html .= '<div class="gallery-image">';
				$thumb_image = wp_get_attachment_image( $image['image'], 'thumbnail' );
				$full_image = wp_get_attachment_image_src( $image['image'], 'large' );
				$html .= '<a href="' . $full_image[0] . '" title="' . $image['image_title'] . '">';
				$html .= $thumb_image;
				$html .= '</a>';
				$html .= '</div> <!-- .gallery-image -->';
			}
			$html .= '</section><!-- .gallery .' . $class . ' -->';
		}
	}
	return $html;
}

/**
 * Get Rows
 * @param string class(es) for the section (multiple classes possible separated by a single white space)
 * @param string class for single item
 * @return html
 */

function get_rows( $class = '', $single_class = '' ) {
	$html = '';
	if ( function_exists( 'get_field' ) ) {
		if ( get_field( 'rows' ) ) {
			$html .= '<section class="rows ' . $class . '">';
			$rows = get_field( 'rows' );
			foreach( $rows as $row ) {
				$html .= '<div class="row-single ' . $single_class . '">';
				if ( $row['image'] ) {
					$thumb_image = wp_get_attachment_image( $row['image'], '200x200' );
					$full_image = wp_get_attachment_image_src( $row['image'], 'large' );
					$html .= '<a href="' . $full_image[0] . '" title="' . $row['title'] . '">';
					$html .= $thumb_image;
					$html .= '</a>';
				}
				if ( $row['title'] ) {
					$html .= '<h1 class="row-title">' . $row['title'] . '</h1>';
				}
				if ( $row['text']) {
					$html .= '<div class="row-content">' . $row['text'] . '</div>';
				}
				$html .= '</div><!-- .row-single -->';
			}
			$html .= '</section><!-- .rows -->';
		}
	}
	return $html;
}

/**
 * Display team members
 * @param string class(es) for the section (multiple classes possible separated by a single white space)
 * @return html
 */
function get_the_team( $class = '' ) {
	$html = '';
	$default_icon_url = 'http://www.gravatar.com/avatar?d=mm&s=200';
	if ( function_exists( 'get_field' ) ) {
		if ( get_field( 'members' ) ) {
			$html .= '<section class="team ' . $class . '">';
			$members = get_field( 'members' );
			foreach ( $members as $member ) {
				$html .= '<div class="member">';
				if ( $member['image'] ) {
					$html .= wp_get_attachment_image( $member['image'], '200x200' );
				} else {
					$html .= '<img src="' . $default_icon_url . '" width="200" height="200" alt="' . $member['name'] . '"/>';
				}
				//$html .= '<div class="member-details">';
				$html .= '<hgroup>';
				$html .= '<h1 class="member-name">' . $member['name'] . '</h1>';
				$html .= '<h2 class="member-position">' . $member['position'] . '</h2>';
				$html .= '</hgroup>';
				$html .= '<p>' . $member['description'] . '</p>';
				//$html .= '</div><!-- .member-details -->';
				$html .= '</div><!-- .member -->';
			}
			$html .= '</section><!-- .team .' . $class . '-->';
		}
	}
	return $html;
}

/**
 * Get the children pages of current page
 * @return html
 *
 */
function get_the_projects() {
	$html = '';
	global $post;

	// set up the objects needed
	$children = new WP_Query( array(
			'post_type'		=> 'page',
			'post_parent'	=> $post->ID,
			'order'			=> 'ASC',
			'orderby'		=> 'menu_order'
		) );

	if ( $children->have_posts() ) {
		$html .= '<div class="projects">';
		while ( $children->have_posts() ) {
			$children->the_post();
			$html .= '<a href="' . get_permalink() . '">';
			$html .= '<div class="project">';
			$html .= get_the_post_thumbnail( $post->ID, '200x200' );
			$html .= '<h1>' . get_the_title() . '</h1>';
			$html .= '<p>' . get_the_excerpt() . '</p>';
			$html .= '</div><!-- .project -->';
			$html .= '</a>';
		}
		$html .= '</div><!-- .projects -->';
	}

	wp_reset_postdata();
	return $html;
}

/**
 * Credits
 *
 */
function longhoa_footer_credits() {
	echo __( 'Designed and Developed by ', 'longhoa' );
	echo '<a href="http://tridnguyen.com/" title="' . esc_attr( 'Tri Nguyen', 'longhoa' ) . '">Tri Nguyen</a> ©' . strftime( '%Y' ) . '.';
	return;
}
add_action( 'longhoa_credits', 'longhoa_footer_credits' );

/**
 * Get the background image name array
 * @return array List of different background image names for the page according to their sizes
 * ['full' => 'pagename-bg-full.jpg', 'medium' => 'pagename-bg-medium.jpg', 'small' => 'pagename-bg-small.jpg']
 */
function get_background_images() {
	$background_images = array();
	$full_suffix = '-bg-full.jpg';
	$medium_suffix = '-bg-medium.jpg';
	$small_suffix = '-bg-small.jpg';
	$background_name = '';

	if ( is_front_page() ) {
		$background_name = 'homepage';
	}
	else if ( is_page( 'hoan-canh' ) || is_subpage( 'hoan-canh' ) ) {
		$background_name = 'hoancanh';
	}
	else if ( is_page( 'mo-hinh' ) || is_subpage( 'mo-hinh') ) {
		$background_name = 'mohinh';
	}
	else if ( is_page( 'cac-du-an' ) || is_subpage( 'cac-du-an') ) {
		$background_name = 'cacduan';
	}
	else if ( is_page( 'tinh-nguyen') || is_subpage( 'tinh-nguyen') ) {
		$background_name = 'tinhnguyen';
	}
	else if ( is_page( 'luu-but') || is_subpage( 'luu-but') ) {
		$background_name = 'luubut';
	}
	else {
		$background_name = 'homepage';
	}

	$background_images['full'] = $background_name . $full_suffix;
	$background_images['medium'] = $background_name . $medium_suffix;
	$background_images['small'] = $background_name . $small_suffix;

	return $background_images;
}
?>
