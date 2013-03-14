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
	'top-header' => 'Menu haut de page (top header)',	
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
function setup_theme_admin_menu()
{
	add_submenu_page( "themes.php", "Element du Front" , "Options du theme", "manage_options", "font-elements-pages", "theme_front_page_settings" ); 
}


function theme_front_page_settings()
{

//var_dump($_SERVER['SCRIPT_NAME'].$_SERVER['QUERY_STRING']); 
if(isset($_POST['update_setting_skull'])){


$i=0; 
foreach($_POST as $k => $v) { 
	 

	if (isset($_POST['slider-image-id-'.$i])) {

		if(!empty($_POST['slider-image-id-'.$i])){

			$slide[]= $_POST['slider-image-id-'.$i]; 
		}
		
	}
	$i++; 
}
 

	if(update_option("skull_element_slider", json_encode($slide)))
	{

	echo '<div id="message" class="updated">Sauvegarde effectué</div>'  ;
		
	}  
}

$image_library_url = get_upload_iframe_src( 'image', null, 'computer' );
$image_library_url = remove_query_arg( array('TB_iframe'), $image_library_url );
$image_library_url = add_query_arg( array( 'context' => '', 'TB_iframe' => 1 ), $image_library_url );
    

	if (is_admin()) {  
    wp_enqueue_script('jquery-ui-sortable');  
} 
	echo '<div class="front-page-element">  
    <div class="thumbnail-image">  '; 
      if (has_post_thumbnail($post_id)) : 
            get_the_post_thumbnail($post_id, 'tutorial-thumb-size'); 
         endif; 
  echo '
        <a class="title" href="'.get_permalink($post_id).'">'. $element_post->post_title.'</a>  
    </div>  
</div> '; 
	echo '<div class="wrap"> '.screen_icon('themes').' <h2>Page d\'option du theme</h2>  '; 
	echo '<form method="POST" action="">';  
        

       echo ' <h3>Ajouter un slider</h3>  
  
        <ul id="featured-posts-list">  '; 

 $json =json_decode(get_option("skull_element_slider"));  
 $liste  = 0 ; 
 if(isset($json)){
foreach ($json as $k => $v) {
	# code...

 echo '<li class="front-page-element" id=""   
        ">  
        <label for="slider-image-id">Image # '.$k.':</label>  
        
      <input type="text" value="'.$v.'" name="slider-image-id-'.$k.'" class="inputthickbox'.$k.'">
<a title="Ajouter une image pour le slider" href="'.esc_url(str_replace('context', 'context=inputthickbox'.$k, $image_library_url)).'" id="set-default-image" class="button thickbox">Ajouter une image </a>

        <a href="#" class="remove">Remove</a>  
    </li>  '; 

}
$liste = $k+1  ; 

}
echo '
        </ul>  
        
        <input type="hidden" name="slider-image-id-max" />  
        <input type="hidden" name="update_setting_skull" value="yes" />  
  
        <a href="#" id="add-featured-post">Ajouter une image</a>     
    <p>  
    <input type="submit" value="Save settings" class="button-primary"/>  
</p> 

    </form>  
      
    <li class="front-page-element" id="front-page-element-placeholder"   
        style="display:none;">  
        <label for="slider-image-id">Image # 0:</label>  
        
      <input type="text" value="" name="slider-image-id " class="inputthickbox">
<a title="Ajouter une image pour le slider" href="'.esc_url( $image_library_url ).'" id="set-default-image" class="button thickbox">Ajouter une image </a>

        <a href="#" class="remove">Remove</a>  
    </li>  
  
</div> 

    <script type="text/javascript">  
        var elementCounter = '.$liste.';  
        jQuery(document).ready(function() {             
            jQuery("#add-featured-post").click(function() {  
                var elementRow = jQuery("#front-page-element-placeholder").clone();  
                var newId = "front-page-element-" + elementCounter;  
                     
                elementRow.attr("id", newId);  
                elementRow.show();  
                      
                var inputField = jQuery("input", elementRow);  
                inputField.attr("name", "slider-image-id-" + elementCounter);   
                inputField.attr("class", "inputthickbox" + elementCounter);   
                     
                var labelField = jQuery("label", elementRow);  
                labelField.attr("for", "slider-image-id-" + elementCounter);   
      labelField.html("Image #"+elementCounter+":"); 

      var thickbox = jQuery("a", elementRow);  
                thickbox.attr("id", "set-default-image-" + elementCounter);
                  // alert(  thickbox.attr("href")); 
                 thickbox.attr("href",  thickbox.attr("href").replace("context", "context=inputthickbox"+ elementCounter)); 

                elementCounter++;  
                jQuery("input[name=slider-image-id-max]").val(elementCounter);  
                      
                jQuery("#featured-posts-list").append(elementRow);  
                     
 				
                return false;  
        



            });           
       

     
		    
		jQuery("#TB_window").load(function(){
			alert("ok"); 
		jQuery(this).contents().find(".savesend input").live(\'click\', function (e){
				alert("ok"); 
			});
});
 jQuery(".remove").live(\'click\', function() {  
      
       jQuery(this).parent("li").remove();  
        return false;  
    }); 


    jQuery("#featured-posts-list").sortable( {  
        stop: function(event, ui) {  
            var i = 0;  
      
            jQuery("li", this).each(function() {  
                setElementId(this, i);                      
                i++;  
            });  
                          
            elementCounter = i;  
            jQuery("input[name=element-max-id]").val(elementCounter);  
        }  
    });  

        });  


 
