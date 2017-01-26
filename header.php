<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>" /> 
	<title><?php wp_title( '|', true, 'right' ); ?></title>              
    <meta name="viewport" content="width=device-width, initial-scale=1">   
    <link rel="profile" href="http://gmpg.org/xfn/11" />        
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />   
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="container">
	<header>		
		<a id="blog-name" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		<p id="description"><?php bloginfo('description'); ?></p>
		<nav role="navigation">			
			<?php wp_nav_menu(array('theme_location' => 'primary','depth' => 2,'container' => 'false','fallback_cb' => 'false')); ?>					
		</nav>
	</header>