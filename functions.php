<?php 


define('APP_DIR', 'app');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));



if (!defined('WP_CORE_INCLUDE_PATH')) {
	define('WP_CORE_INCLUDE_PATH', ROOT . DS . 'Lib');
}

require(ROOT .DS . APP_DIR .DS ."load.php" );
// require ROOT 

remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
add_filter( 'show_admin_bar', '__return_false' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
function load_setup_theme()
{
	load_theme_textdomain( 'skull', get_template_directory() . '/languages' );	
}

add_action('after_setup_theme', 'load_setup_theme');




register_nav_menus(array(
	'header' => 'Menu principal (header)', 
	'footer' => 'Menu Pied de page (footer)'
	));

if ( function_exists('register_sidebar') ) register_sidebar(
	array(
		'name' => 'Sidebar Lateral',
		'id' => 'sidebar-lateral',
		'before_title'  => '<h3 class="widgettitle">',
	'after_title'   => '</h3>'
		)
	

	);
	if ( function_exists('register_sidebar') ) register_sidebar(
		array('name'=>'Sidebar footer', 
			'id'=> 'sidebar-footer')
		

		);
		
//$PiiWidget= new PiiWidget(); 



add_action('widgets_init',function(){
     return register_widget('Pii_Widget');
});
