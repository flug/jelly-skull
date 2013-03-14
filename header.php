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
		<!-- SlidesJS Required: Link to jQuery -->
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <!-- End SlidesJS Required -->

  <!-- SlidesJS Required: Link to jquery.slides.js -->
  <?php echo HtmlHelper::script(array('url'=>'slider/source/jquery.slides.min')) ?>
   
  <!-- End SlidesJS Required -->

  <!-- SlidesJS Required: Initialize SlidesJS with a jQuery doc ready -->
  <script>
    $(function() {
      $('#slides').slidesjs({
        width: 960,
        height: 250,
        zIndex : 0, 
        navigation: false
      });
    });
  </script>
  <!-- End SlidesJS Required -->
 

	<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
		<!--[if lt IE 9]>
			<?php echo HtmlHelper::script(array('url'=>'html5')) ?>
			<![endif]-->


	<style>

    #slides {
    	display: none
    }

    #slides .slidesjs-navigation {
    	margin-top:3px;
    }

    #slides .slidesjs-previous {
    	margin-right: 5px;
    	float: left;
    }

    #slides .slidesjs-next {
    	margin-right: 5px;
    	float: left;
    }

    .slidesjs-pagination {
    	margin: 6px 0 0;
    	float: right;
    	list-style: none;
    }

    .slidesjs-pagination li {
    	float: left;
    	margin: 0 1px;
    }

    .slidesjs-pagination li a {
    	display: block;
    	width: 13px;
    	height: 0;
    	padding-top: 13px;
    	background-image: url(<?php echo  HtmlHelper::url(array('url'=>'images/pagination.png')) ?>);
    	background-position: 0 0;
    	float: left;
    	overflow: hidden;
    }

    .slidesjs-pagination li a.active,
    .slidesjs-pagination li a:hover.active {
    	background-position: 0 -13px
    }

    .slidesjs-pagination li a:hover {
    	background-position: 0 -26px
    }

    #slides a:link,
    #slides a:visited {
    	color: #333
    }

    #slides a:hover,
    #slides a:active {
    	color: #9e2020
    }

    
    #slides {
    	display: none
    }



    /* For tablets & smart phones */
    @media (max-width: 767px) {


    }

    /* For smartphones */
    @media (max-width: 480px) {

    }

    /* For smaller displays like laptops */
    @media (min-width: 768px) and (max-width: 979px) {

    }

    /* For larger displays */
    @media (min-width: 1200px) {

    }
    </style>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="container">
		<div class="row">
			<div class="twelve columns">
				<div class="row">

					<div class="seven columns">
						<img src="http://lorempixel.com/g/545/130/">
					</div>
					<div class="five columns">
						<div class="navbar navbar-inverse">

							<?php wp_nav_menu(array('theme_location' => 'top-header', 'container'=>'div', 'container_class'=>'eight  columns')); ?>
								<!--	<li><?php echo HtmlHelper::ahref(array('url'=>'#', 'text'=>'lien 1')) ?></li>
									<li><?php echo HtmlHelper::ahref(array('url'=>'#', 'text'=>'lien 2')) ?></li>
									<li><?php echo HtmlHelper::ahref(array('url'=>'#', 'text'=>'lien 3')) ?></li>-->

								</div>
							</div>
						</div>
						<header>

							<?php wp_nav_menu(array('theme_location' => 'header', 'container'=>'div', 'container_class'=>'navbar row')); ?>

						</header>
						<?php if(get_option("skull_element_slider")) :   ?>

						<div class="container">
							<div id="slides">
								<?php $json =json_decode(get_option("skull_element_slider")); 
								foreach ($json as $k => $v) {
									echo '<img src="'.HtmlHelper::url(array('url'=>'timthumb.php?q=100&amp;w=960&amp;h=250&amp;src='.$v)).'" >'; 
								}

							 ?>


								<a href="#" class="slidesjs-previous slidesjs-navigation"><i class="icon-chevron-left icon-large"></i></a>
								<a href="#" class="slidesjs-next slidesjs-navigation"><i class="icon-chevron-right icon-large"></i></a>
							</div>
						</div>
						<?php endif; ?>