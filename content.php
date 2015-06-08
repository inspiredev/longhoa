<?php
/**
 * @package longhoa
 * @since longhoa 1.0
 */
?>

		<div id="primary" class="content-area">
			<nav role="navigation" class="site-navigation main-navigation">
				<h1 class="assistive-text"><?php _e( 'Menu', 'longhoa' ); ?></h1>
				<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'longhoa' ); ?>"><?php _e( 'Skip to content', 'longhoa' ); ?></a></div>

				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- .site-navigation .main-navigation -->
			<div id="content" class="site-content" role="main">

				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="entry-header">
								<h1 class="entry-title"><?php the_title();?></h1>
							</header><!-- .entry-content -->

							<?php if ( has_post_thumbnail() && !is_subpage( 'cac-du-an' )):
									echo '<div class="post-feature-image">';
									the_post_thumbnail( '650x250' );
									echo '</div>';
								endif;
							?>

							<?php if ( is_subpage( 'cac-du-an' ) ):
								echo get_the_gallery( 'project-gallery' );
							endif;
							?>
							<section class="entry-content">
								<?php the_content();?>
							</section><!-- .entry-content -->

							<?php if ( !is_subpage( 'cac-du-an' ) ):
								echo get_the_gallery( 'page-gallery' );
							endif;  ?>

							<?php if ( function_exists( 'get_field' ) ):
								if ( get_field( 'members' ) ):
									echo get_the_team();
								endif;
							endif; ?>

							<?php if ( is_page( 'cac-du-an' ) ):
								echo get_the_projects();
							endif;?>

							<?php if ( is_page( 'luu-but' ) ):
								comments_template();
							endif; ?>

							<?php echo get_rows(); ?>
						</article><!-- #post-<?php the_ID(); ?> -->
					<?php endwhile; ?>

				<?php else : ?>

					<?php get_template_part( 'no-results', 'index' ); ?>

				<?php endif; ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