function removeElement(element) {  
        jQuery(element).remove();  
    }  
    </script>  
 '; 
}

function setup_theme_features() {  

	 wp_enqueue_style('thickbox');
	 wp_enqueue_script('thickbox');
   
}  
add_action("admin_menu", "setup_theme_admin_menu") ; 
add_action('after_setup_theme', 'setup_theme_features');  


add_filter('media_upload_tabs', 'wp_skull_image_tabs', 10, 1);
 
function wp_skull_image_tabs($_default_tabs) {
    unset($_default_tabs['type']);
    unset($_default_tabs['type_url']);
    unset($_default_tabs['gallery']);
         
    return($_default_tabs);
}

add_filter('attachment_fields_to_edit', 'my_plugin_action_button', 20, 2);
add_filter('media_send_to_editor', 'my_plugin_image_selected', 10, 3);
 
function my_plugin_action_button($form_fields, $post) {
 
        $send = "
        <input type='submit' class='button sendto' name='send[$post->ID]' value='" . esc_attr__( 'Ajouter l\'image' ) . "' />  ";
 
    $form_fields['buttons'] = array('tr' => "\t\t<tr class='submit'><td></td><td class='savesend'>$send</td></tr>\n");
    $form_fields['context'] = array( 'input' => 'hidden', 'value' => $_GET['context'] );
    return $form_fields;
}
 
function my_plugin_image_selected($html, $send_id, $attachment) {
    ?>
    <script type="text/javascript"  >
    /* <![CDATA[ */
    var win = window.dialogArguments || opener || parent || top;
  
 
	win.jQuery("#featured-posts-list .<?php echo $attachment['context']?>").val('<?php echo($attachment['url']);?>'); 
    
    // submit the form
    win.jQuery( '#skull-gallery_options' ).submit();

    /* ]]> */
    </script>
    <?php
    exit();
}
if (check_upload_image_context('skull-default-image')) {
       add_filter('media_upload_tabs', 'skull_image_tabs', 10, 1);
        add_filter('attachment_fields_to_edit', 'skull_action_button', 20, 2);
        add_filter('media_send_to_editor', 'skull_image_selected', 10, 3);
}
 
function add_my_context_to_url($url, $type) {
    if ($type != 'image') return $url;
    if (isset($_REQUEST['context'])) {
        $url = add_query_arg('context', $_REQUEST['context'], $url);
    }
    return $url;   
}
     
function check_upload_image_context($context) {
    if (isset($_REQUEST['context']) && $_REQUEST['context'] == $context) {
        add_filter('media_upload_form_url', array($this, 'add_my_context_to_url'), 10, 2);
        return TRUE;
    }
    return FALSE;
}