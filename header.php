<?php echo HtmlHelper::docType() ?>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	
	<!-- BASIC  METAS -->
	<title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	

	
	<?php echo HtmlHelper::css(array('type'=>'css','media'=>'all',  'url'=>get_bloginfo( 'stylesheet_url' ))) ?>

	<!-- Mobile Specific Metas -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, target-densitydpi=160dpi, initial-scale=1.0">

	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" >
	
	<?php echo HtmlHelper::script(array('url'=>'vendor/modernizr')) ?>


	<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
		<!--[if lt IE 9]>
			<?php echo HtmlHelper::script(array('url'=>'html5')) ?>
			<![endif]-->



			<?php wp_head(); ?>
		</head>
		<body <?php body_class(); ?>>
			<div class="container">
				<header>
					
					<?php wp_nav_menu(array('theme_location' => 'header', 'container'=>'nav', 'container_class'=>'row menu2')); ?>
					
				</header>