<?php 


class Category_Widget extends WP_Widget{
	public function __construct()
	{
//		echo "ok"; 
		parent::__construct(false, 'Category Widget', array("description" => 'Affiche vos categories et le titre de vos articles'));
	}

	function widget($args, $instance)
	{
		echo $before_widget; 
		
		$title =  $instance['jellyskull_category_title_widget'];
		$jellyskull_noclasse = $instance['jellyskull_noclasse'];
		$jellyskull_exclude= $instance['jellyskull_exclude'];

		$array = array(
			'type'=>'post',
			'child_of'                 => 0,
			'orderby'                  => 'term_id',
			'order'                    => 'ASC',
			); 

		if($jellyskull_exclude != null) $add_exclude = $jellyskull_exclude ;  else $add_exclude = ''; 
		if($jellyskull_noclasse != null ) $array['exclude'] = 1 . $add_exclude;else{$array['exclude'] = $add_exclude;  } 
		
		$categories = get_categories( $array );

		//var_dump($categories); 
		echo (isset($title))? '<h3 class="widgettitle">'.$title.'</h3>': ''; 
		echo '<ul class="sidebar-nav level-one">';
		if(count($categories) > 0){

			foreach ($categories as $k => $v){
				echo '<li  class="category category-id-'.$v->cat_ID.' category-key-'.$k.'"> <a href="'.get_category_link( $v->cat_ID ).'" class="link-category ">'.$v->name.'</a>'	;


				$array = array(
					'cat' => $v->cat_ID,
					'post_status'=>'publish',
					'post_type'=>'post',  
					'order'    => 'ASC'
					);
				$query = query_posts( $array );
				echo'<ul class="sidebar-nav level-two">'; 
				foreach ($query as $k => $v) {
					echo '<li class="post post-id-'.$v->ID.' post-key-'.$k.'"><a href="'.get_permalink( $v->ID ).'" class="link-post">'.$v->post_title.'</a></li>'; 
				}
				echo '</ul>';

				wp_reset_query();
			}
		}
		echo '</ul>';
		echo $after_widget;
		
	}

	function form($instance)
	{	
		$check = ''; 
		$jellyskull_category_title_widget  = $instance['jellyskull_category_title_widget']; 
		$jellyskull_noclasse  = $instance['jellyskull_noclasse']; 

		echo '<p>
		<label for="'. $this->get_field_id('jellyskull_category_title_widget').'">
		'._('Titre :').
		'<input class="widefat" id="'.$this->get_field_id('jellyskull_category_title_widget').'" name="'.$this->get_field_name('jellyskull_category_title_widget').'" type="text" value="'. $jellyskull_category_title_widget.' " />
		</label>
		</p>';
		if($jellyskull_noclasse != null) $check ="checked=checked";
		echo '<p>
		
		<input class="checkbox" id="'.$this->get_field_id('jellyskull_noclasse').'" name="'.$this->get_field_name('jellyskull_noclasse').'" type="checkbox"  '.$check.'  />
		<label for="'. $this->get_field_id('jellyskull_noclasse').'">
		'._('Ne pas afficher non classé').
		'</label>
		</p>'; 
		echo '<p>
		<label for="'. $this->get_field_id('jellyskull_exclude').'">Exclure (ex ID categories: 1,2,3 etc...)</label>
		<input type="text" name ="'.$this->get_field_name('jellyskull_exclude').'" value ="'.$instance['jellyskull_exclude'].'"> '; 

	}

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance ; 
		$instance['jellyskull_category_title_widget'] = $new_instance['jellyskull_category_title_widget'];
		$instance['jellyskull_noclasse'] = $new_instance['jellyskull_noclasse'];		
		$instance['jellyskull_exclude'] =$new_instance['jellyskull_exclude'];		
		return $instance;
	}

}