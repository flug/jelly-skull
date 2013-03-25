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


/** BY SEOMIX  **/
//http://www.seomix.fr/fil-dariane-chemin-navigation/
//***Fil d'arianne
//Récupérer les catégories parentes
function myget_category_parents($id, $link = false,$separator = '/',$nicename = false,$visited = array()) {
  $chain = '';$parent = &get_category($id);
    if (is_wp_error($parent))return $parent;
    if ($nicename)$name = $parent->name;
    else $name = $parent->cat_name;
    if ($parent->parent && ($parent->parent != $parent->term_id ) && !in_array($parent->parent, $visited)) {
        $visited[] = $parent->parent;$chain .= myget_category_parents( $parent->parent, $link, $separator, $nicename, $visited );}
    if ($link) $chain .= '<span typeof="v:Breadcrumb"><a href="' . get_category_link( $parent->term_id ) . '" title="Voir tous les articles de '.$parent->cat_name.'" rel="v:url" property="v:title">'.$name.'</a></span>' . $separator;
    else $chain .= $name.$separator;
    return $chain;}

//Le rendu
function mybread() {
  // variables gloables
  global $wp_query;$ped=get_query_var('paged');$rendu = '<div xmlns:v="http://rdf.data-vocabulary.org/#">';  
  $debutlien = '<span id="breadex">Vous &ecirc;tes ici :</span> <span typeof="v:Breadcrumb"><a title="'. get_bloginfo('name') .'" id="breadh" href="'.home_url().'" rel="v:url" property="v:title">'. get_bloginfo('name') .'</a></span>';
  $debut = '<span id="breadex">Vous &ecirc;tes ici :</span> <span typeof="v:Breadcrumb">Accueil de '. get_bloginfo('name') .'</span>';

  // si l'utilisateur a défini une page comme page d'accueil
  if ( is_front_page() ) {$rendu .= $debut;}

  // dans le cas contraire
  else {

    // on teste si une page a été définie comme devant afficher une liste d'article
    if( get_option('show_on_front') == 'page') {
      $url = urldecode(substr($_SERVER['REQUEST_URI'], 1));
      $uri = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
      $posts_page_id = get_option( 'page_for_posts');
      $posts_page_url = get_page_uri($posts_page_id);  
      $pos = strpos($uri,$posts_page_url);
      if($pos !== false) {
        $rendu .= $debutlien.' &raquo; <span typeof="v:Breadcrumb">Les articles</span>';
      }
      else {$rendu .= $debutlien;}
    }

    //Si c'est l'accueil
    elseif ( is_home()) {$rendu .= $debut;}

    //pour tout le reste
    else {$rendu .= $debutlien;}

    // les catégories
    if ( is_category() ) {
      $cat_obj = $wp_query->get_queried_object();$thisCat = $cat_obj->term_id;$thisCat = get_category($thisCat);$parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) $rendu .= " &raquo; ".myget_category_parents($parentCat, true, " &raquo; ", true);
      if ($thisCat->parent == 0) {$rendu .= " &raquo; ";}
      if ( $ped <= 1 ) {$rendu .= single_cat_title("", false);}
      elseif ( $ped > 1 ) {
        $rendu .= '<span typeof="v:Breadcrumb"><a href="' . get_category_link( $thisCat ) . '" title="Voir tous les articles de '.single_cat_title("", false).'" rel="v:url" property="v:title">'.single_cat_title("", false).'</a></span>';}}

    // les auteurs
    elseif ( is_author()){
      global $author;$user_info = get_userdata($author);$rendu .= " &raquo; Articles de l'auteur ".$user_info->display_name."</span>";}  

    // les mots clés
    elseif ( is_tag()){
      $tag=single_tag_title("",FALSE);$rendu .= " &raquo; Articles sur le th&egrave;me <span>".$tag."</span>";}
      elseif ( is_date() ) {
          if ( is_day() ) {
              global $wp_locale;
              $rendu .= '<span typeof="v:Breadcrumb"><a href="'.get_month_link( get_query_var('year'), get_query_var('monthnum') ).'" rel="v:url" property="v:title">'.$wp_locale->get_month( get_query_var('monthnum') ).' '.get_query_var('year').'</a></span> ';
              $rendu .= " &raquo; Archives pour ".get_the_date();}
      else if ( is_month() ) {
              $rendu .= " &raquo; Archives pour ".single_month_title(' ',false);}
      else if ( is_year() ) {
              $rendu .= " &raquo; Archives pour ".get_query_var('year');}}

    //les archives hors catégories
    elseif ( is_archive() && !is_category()){
          $posttype = get_post_type();
      $tata = get_post_type_object( $posttype );
      $var = '';
      $the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
      $titrearchive = $tata->labels->menu_name;
      if (!empty($the_tax)){$var = $the_tax->labels->name.' ';}
          if (empty($the_tax)){$var = $titrearchive;}
      $rendu .= ' &raquo; Archives sur "'.$var.'"';}

    // La recherche
    elseif ( is_search()) {
      $rendu .= " &raquo; R&eacute;sultats de votre recherche <span>&raquo; ".get_search_query()."</span>";}

    // la page 404
    elseif ( is_404()){
      $rendu .= " &raquo; 404 Page non trouv&eacute;e";}

    //Un article
    elseif ( is_single()){
      $category = get_the_category();
      $category_id = get_cat_ID( $category[0]->cat_name );
      if ($category_id != 0) {
        $rendu .= " &raquo; ".myget_category_parents($category_id,TRUE,' &raquo; ')."<span>".the_title('','',FALSE)."</span>";}
      elseif ($category_id == 0) {
        $post_type = get_post_type();
        $tata = get_post_type_object( $post_type );
        $titrearchive = $tata->labels->menu_name;
        $urlarchive = get_post_type_archive_link( $post_type );
        $rendu .= ' &raquo; <span typeof="v:Breadcrumb"><a class="breadl" href="'.$urlarchive.'" title="'.$titrearchive.'" rel="v:url" property="v:title">'.$titrearchive.'</a></span> &raquo; <span>'.the_title('','',FALSE).'</span>';}}

    //Une page
    elseif ( is_page()) { 
      $post = $wp_query->get_queried_object();
      if ( $post->post_parent == 0 ){$rendu .= " &raquo; ".the_title('','',FALSE)."";}
      elseif ( $post->post_parent != 0 ) {
        $title = the_title('','',FALSE);$ancestors = array_reverse(get_post_ancestors($post->ID));array_push($ancestors, $post->ID);
        foreach ( $ancestors as $ancestor ){
          if( $ancestor != end($ancestors) ){$rendu .= '&raquo; <span typeof="v:Breadcrumb"><a href="'. get_permalink($ancestor) .'" rel="v:url" property="v:title">'. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</a></span>';}
          else {$rendu .= ' &raquo; '.strip_tags(apply_filters('single_post_title',get_the_title($ancestor))).'';}}}}
    if ( $ped >= 1 ) {$rendu .= ' (Page '.$ped.')';}
  }
  $rendu .= '</div>';
  echo $rendu;}