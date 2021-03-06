<?php
if ( !isset( $content_width ) )
	$content_width = 620;

if ( !function_exists( 'dw_minion_jb_setup' ) ) {
	function dw_minion_jb_setup() {
		load_theme_textdomain( 'dw-minion-jb', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-formats', array( 'gallery', 'video', 'quote', 'link' ) );
		add_theme_support( 'post-thumbnails' );
		add_editor_style();
	}
}
add_action( 'after_setup_theme', 'dw_minion_jb_setup' );

function dw_minion_jb_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'dw-minion-jb' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'dw_minion_jb_widgets_init' );

function dw_minion_jb_scripts() {
	wp_enqueue_style('dw-minion-jb-main', get_template_directory_uri() . '/assets/css/main.css' ); // green
	wp_enqueue_style( 'dw-minion-jb-style', get_stylesheet_uri() );
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr-2.6.2.min.js' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'dw-minion-jb-main-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), false, true );
	wp_enqueue_script( 'bootstrap-transition', get_template_directory_uri() . '/assets/js/bootstrap-transition.js', array('jquery'), false, true );
	wp_enqueue_script( 'bootstrap-carousel', get_template_directory_uri() . '/assets/js/bootstrap-carousel.js', array('jquery'), false, true );
	wp_enqueue_script( 'bootstrap-collapse', get_template_directory_uri() . '/assets/js/bootstrap-collapse.js', array('jquery'), false, true );
	wp_enqueue_script( 'bootstrap-tab', get_template_directory_uri() . '/assets/js/bootstrap-tab.js', array('jquery'), false, true );
}
add_action( 'wp_enqueue_scripts', 'dw_minion_jb_scripts' );

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/customizer.php';

// features image on social share
add_action('wp_head', 'minion_features_image_as_og_image');
function minion_features_image_as_og_image() {
	global $post;
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium'); 
	?><meta property="og:image" content="<?php echo $thumb[0] ?>" /><?php
}

add_action( 'tgmpa_register', 'alx_plugins' );