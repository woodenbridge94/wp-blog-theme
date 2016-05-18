<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Peanut Butter 2015
 */

	$options = get_option('pb2015_theme_options');

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">

		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="IE=EDGE" />

		<meta name="copyright" content="Copyright (c) 2016 University of St Andrews" />
	    <meta name="rating" content="general" />
		<meta name="dc.keywords" content="University"/>

    	<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">


	<!-- Begin pattern: header //-->
	<div class="sr-only"><a href="#content-begin">Skip to content</a></div>


		<!-- BEGIN: #header //-->
		<header id="header">

		    <!-- Print header //-->
		    <div id="header-print">
		        <img src="<?php print dpl_url("images/furniture/print-crest.png") ?>" alt="University of St Andrews">

		    </div>

		    <div class="container">

		        <div id="header-row" class="row">

		            <div id="header-audience" class="col-sm-5  col-sm-push-7">

		                <?php
							wp_nav_menu( array(
								'theme_location' => 'header-nav',
								'menu_id' => 'header-nav-menu',
								'container' => false, // Don't wrap the <ul> in a container.
								'menu_class' => 'list-inline audience', // Set class for <ul>
								'depth' => 1, // Only descend one level deep in hierarchy.
								'fallback_cb' => 'pb2015_audience_nav_fallback',
							) );
						?>


		            </div>

		            <div id="logo-container" class="col-sm-7 col-sm-pull-5 col-xs-7">
		                <div id="header-logo"><h1><a href="<?php print $options['logo_link']?>"><img src="<?php print dpl_url("images/furniture/logo-standard.svg") ?>" alt="University of St Andrews"></a></h1></div>
		            </div>

		            <div id="header-search" class="col-sm-5 col-xs-5" role="search">

		                <!-- BEGIN: Search Trigger //-->
		                <div style=" ">
                            <?php // removed name="btnG" below ?>
		                    <button class="btn btn-link" type="button" value="" id="header-search-trigger"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
		                </div>
		                <!-- BEGIN: Search Trigger //-->

		                <!-- BEGIN: Search //-->
		                <?php // <form action="http://www.st-andrews.ac.uk/gsasearch" method="get">  ?>
                        <form action="<?php bloginfo('home'); ?>" method="get">

		                <div class="input-group">
		                    <span class="input-group-btn">
		                        <button class="btn btn-link" type="button" value="" name="btnG" id="header-search-close"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
		                    </span>
                            <?php // Changed name="q" below to "s" ?>
		                    <input class="form-control" type="text" title="Enter search keywords" maxlength="256" name="s" placeholder="Search...">
		                    <span class="input-group-btn">
                                <?php // removed name="btnG"  from button below ?>
		                        <button class="btn btn-primary" type="submit" value="Search" id="header-search-submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
		                    </span>
		                </div>

                        <?php
                        /*
		                <input type="hidden" value="StAndrews_ITS" name="site">
		                <input type="hidden" value="xml_no_dtd" name="output">
		                <input type="hidden" value="StAndrews_ITS" name="client">
		                <input type="hidden" value="StAndrews_ITS" name="proxystylesheet">
                        */
                         ?>
		                </form>

		                <!-- END: Search //-->



		            </div>

		        </div>

		    </div>
		</header>
		<!-- END: #header //-->

	<!-- End pattern: header //-->


	<?php



		if ( !(array_key_exists('hide_site_title',$options) && $options['hide_site_title']) ):
	?>


	<div id="category-header" class="">
		<div class="container">
			<h2><a href="<?php bloginfo( 'wpurl' );?>"><?php bloginfo( 'name' ); ?></a></h2>
		</div>
	</div>

	<?php endif; ?>


	<?php // Show the top navigation menu if it exists. ?>
	<?php if (has_nav_menu( 'primary' ) ): ?>


	<nav id="site-navigation"  class="navigation-bar" role="navigation">
		<div class="container">
			<div class="toggle-navigation primary-toggle"><a class="navigation-button"><?php _e( 'Navigation', 'pb2015' );?> <i class="chevron left"></i></a></div>
			<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_id' => 'primary-menu',
					'container' => false, // Don't wrap the <ul> in a container.
					'menu_class' => 'navigation-bar-nav primary-nav', // Set class for <ul>
					'depth' => 1, // Only descend one level deep in hierarchy.
					'fallback_cb' => false,
				) );
			?>

		</div>
	</nav>


	<?php
		// The secondary navigation. Note that here I needed to include the wrapper
		// elements in the 'items_wrap' variable so that the whole element will
		// show if and only if there are child elements of a currently selected
		// element in the top-level navigation.
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'menu_id' => 'secondary-menu',
			'container' => false, // Don't wrap the <ul> in a container.
			'menu_class' => 'navigation-bar-nav secondary-nav', // Set class for <ul>
			'depth' => 2, // Only descend to second level of hierarchy
			'items_wrap' => '<nav id="site-navigation"  class="navigation-bar subnav" role="navigation"><div class="container"><div class="toggle-navigation primary-toggle"><a class="navigation-button">Section navigation <i class="chevron left"></i></a></div><ul id="%1$s" class="%2$s">%3$s</ul></div></nav>',
			'walker' => new Child_Only_Walker_Nav_Menu()
		) );
	?>


	<?php endif; ?>

	<a name="content-begin"></a>






