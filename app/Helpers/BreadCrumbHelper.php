<?php  

/** BY SEOMIX  **/
//http://www.seomix.fr/fil-dariane-chemin-navigation/
//***Fil d'arianne
//Récupérer les catégories parentes

class BreadCrumbHelper  
{

	private function myget_category_parents($id, $link = false,$separator = '/',$nicename = false,$visited = array()) {

		$chain = '';
		$parent = &get_category($id);
		if (is_wp_error($parent))return $parent;
		if ($nicename)$name = $parent->name;
		else $name = $parent->cat_name;
		if ($parent->parent && ($parent->parent != $parent->term_id ) && !in_array($parent->parent, $visited)) {
			$visited[] = $parent->parent;$chain .= self::myget_category_parents( $parent->parent, $link, $separator, $nicename, $visited );}
			if ($link) $chain .= '<span typeof="v:Breadcrumb"><a href="' . get_category_link( $parent->term_id ) . '" title="Voir tous les articles de '.$parent->cat_name.'" rel="v:url" property="v:title">'.$name.'</a></span>' . $separator;
			else $chain .= $name.$separator;
			return $chain;

		}


	//Le rendu
		static	function show($label_root = true,  $label_separator = '&raquo;') {
  // variables gloables
			global $wp_query;$ped=get_query_var('paged');
			$rendu = '<div xmlns:v="http://rdf.data-vocabulary.org/#" class="breadcrumb">';  

			if($label_root === true){
				$debutlien = '<span id="breadex">Vous &ecirc;tes ici :</span> <span typeof="v:Breadcrumb">';

				$debutlien .= '<a title="'. get_bloginfo('name') .'" id="breadh" href="'.home_url().'" rel="v:url" property="v:title">'. get_bloginfo('name') .'</a>';


				$debutlien .= '</span> . $label_separator . ';

			}
			

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
						$rendu .= $debutlien.' <span typeof="v:Breadcrumb">Les articles</span>';
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
					if ($thisCat->parent != 0) $rendu .= $label_separator . " .  ".self::myget_category_parents($parentCat, true, " . $label_separator .  ", true);
					if ($thisCat->parent == 0) {$rendu .= $label_separator . " .  ";}
					if ( $ped <= 1 ) {$rendu .= single_cat_title("", false);}
					elseif ( $ped > 1 ) {
						$rendu .= '<span typeof="v:Breadcrumb"><a href="' . get_category_link( $thisCat ) . '" title="Voir tous les articles de '.single_cat_title("", false).'" rel="v:url" property="v:title">'.single_cat_title("", false).'</a></span>';}}

    // les auteurs
						elseif ( is_author()){
							global $author;$user_info = get_userdata($author);$rendu .= $label_separator . " .  Articles de l'auteur ".$user_info->display_name."</span>";}  

    // les mots clés
							elseif ( is_tag()){
								$tag=single_tag_title("",FALSE);$rendu .= $label_separator . " .  Articles sur le th&egrave;me <span>".$tag."</span>";}
								elseif ( is_date() ) {
									if ( is_day() ) {
										global $wp_locale;
										$rendu .= '<span typeof="v:Breadcrumb"><a href="'.get_month_link( get_query_var('year'), get_query_var('monthnum') ).'" rel="v:url" property="v:title">'.$wp_locale->get_month( get_query_var('monthnum') ).' '.get_query_var('year').'</a></span> ';
										$rendu .= $label_separator . " .  Archives pour ".get_the_date();}
										else if ( is_month() ) {
											$rendu .= $label_separator . " .  Archives pour ".single_month_title(' ',false);}
											else if ( is_year() ) {
												$rendu .= $label_separator . " .  Archives pour ".get_query_var('year');}}

    //les archives hors catégories
												elseif ( is_archive() && !is_category()){
													$posttype = get_post_type();
													$tata = get_post_type_object( $posttype );
													$var = '';
													$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
													$titrearchive = $tata->labels->menu_name;
													if (!empty($the_tax)){$var = $the_tax->labels->name.' ';}
													if (empty($the_tax)){$var = $titrearchive;}
													$rendu .= ' . $label_separator .  Archives sur "'.$var.'"';}

    // La recherche
													elseif ( is_search()) {
														$rendu .= $label_separator . " .  R&eacute;sultats de votre recherche <span>. $label_separator .  ".get_search_query()."</span>";}

    // la page 404
														elseif ( is_404()){
															$rendu .= $label_separator . " .  404 Page non trouv&eacute;e";}

    //Un article
															elseif ( is_single()){
																$category = get_the_category();
																$category_id = get_cat_ID( $category[0]->cat_name );
																if ($category_id != 0) {
																	if($label_root == true)
																		$rendu .=  $label_separator ; 
																	$rendu .= self::myget_category_parents($category_id,TRUE, $label_separator )."<span>".the_title('','',FALSE)."</span>";}
																	elseif ($category_id == 0) {
																		$post_type = get_post_type();
																		$tata = get_post_type_object( $post_type );
																		$titrearchive = $tata->labels->menu_name;
																		$urlarchive = get_post_type_archive_link( $post_type );
																		$rendu .= ' . $label_separator .  <span typeof="v:Breadcrumb"><a class="breadl" href="'.$urlarchive.'" title="'.$titrearchive.'" rel="v:url" property="v:title">'.$titrearchive.'</a></span> . $label_separator .  <span>'.the_title('','',FALSE).'</span>';}}

    //Une page
																		elseif ( is_page()) { 

																			$post = $wp_query->get_queried_object();
																			if ( $post->post_parent == 0 ){$rendu .= $label_separator . " .  ".the_title('','',FALSE)."";}
																			elseif ( $post->post_parent != 0 ) {
																				$title = the_title('','',FALSE);$ancestors = array_reverse(get_post_ancestors($post->ID));array_push($ancestors, $post->ID);
																				foreach ( $ancestors as $ancestor ){
																					if( $ancestor != end($ancestors) ){$rendu .= '. $label_separator .  <span typeof="v:Breadcrumb"><a href="'. get_permalink($ancestor) .'" rel="v:url" property="v:title">'. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</a></span>';}
																					else {$rendu .= ' . $label_separator .  '.strip_tags(apply_filters('single_post_title',get_the_title($ancestor))).'';}}}}
																					if ( $ped >= 1 ) {$rendu .= ' (Page '.$ped.')';}
																				}
																				$rendu .= '</div>';
																				echo $rendu;}
																			}


																			?>