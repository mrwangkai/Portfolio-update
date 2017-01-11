<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything
 *
 * @package Keratin
 */
?><!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
<div id="page" class="site-wrapper hfeed site">

	<header id="masthead" class="site-header" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">

		<div class="container">
			<div class="row">

				<div class="col-xs-12 col-sm-8 col-md-4 col-lg-4">

					<div class="site-branding-wrapper">
						<?php
						// Site Custom Logo
						if ( function_exists( 'the_custom_logo' ) ) {
							the_custom_logo();
						}
						?>

						<div class="site-branding">
							<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php else : ?>
								<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php endif; ?>

							<?php
							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) :
							?>
							<p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
							<?php endif; ?>
						</div>
					</div><!-- .site-branding-wrapper -->

				</div>
				<div class="col-xs-12 col-sm-4 col-md-8 col-lg-8">

					<nav id="site-navigation" class="main-navigation" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
						<button class="menu-toggle"><?php _e( 'Primary Menu', 'keratin' ); ?></button>
						<?php
						wp_nav_menu( apply_filters( 'keratin_wp_nav_menu_args', array(
							'container' => 'div',
							'container_class' => 'site-primary-menu',
							'theme_location' => 'primary',
							'menu_class' => 'primary-menu sf-menu'
						) ) );
						?>
					</nav><!-- #site-navigation -->

				</div>

			</div><!-- .row -->
		</div><!-- .container -->

	</header><!-- #masthead -->
