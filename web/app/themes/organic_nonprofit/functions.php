<?php

/*-----------------------------------------------------------------------------------*/
/*	Theme Setup
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'organic_setup' ) ) :

function organic_setup() {

	// Make theme available for translation
	load_theme_textdomain( 'organicthemes', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails
	add_theme_support( 'post-thumbnails' );
	
	add_image_size( 'featured-large', 980, 600, true ); // Large Featured Image
	add_image_size( 'featured-medium', 640, 320, true ); // Medium Featured Image
	add_image_size( 'featured-small', 320, 320, true ); // Small Featured Image
	
	// Custom Header
	$defaults = array(
		'width'                 => 480,
		'height'                => 120,
		'default-image'			=> get_template_directory_uri() . '/images/logo.png',
		'flex-height'           => true,
		'flex-width'            => true,
		'default-text-color'    => '333333',
		'header-text'           => false,
		'uploads'               => true,
	);
	add_theme_support( 'custom-header', $defaults );
	
	// Custom Background
	$defaults = array(
		'default-color'          => 'F9F9F9',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => ''
	);
	add_theme_support( 'custom-background', $defaults );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'header-menu' => __( 'Header Menu', 'organicthemes' ),
	) );
}
endif; // organic_setup
add_action( 'after_setup_theme', 'organic_setup' );

/*-----------------------------------------------------------------------------------------------------//	
	Category ID to Name		       	     	 
-------------------------------------------------------------------------------------------------------*/

function nonprofit_cat_id_to_name( $id ) {
	$cat = get_category( $id );
	if ( is_wp_error( $cat ) )
		return false;
	return $cat->cat_name;
}

/*-----------------------------------------------------------------------------------------------------//	
	Options Framework		       	     	 
-------------------------------------------------------------------------------------------------------*/

if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/' );
	require_once dirname( __FILE__ ) . '/admin/options-framework.php';
}

/*-----------------------------------------------------------------------------------------------------//	
	Register Scripts		       	     	 
-------------------------------------------------------------------------------------------------------*/

if( !function_exists('nonprofit_enqueue_scripts') ) {
	function nonprofit_enqueue_scripts() {
	
		// Enqueue Styles
		wp_enqueue_style( 'organic-style', get_stylesheet_uri() );
		wp_enqueue_style( 'organic-style-mobile', get_template_directory_uri() . '/css/style-mobile.css', array( 'organic-style' ), '1.0' );
		wp_enqueue_style( 'organic-style-ie8', get_template_directory_uri() . '/css/style-ie8.css', array( 'organic-style' ), '1.0' );
		wp_enqueue_style( 'organic-shortcodes', get_template_directory_uri() . '/shortcodes/organic-shortcodes.css', array( 'organic-style' ), '1.0' );
		wp_enqueue_style( 'organic-shortcodes-ie8', get_template_directory_uri() . '/shortcodes/organic-shortcodes-ie8.css', array( 'organic-shortcodes' ), '1.0' );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array( 'organic-shortcodes' ), '1.0' );
		wp_enqueue_style( 'font-awesome-ie7', get_template_directory_uri() . '/css/font-awesome-ie7.css', array( 'font-awesome' ), '1.0' );
		
		// IE Conditional Styles
		global $wp_styles;
		$wp_styles->add_data('organic-style-ie8', 'conditional', 'lte IE 9');
		$wp_styles->add_data('organic-shortcodes-ie8', 'conditional', 'lt IE 9');
		$wp_styles->add_data('font-awesome-ie7', 'conditional', 'lt IE 8');
		
		// Resgister Scripts
		wp_register_script( 'nonprofit-fitvids', get_template_directory_uri() . '/js/jquery.fitVids.js', array( 'jquery' ), '20130729' );
		wp_register_script( 'nonprofit-hover', get_template_directory_uri() . '/js/hoverIntent.js', array( 'jquery' ), '20130729' );
		wp_register_script( 'nonprofit-superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery', 'nonprofit-hover' ), '20130729' );
		wp_register_script( 'nonprofit-retina', get_template_directory_uri() . '/js/retina.js', array( 'jquery' ), '20130729' );
		wp_register_script( 'nonprofit-modal', get_template_directory_uri() . '/js/jquery.modal.min.js', array( 'jquery' ), '20130729' );
	
		// Enqueue Scripts
		wp_enqueue_script( 'nonprofit-html5shiv', get_template_directory_uri() . '/js/html5shiv.js' );
		wp_enqueue_script( 'nonprofit-custom', get_template_directory_uri() . '/js/jquery.custom.js', array( 'jquery', 'nonprofit-superfish', 'nonprofit-fitvids', 'nonprofit-retina', 'nonprofit-modal', 'jquery-masonry', 'jquery-ui-tabs', 'jquery-ui-accordion', 'jquery-ui-dialog' ), '20130729', true );
		wp_enqueue_script( 'nonprofit-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20130729', true );
		
		// IE Conditional Scripts
		global $wp_scripts;
		$wp_scripts->add_data( 'nonprofit-html5shiv', 'conditional', 'lt IE 9' );
		
		// Load Flexslider on front page and slideshow page template
		if( is_home() || is_front_page() || is_page_template('template-slideshow.php') ) {
			wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array( 'jquery' ), '20130729' );
		}
	
		// Load single scripts only on single pages
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		} 
	}
	add_action('wp_enqueue_scripts', 'nonprofit_enqueue_scripts');
}

