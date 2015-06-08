<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package longhoa
 * @since longhoa 1.0
 */

get_header();
?>

		<div id="primary" class="content-area">
			<nav role="navigation" class="site-navigation main-navigation">
				<h1 class="assistive-text"><?php _e( 'Menu', 'longhoa' ); ?></h1>
				<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'longhoa' ); ?>"><?php _e( 'Skip to content', 'longhoa' ); ?></a></div>

				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- .site-navigation .main-navigation -->

			<div class="site-content" role="main">
				<?php if ( have_posts() ) : ?>
					<?php while( have_posts() ) : the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile;?>
				<?php endif; ?>
			</div><!-- .site-content -->

		</div><!-- #primary .content-area -->

<?php
get_footer(); ?>