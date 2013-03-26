<?php 


/**
* Html Helper
*/

class HtmlHelper  
{
	


	public static function docType($type = 'html5') {

		$_docTypes = array(
			'html4-strict' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">',
			'html4-trans' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">',
			'html4-frame' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">',
			'html5' => '<!DOCTYPE html>',
			'xhtml-strict' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
			'xhtml-trans' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
			'xhtml-frame' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">',
			'xhtml11' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">'
			);


		if (isset($_docTypes[$type])) {
			return $_docTypes[$type];
		}
		return null;
	}

	

	


	static	function script($params= array(), $fullbase = true){

		if($fullbase == true) 
			$full = get_bloginfo('template_directory') .'/js/' ; 

		if(is_array($params['url']))
		{$output = ''; 
			for($i = 0 ; $i < count($params['url']); $i++)
				$output .='<script src="'.$full.$params['url'][$i].'.js" type="text/javascript" ></script>';
			return $output;
		}else
		{
			return '<script src="'.$full.$params['url'].'.js" type="text/javascript" ></script>'; 	
		}
		
	} 
	

	static function css($params =array(), $fullbase = true)
	{
		if(is_array($params)){
			$types= array('css'=>array('type'=> 'text/css','rel'=> 'stylesheet')); 

		}
		$type =  $params['type'] ; 

		if(!strpos($params['url'],'.css')) 
			$ext = '.css'; 
		else
			$ext = ''; 
		
		return '<link rel="'.$types[$type]['rel'].'" type="'.$types[$type]['type'].'" media="'.$params['media'].'" href="'.$params['url'].$ext.'" />' ; 
	}
	static function ahref($params= array()){
	#var_dump($params); 
		$title= (isset($params['title'])) ? $params['title'] : $params['text']  ;
		return '<a href="'.$params['url'].'" title="'.$title.'" >'.$params['text'].'</a>' ; 

	}

	static function url ($params = array()){
		return get_bloginfo('template_directory').'/'.$params['url']; 
	}
}

?>