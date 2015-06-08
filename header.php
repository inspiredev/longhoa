<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package longhoa
 * @since longhoa 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!-- Facebook Like Box plugin code -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=220107658132932";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<!-- END Facebook Like Box plugin code -->

<div id="page" class="hfeed site">
	<?php
	$background_images = get_background_images();
	$directory_uri = get_template_directory_uri();
	?>
	<div class="background" style="background-image: url(<?php echo $directory_uri . '/images/backgrounds/' . $background_images['small']; ?>);"
		data-bg-small='<?php echo $directory_uri . '/images/backgrounds/' . $background_images['small'];?>'
		data-bg-medium='<?php echo $directory_uri . '/images/backgrounds/' . $background_images['medium'];?>'
		data-bg-full='<?php echo $directory_uri . '/images/backgrounds/' . $background_images['full'];?>'
		>
		<?php do_action( 'before' ); ?>
		<header id="masthead" class="site-header" role="banner">
			<hgroup>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</hgroup>
			<div class="gfo"></div>
		</header><!-- #masthead .site-header -->

		<div id="main" class="site-main">