/*-----------------------------------------------------------------------------------------------------//	
	WooCommerce Integration			       	     	 
-------------------------------------------------------------------------------------------------------*/

// Declare WooCommerce support
add_theme_support( 'woocommerce' );

// Remove WC sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// WooCommerce content wrappers
function mytheme_prepare_woocommerce_wrappers(){
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
    add_action( 'woocommerce_before_main_content', 'mytheme_open_woocommerce_content_wrappers', 10 );
    add_action( 'woocommerce_after_main_content', 'mytheme_close_woocommerce_content_wrappers', 10 );
}
add_action( 'wp_head', 'mytheme_prepare_woocommerce_wrappers' );

function mytheme_open_woocommerce_content_wrappers() {
	?>  
	<div class="container">
		<div class="row">
			<div class="eight columns">
 				<div class="postarea padded">
    <?php
}

function mytheme_close_woocommerce_content_wrappers() {
	?>
	    		</div> <!-- /postarea -->
	    	</div> <!-- /columns -->
	 
	        <div class="four columns">
	        	<div class="sidebar padded">
	        		<?php get_sidebar( 'right-sidebar' ); ?>
	        	</div>
	        </div>
	        
	 	</div> <!-- /row -->
    </div> <!-- /container --> 
    <?php
}

// Add the WC sidebar in the right place
add_action( 'woo_main_after', 'woocommerce_get_sidebar', 10 );

// WooCommerce thumbnail image sizes
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action('init', 'woo_install_theme', 1);
function woo_install_theme() {
 
update_option( 'woocommerce_thumbnail_image_width', '192' );
update_option( 'woocommerce_thumbnail_image_height', '192' );
update_option( 'woocommerce_single_image_width', '600' );
update_option( 'woocommerce_single_image_height', '600' );
update_option( 'woocommerce_catalog_image_width', '140' );
update_option( 'woocommerce_catalog_image_height', '140' );
}

// WooCommerce default product columns
function loop_columns() {
    return 4;
}
add_filter('loop_shop_columns', 'loop_columns');

// WooCommerce remove related products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

/*-----------------------------------------------------------------------------------------------------//	
	Register Sidebars		       	     	 
-------------------------------------------------------------------------------------------------------*/

if ( function_exists('register_sidebars') )
	register_sidebar(array(
		'name'=> __( "Right Sidebar", 'organicthemes' ),
		'id' => 'right-sidebar',
		'before_widget'=>'<div id="%1$s" class="widget %2$s">',
		'after_widget'=>'</div>',
		'before_title'=>'<h6>',
		'after_title'=>'</h6>'
	));
	register_sidebar(array(
		'name'=> __( "Footer Left", 'organicthemes' ),
		'id' => 'footer-one',
		'before_widget'=>'<div id="%1$s" class="widget %2$s">',
		'after_widget'=>'</div>',
		'before_title'=>'<h6>',
		'after_title'=>'</h6>'
	));
	register_sidebar(array(
		'name'=> __( "Footer Mid Left", 'organicthemes' ),
		'id' => 'footer-two',
		'before_widget'=>'<div id="%1$s" class="widget %2$s">',
		'after_widget'=>'</div>',
		'before_title'=>'<h6>',
		'after_title'=>'</h6>'
	));
	register_sidebar(array(
		'name'=> __( "Footer Mid", 'organicthemes' ),
		'id' => 'footer-three',
		'before_widget'=>'<div id="%1$s" class="widget %2$s">',
		'after_widget'=>'</div>',
		'before_title'=>'<h6>',
		'after_title'=>'</h6>'
	));
	register_sidebar(array(
		'name'=> __( "Footer Mid Right", 'organicthemes' ),
		'id' => 'footer-four',
		'before_widget'=>'<div id="%1$s" class="widget %2$s">',
		'after_widget'=>'</div>',
		'before_title'=>'<h6>',
		'after_title'=>'</h6>'
	));
	register_sidebar(array(
		'name'=> __( "Footer Right", 'organicthemes' ),
		'id' => 'footer-five',
		'before_widget'=>'<div id="%1$s" class="widget %2$s">',
		'after_widget'=>'</div>',
		'before_title'=>'<h6>',
		'after_title'=>'</h6>'
	));
	
/*-----------------------------------------------------------------------------------------------------//	
	Comments Function		       	     	 
-------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'organicthemes_comment' ) ) :
function organicthemes_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'organicthemes' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'organicthemes' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 72;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 48;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s <br/> %2$s <br/>', 'organicthemes' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s', 'organicthemes' ), get_comment_date(), get_comment_time() )
							)
						);
					?>
				</div><!-- .comment-author .vcard -->
			</footer>

			<div class="comment-content">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'organicthemes' ); ?></em>
					<br />
				<?php endif; ?>
				<?php comment_text(); ?>
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'organicthemes' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
				<?php edit_comment_link( __( 'Edit', 'organicthemes' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

		</article><!-- #comment-## -->

	<?php
	break;
	endswitch;
}
endif; // ends check for organicthemes_comment()

/*-----------------------------------------------------------------------------------------------------//	
	Custom Excerpt Length		       	     	 
-------------------------------------------------------------------------------------------------------*/

function nonprofit_excerpt_length( $length ) {
	return 38;
}
add_filter( 'excerpt_length', 'nonprofit_excerpt_length', 999 );

function nonprofit_excerpt_more( $more ) {
	return '... <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">'. __('Read More', 'organicthemes') .'</a>';
}
add_filter('excerpt_more', 'nonprofit_excerpt_more');

/*-----------------------------------------------------------------------------------------------------//	
	Add Excerpt To Pages		       	     	 
-------------------------------------------------------------------------------------------------------*/

add_action( 'init', 'nonprofit_add_excerpts_to_pages' );
function nonprofit_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}

/*-----------------------------------------------------------------------------------*/
/*	Pagination Function
/*-----------------------------------------------------------------------------------*/

function get_pagination_links() {
	global $wp_query;
	$big = 999999999;
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'prev_text' => __('«'),
		'next_text' => __('»'),
		'total' => $wp_query->max_num_pages
	) );
}

/*-----------------------------------------------------------------------------------*/
/*	Custom Page Links
/*-----------------------------------------------------------------------------------*/

function wp_link_pages_args_prevnext_add($args) {
    global $page, $numpages, $more, $pagenow;

    if (!$args['next_or_number'] == 'next_and_number') 
        return $args; 

    $args['next_or_number'] = 'number'; // Keep numbering for the main part
    if (!$more)
        return $args;

    if($page-1) // There is a previous page
        $args['before'] .= _wp_link_page($page-1)
            . $args['link_before']. $args['previouspagelink'] . $args['link_after'] . '</a>';

    if ($page<$numpages) // There is a next page
        $args['after'] = _wp_link_page($page+1)
            . $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>'
            . $args['after'];

    return $args;
}

add_filter('wp_link_pages_args', 'wp_link_pages_args_prevnext_add');

/*-----------------------------------------------------------------------------------------------------//	
	Featured Video Meta Box		       	     	 
-------------------------------------------------------------------------------------------------------*/

add_action("admin_init", "admin_init_featurevid");
add_action('save_post', 'save_featurevid');

function admin_init_featurevid(){
	add_meta_box("featurevid-meta", __("Featured Video Embed Code", 'organicthemes'), "meta_options_featurevid", "post", "normal", "high");
}

function meta_options_featurevid(){
	global $post;
	$custom = get_post_custom($post->ID);
	$featurevid = $custom["featurevid"][0];

	echo '<textarea name="featurevid" cols="60" rows="4" style="width:97.6%" />'.$featurevid.'</textarea>';
}

function save_featurevid($post_id){
	global $post;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
	if ( isset($_POST["featurevid"]) ) { 
		update_post_meta($post->ID, "featurevid", $_POST["featurevid"]); 
	}
}

/*-----------------------------------------------------------------------------------------------------//	
	Add Home Link To Custom Menu		       	     	 
-------------------------------------------------------------------------------------------------------*/

function home_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter('wp_page_menu_args', 'home_page_menu_args');

/*-----------------------------------------------------------------------------------------------------//	
	Strip inline width and height attributes from WP generated images		       	     	 
-------------------------------------------------------------------------------------------------------*/
 
function remove_thumbnail_dimensions( $html ) { 
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html ); 
	return $html; 
	}
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 ); 
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

/*-----------------------------------------------------------------------------------------------------//
	Includes
-------------------------------------------------------------------------------------------------------*/

require( get_template_directory() . '/includes/typefaces.php' );
require( get_template_directory() . '/shortcodes/shortcodes.php' );
require( get_template_directory() . '/includes/audio-to-player.php' );